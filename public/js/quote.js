console.log('hello from quote.js');
var quoteId = $('#quote_id').val(); //to store quotation id and determine if quote is created or no.
$("#customer, #item_name").select2();//apply select2

disableAddItem(true);//disable add item form
$('#customerm .select2-selection__rendered').html('Pick a Customer');
if(quoteId != '')
{
    startAddFunction();
    addItemFunction();
    $('#customerm .select2-selection__rendered').html(customer_name+'');
}
/*** Variables ***/
var count = 0; //table row counter
var items_table = document.getElementById("items_table");//items_table selector.
var items_table_tbody = document.getElementById("items_table").getElementsByTagName('tbody')[0];//items table body.
var selectedRow = ''; //store the selected row

$('#items_table').DataTable();

//setup token in header
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//when customer is selected
$('#customer').change(function(){
	$('#customer_id').val($('#customer').val());
	//$('#vendor_name').val(this.options[this.selectedIndex].innerText);
});

//when product is selected
$('#item_name').change(function(){
	var product_id = $('#item_name').val();//selected product id
    $('#product_id').val(product_id);//store product_id in hidden input
	//Get product information and fill in the boxes
	$.getJSON(searchProductUrl+product_id, function( data ) {
        $('#item_price').val(data['sale_price']);//set item price
        $('#item_price_orig').val(data['sale_price']);//set item price
        $('#item_qty_total').val(data['qty']);//set item quantity
	});
});

//when click on start adding button
$('#startAdd').on( 'click', function () {
    quoteId = $('#quote_id').val();
    //check if quote is created 
    if(quoteId > 0){//check for bad people!
        alert('Why? Just Go do something usefull with your life!');
    }
    else{ //create quote
        if(validateQuote()){
            $.ajax({
                type: "POST",
                url: host+'/quotations',
                data: $('#quoteForm').serialize()
            }).done(function( msg ) {
                alert( msg );
                quoteId = msg;
                $('#quote_id').val(msg);
                if(msg > 0)
                {
                    startAddFunction();
                } 
            });
        }//end if validateQuote()  
    }//end else
});

function startAddFunction(){
    disableAddItem(false);//enable add item form
    disableCustomer(true);//disable customer form
}

//when click on addItem button
$('#addItem').on( 'click', function () {
    //check if quote is created 
    if(quoteId > 0){
        //add item
        var isValid = validateAddItem();
        if(isValid){
            var itemdata = $('#itemForm').serialize();
            $.ajax({
                type: "POST",
                url: host+'/quote_items',
                data: itemdata
            }).done(function( msg ) {
                alert( msg );
                
                if(msg > 0)
                {
                    addItemFunction();                    
                } 
            });
        }
        
    }
    else{ //this is just to prevent very bad people! very very bad people!
        validateQuote();
        alert('Why? Just Go do something usefull with your life!');
    }
});

function addItemFunction(){
    var url = host + '/search/quotations/' + quoteId;
    $.getJSON(url, function( data ) {
        $('#total').html(data['subtotal'] + ' AED');
        $('#subtotal').html(data['subtotal'] + ' AED');
        //$('#items_table').DataTable().ajax.url(data).load();//reload items
        var thedata = $('#items_table').DataTable().ajax.json();//get current datatable data
        thedata = data;//replace with current data
        $('#items_table').DataTable().clear();//clear the table
        $('#items_table').DataTable().rows.add(data.data);//add the new data
        $('#items_table').DataTable().draw();//redraw the table

    });
    emptyAddItems();
}

//quote validation
function validateQuote(){
    var customer_id = $('#customer_id').val();
    var expiry_date = $('#expiry_date').val();
    var payment_term = $('#payment_term').val();
    var valid = true;
    //if customer is selected
    if(customer_id){//remove error if it had one
        $('#customerm .select2-container--default .select2-selection--single').css('border-color','#d2d6de');
        $('#customerm .select2-selection__rendered').css('color','#555');
    }
    else{//Show error
        $('#customerm .select2-container--default .select2-selection--single').css('border-color','#dd4b39');
        $('#customerm .select2-selection__rendered').css('color','#dd4b39');
        valid = false;
    }

    //Create js date.    
    var str = expiry_date;
    var day1 = str.substring(8, 10);
    var month1 = str.substring(5, 7);
    var year1 = str.substring(0, 4);
    var expiry_date_js = new Date(year1, month1-1, day1,0,0,0,0);
    var today_js = new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate(),0,0,0,0);

    //if date is selected & date is greater than or equal today
    if(expiry_date && expiry_date_js >= today_js){
        $('#expiry_date').removeClass(' danger');
    } 
    else{ //Show error
        $('#expiry_date').addClass(' danger');
        valid = false;
    }

    //if term is selected
    if(payment_term){
        $('#payment_term').removeClass(' danger');
    }
    else{//Show error
        $('#payment_term').addClass(' danger');
        valid = false;
    }  

    return valid;
}

//validate additem form
function validateAddItem(){
    var product_id = $('#product_id').val();
    var item_qty = $('#item_qty').val();
    var item_qty_total = $('#item_qty_total').val();
    var item_price = $('#item_price').val();
    var item_price_orig = $('#item_price_orig').val();
    var valid = true;

    //if product item is selected
    if(product_id){//remove error if it had one
        $('#itemForm .select2-container--default .select2-selection--single').css('border-color','#d2d6de');
        $('#itemForm .select2-selection__rendered').css('color','#555');
    }
    else{//Show error
        $('#itemForm .select2-container--default .select2-selection--single').css('border-color','#dd4b39');
        $('#itemForm .select2-selection__rendered').css('color','#dd4b39');
        valid = false;
    }

    //if qty is ok?
    if(item_qty > item_qty_total){//if qty > total qty show error
        $('#item_qty').addClass(' danger');
        valid = false;
    }
    else{//remove error
        $('#item_qty').removeClass(' danger');
    }

    //if price is ok?
    if(item_price < item_price_orig ){//if price is less than original price
        $('#item_price').addClass(' danger');
        valid = false;
    }
    else{//remove error
        $('#item_price').removeClass(' danger');
    }
    return valid;
}

//to fill items's table
function fillItemsTable(data){
	var row = items_table.insertRow(count);//Create a row

	var item_id = row.insertCell(0);//Create item id cell
	item_id.innerHTML = data['id'];//Fill in data
	item_id.id = 'rid';

	var item_name = row.insertCell(1);//Create item name cell
	item_name.innerHTML = data['item_name'];//Fill in data

    var item_description = row.insertCell(2);//Create quantity cell
	item_description.innerHTML = data['item_description'];//Fill in data

	var item_qty = row.insertCell(3);//Create quantity cell
	item_qty.innerHTML = data['item_qty'];//Fill in data

	var item_price = row.insertCell(4);//Create price cell
	item_price.innerHTML = data['item_price'];//Fill in data

    var subtotal = row.insertCell(5);//Create price cell
	subtotal.innerHTML = data['item_price'] * data['item_qty'];//Fill in data

	// Edit button
	var editCol = row.insertCell(6);//Create delete button cell
	editCol.innerHTML = '<button class="btn small-btn btn-success" data-toggle="modal" data-target="#edit-row-modal"><i class="fa fa-pencil"></i></button>';
	
	var deleteCol = row.insertCell(7);//Create delete button cell
	deleteCol.innerHTML = '<button class="btn small-btn btn-danger" data-toggle="modal" data-target="#delete-row-modal"><i class="fa fa-ban"></i></button>';

	count++;//increment count or rows
}

//disable add item form
function disableAddItem(value){
    $("#addItem, #item_qty, #item_description, #item_name, #item_price").prop('disabled', value);
    if(value == false){
        $('#startAdd').hide();
        $('#addItem').show();
        $("#startAdd").prop('disabled', true);
    }
    
}

//disable customer form
function disableCustomer(value){
    $("#customer, #expiry_date, #payment_term").prop('disabled', value);
    $('#editCustomerBtn').hide();
    if(value == true){
        $('#editCustomerBtn').show();
    }
}

//empty add items form values
function emptyAddItems(){
    $("#item_description, #item_name").prop('value', '');
    $("#item_qty, #item_qty_total, #item_price, #item_price_orig").prop('value', '0');
    $('#itemForm .select2-selection__rendered').html('Pick an item');
}

//To determine which row is clicked
$('#items_table tbody').on( 'click', 'button', function () {
        if ( $(this).parent().parent().hasClass('selected') ) {
            $(this).parent().parent().removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).parent().parent().addClass('selected');
            //$(this).parent().parent().remove();
            selectedRow = $(this).parent().parent();
        }        
});