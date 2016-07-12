@extends('layouts.admin')

@section('content')
<div id="newProduct" class="content-container">
<div class="row">
    <div class="col-md-12">
    <div class="box box-success">
	    <div class="box-header with-border">
	        <h3 class="box-title">Product Details</h3>
	        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
          	</div>
	    </div>
	    <div class="box-body">
	        <div class="row">
	        	<div class="col-md-12">
	        		<h3 class="box-title">Product Details</h3>
	        		<div class="row">
	        			<div class="col-md-3 selectm">
	        				<input type="hidden" id="product_id2" name="product_id2" value="" />	        				
	        				{{ Form::label('product_name','Product name') }}
	        				<select id="product_name" class="form-control">
			                  <option selected="selected">Pick a product</option>
			                  @foreach($products as $product)
			                  <option value="{{$product->id}}">{{$product->product_name}}</option>
			                  @endforeach
			                </select>
		                </div>
		        		<div class="col-md-3">
			        		{{ Form::label('product_type','Product type') }}
		        			{{ Form::text('product_type','',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
		        		<div class="col-md-3">
			        		{{ Form::label('internal_reference','Internal Reference') }}
	        				{{ Form::text('internal_reference','',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
		        		<div class="col-md-3">
			        		{{ Form::label('barcode','Barcode') }}
	        				{{ Form::text('barcode','',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
	        		</div><!-- end row-->
	        		<div class="row">
		        		<div class="col-md-3">
			        		{{ Form::label('sale_price','Sale Price') }}
	        				{{ Form::number('sale_price','0.0',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
		        		<div class="col-md-3">
			        		{{ Form::label('cost','Cost') }}
			        		{{ Form::number('cost','0.0',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
		        		<div class="col-md-3">
			        		{{ Form::label('weight','Weight') }}
			        		{{ Form::number('weight','0.0',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
		        		<div class="col-md-3">
			        		{{ Form::label('volume','Volume') }}
			        		{{ Form::number('volume','0.0',['class' => 'form-control', 'readonly' => 'true']) }}
		        		</div>
	        		</div><!-- end row-->
    			</div><!-- end col-md-12-->
	        </div><!-- end of row -->        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
<div class="row">
	<div class="col-md-4">
		<div id="addVendorBox" class="box box-primary">
			{{ Form::open(['id'=>'vendorForm', 'name'=>'vendorForm', 'url'=>'inventory/store'])}}
            <div class="box-header with-border">
              <h3 class="box-title">Add Vendor</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-primary mbtn" type="button" onclick="addVendor()">
					Add Vendor	        		
	        	</button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
            	
            	<input type="hidden" id="product_id" name="product_id" value="" />
            	<input type="hidden" id="vendor" name="vendor" value="" />
            	<input type="hidden" id="vendor_name" name="vendor_name" value="" />
            	<div class="col-md-6 selectm">
	        		{{ Form::label('vendor1','Vendor') }}
        			<select id="vendor1" class="form-control">
	                  <option value="" selected="selected">Pick a vendor</option>
	                  @foreach($vendors as $vendor)
	                  <option value="{{$vendor->id}}">{{$vendor->customer_name}}</option>
	                  @endforeach
	                </select>
    			</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_product_code','V. Product Code') }}
        			{{ Form::text('vendor_product_code','',['class' => 'form-control']) }}
	        	</div>
            	<div class="col-md-12">
	        		{{ Form::label('vendor_product_name','Vendor Product Name') }}
        			{{ Form::text('vendor_product_name','',['class' => 'form-control']) }}
	        	</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_quantity','Quantity') }}
        			{{ Form::number('vendor_quantity','',['class' => 'form-control']) }}
    			</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_price','Price') }}
	        		{{ Form::number('vendor_price','',['class' => 'form-control']) }}
	        	</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_produce','Produce Date') }}
        			{{ Form::date('vendor_produce','',['class' => 'form-control']) }}
    			</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_expiry','Expiry Date') }}
	        		{{ Form::date('vendor_expiry','',['class' => 'form-control']) }}
	        	</div>
            </div><!-- /.box-body -->
            {{ Form::close() }}
          </div><!-- end of Box -->
	</div>
	<div class="col-md-8">
		<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Inventory</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="vendors_table" class="table table-striped">
                <thead><tr>
                  <th>ID</th>
                  <th>Vendor</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Produce Date</th>
                  <th>Expire Date</th>
                  <!--<th></th>edit button-->
                  <th></th>
                </tr></thead>
                <tbody>
                	
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- end of Box -->
	</div><!-- end of col-md-12 -->
</div><!-- End of row-->
</div><!-- end of container -->

<!-- Delete vendor table row -->
<div id="delete-row-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete row?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="row-delete-button" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit vendor table row -->
<div id="edit-row-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit row</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="row-edit-button" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


<script src="{{URL::to('/')}}/adminlte/plugins/select2/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/adminlte/plugins/select2/select2.min.css">
<script src="{{URL::to('/')}}/adminlte/plugins/datatables/dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/adminlte/plugins/datatables/datatables.min.css"></link>

<script type="text/javascript">
	var table = $('#vendors_table').DataTable({
    "searching": false,
    "ordering": false,
    "paging": false,
    "info": false,
    "responsive": true,
    });
$('#vendors_table tbody').on( 'click', 'button', function () {
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


$("#product_name, #vendor1").select2();
var count = 0;
var vendors_table = document.getElementById("vendors_table").getElementsByTagName('tbody')[0];
var selectedRow = '';

$('#product_name').change(function(){
	$("#vendors_table tbody tr").remove();//empty vendor table
	count = 0;//reset rows counter
	var val = $('#product_name').val();
	var items = [];
	//Get product information and fill in the boxes
	$.getJSON("{{URL::to('/search/products/')}}/"+val, function( data ) {
		$('#product_id').val(data['id']);
		$('#product_id2').val(data['id']);
		$('#vendor_product_name').val(data['product_name']);
		$('#product_type').val(data['product_type']);
		$('#internal_reference').val(data['internal_reference']);
		$('#barcode').val(data['barcode']);
		$('#sale_price').val(data['sale_price']);
		$('#cost').val(data['cost']);
		$('#weight').val(data['weight']);
		$('#volume').val(data['volume']);
	});
	//Get inventory information and fill in vendor table
	$.getJSON("{{URL::to('/search/inventory/')}}/"+val, function( data ) {
		data.forEach(function(row){
			//Fill in vendor table on client side
			row['vendor_name'] = row['customer_name'];
			fillVendorsTable(row);
		});
	});
});
$('#vendor1').change(function(){
	$('#vendor').val($('#vendor1').val());
	$('#vendor_name').val(this.options[this.selectedIndex].innerText);
});

//Function to add vendors to the vendor table
function addVendor(){
var data = [];
//fill in data array with data from vendor form inputs
$('#vendorForm').serializeArray().map(function(x){data[x.name] = x.value;});

	if(data['product_id']){
		//client side validation
		if(data['vendor'] == ''){
			$('.selectm .select2-container--default .select2-selection--single').css('border-color','#dd4b39');
			return;
		}
		$('.selectm .select2-container--default .select2-selection--single').css('border-color','#d2d6de');

		if(data['vendor_product_name'] ==''){
			$('#vendor_product_name').addClass(' danger'); return;
		}
		$('#vendor_product_name').removeClass(' danger');

		if(data['vendor_quantity'] ==''){
			$('#vendor_quantity').addClass(' danger'); return;
		}
		$('#vendor_quantity').removeClass(' danger');

		if(data['vendor_price'] ==''){
			$('#vendor_price').addClass(' danger'); return;
		}
		$('#vendor_price').removeClass(' danger');

		//Fill in vendor table on client side
		fillVendorsTable(data);
		
		//Submit form using ajax
		var host = "{{URL::to('/')}}";
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
		});
		$.ajax({
	        type: "POST",
	        url: host+'/inventory',
	        data: $('#vendorForm').serialize()
	    }).done(function( msg ) {
	        alert( msg );
	    });

	    //Empty vendor form
	    emptyVendor();
	}
}

//to fill vendor's table
function fillVendorsTable(data){
	var row = vendors_table.insertRow(count);//Create a row

	var vendor_id = row.insertCell(0);//Create vendor name cell
	vendor_id.innerHTML = data['id'];//Fill in data
	vendor_id.id = 'rid';

	var vendor_name = row.insertCell(1);//Create vendor name cell
	vendor_name.innerHTML = data['vendor_name'];//Fill in data

	var vendor_qty = row.insertCell(2);//Create quantity cell
	vendor_qty.innerHTML = data['vendor_quantity'];//Fill in data

	var vendor_price = row.insertCell(3);//Create vendor price cell
	vendor_price.innerHTML = data['vendor_price'];//Fill in data

	var product_produce_date = row.insertCell(4);//Create produce date cell
	if(data['vendor_produce'] == '' || data['vendor_produce'] == '0000-00-00')
		product_produce_date.innerHTML = '-';//Fill in data
	else
		product_produce_date.innerHTML = data['vendor_produce'];//Fill in data

	var product_expiry_date = row.insertCell(5);//Create expiry date cell
	if(data['vendor_expiry'] == '' || data['vendor_expiry'] == '0000-00-00')
		product_expiry_date.innerHTML = '-';//Fill in data
	else
		product_expiry_date.innerHTML = data['vendor_expiry'];//Fill in data

	// Edit button
	// var editCol = row.insertCell(5);//Create delete button cell
	// editCol.innerHTML = '<button class="btn small-btn btn-success" data-toggle="modal" data-target="#edit-row-modal"><i class="fa fa-pencil"></i></button>';
	
	var deleteCol = row.insertCell(6);//Create delete button cell
	deleteCol.innerHTML = '<button class="btn small-btn btn-danger" data-toggle="modal" data-target="#delete-row-modal"><i class="fa fa-ban"></i></button>';

	count++;//increment count or rows
}

$('#row-delete-button').on( 'click', function () {
	var id = selectedRow.find("#rid").text();
    selectedRow.remove();
    $('#delete-row-modal').modal('hide');
    //Submit form using ajax
	var host = "{{URL::to('/')}}";
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	});
	
	$.ajax({
        type: "POST",
        url: host+'/inventory/'+id,
        data: {_method:'DELETE'}
    }).done(function( msg ) {
        alert( msg );
    });
});

//empty add vendor form
function emptyVendor(){
	$('#vendorForm .select2-selection__rendered').html('Pick a vendor');
	$('#vendor, #vendor1').val('');
	$('#vendor_name').val('');
	$('#vendor_product_code').val('');
	$('#vendor_product_name').val('');
	$('#vendor_quantity').val('');
	$('#vendor_price').val('');
	$('#vendor_produce').val('');
	$('#vendor_expiry').val('');
}

</script>
@endsection
