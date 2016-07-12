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
	        {!! Form::open(['url'=>'products/new']) !!}
	        <div class="row">
	        	<div class="col-md-6 left-section">
	        		<h3 class="box-title">Details</h3>
	        		<div class="row">
	        		<div class="col-md-6">
		        		{{ Form::label('product_type','Product Type') }}
		        		{{ Form::select('product_type', [''=>'Pick a type','Consumable'=>'Consumable','Service'=>'Service'],
		        						null,['class' => 'form-control']) }}
	        		</div>
	        		</div>

	        		{{ Form::label('product_name','Product name') }}
	        		{{ Form::text('product_name','',['class' => 'form-control']) }}

	        		{{ Form::label('internal_reference','Internal Reference') }}
	        		{{ Form::text('internal_reference','',['class' => 'form-control']) }}

	        		{{ Form::label('barcode','Barcode') }}
	        		{{ Form::text('barcode','',['class' => 'form-control']) }}
    			</div>
    			<div class="col-md-6">
    				<h3 class="box-title">Inventory</h3>
	    			{{ Form::label('sale_price','Sale Price') }}
	        		{{ Form::number('sale_price','0.0',['class' => 'form-control']) }}

	        		{{ Form::label('cost','Cost') }}
	        		{{ Form::number('cost','0.0',['class' => 'form-control']) }}

	        		{{ Form::label('weight','Weight') }}
	        		{{ Form::number('weight','0.0',['class' => 'form-control']) }}

	        		{{ Form::label('volume','Volume') }}
	        		{{ Form::number('volume','0.0',['class' => 'form-control']) }}
    			</div>
	        </div><!-- end of row -->
	        {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
<div class="row">
	<div class="col-md-4">
		<div id="addVendorBox" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Vendor</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-primary mbtn" type="button" onclick="addVendor()">
					Add Vendor	        		
	        	</button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-6">
	        		{{ Form::label('vendor','Vendor') }}
        			{{ Form::select('vendor', [''=>'Pick a vendor','Consumable'=>'Consumable','Service'=>'Service'],
	        						null,['class' => 'form-control']) }}
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
        			{{ Form::number('vendor_quantity','0',['class' => 'form-control']) }}
    			</div>
	        	<div class="col-md-6">
	        		{{ Form::label('vendor_price','Price') }}
	        		{{ Form::number('vendor_price','0.0',['class' => 'form-control']) }}
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
          </div><!-- end of Box -->
	</div>
	<div class="col-md-8">
		<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Vendors</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="vendors_table" class="table table-striped">
                <tbody><tr>
                  <th>Vendor</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Produce Date</th>
                  <th>Expire Date</th>
                </tr>
              </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- end of Box -->
	</div><!-- end of col-md-12 -->
</div><!-- End of row-->
</div><!-- end of container -->
<script type="text/javascript">
var count = 1;
var vendors_table = document.getElementById("vendors_table");
//Function to add vendors to the vendor table
function addVendor(){
	var row = vendors_table.insertRow(count);

	var vendor_name = row.insertCell(0);
	vendor_name.innerHTML = $('#vendor').val();

	var vendor_qty = row.insertCell(1);
	vendor_qty.innerHTML = $('#vendor_quantity').val();

	var vendor_price = row.insertCell(2);
	vendor_price.innerHTML = $('#vendor_price').val();

	var product_produce_date = row.insertCell(3);
	product_produce_date.innerHTML = $('#vendor_produce').val();;

	var product_expiry_date = row.insertCell(4);
	product_expiry_date.innerHTML = $('#vendor_expiry').val();;

	count++;

}

</script>
@endsection
