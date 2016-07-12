@extends('layouts.admin')

@section('content')
<div id="newQuote" class="content-container">
<div class="row">
    <div class="col-md-6">
    <div class="box box-success">
	    <div class="box-header with-border">
	        <h3 class="box-title">Customer Details</h3>
	    </div>
	    <div class="box-body">
	        {!! Form::open(['url'=>'quotation/new']) !!}
	        <div class="row{{ $errors->has('customer') ? ' has-error' : '' }}">
	        	<div class="col-md-12">
	        		{{ Form::label('customer','Customer name') }}
	        		{{ Form::text('customer','',['class' => 'form-control']) }}
    			</div>
    			<div class="col-md-12">
    				@if ($errors->has('customer'))
		                <span class="help-block col-md-12 error-msg">
		                    <strong>{{ $errors->first('customer') }}</strong>
		                </span>
		            @endif
    			</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		{{ Form::label('expiry_date', 'Expiry Date') }}
	        		{{ Form::date('expiry_date','',['class' => 'form-control']) }}
	        	</div>	        	
	        	<div class="col-md-6">
	        		{{ Form::label('payment_term', 'Payment Term') }}
	        		<?php 
	        			$payment_terms = [''=>'Pick a term', '15 Days'=>'15 Days','30 Days Net'=>'30 Days Net',
	        							  'Immediate Payment'=>'Immediate Payment']; 
	        		?>
	        		{{ Form::select('payment_term',$payment_terms,null,['class' => 'form-control']) }}
	        	</div>	
	        </div>
	        {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-6 -->


	<div class="col-md-6">
    <div class="box box-primary">
    	{!! Form::open(['url'=>'quotations/new']) !!}
	    <div class="box-header with-border">
	        <h3 class="box-title">Add Items</h3>
	        <div class="box-tools">
	        	<button class="btn btn-primary mbtn" type="button" onclick="addItem()">
					Add Item	        		
	        	</button>
            </div>
	    </div>
	    <div class="box-body">
	        
	        <div class="row{{ $errors->has('exam_date') ? ' has-error' : '' }}">
	        	<div class="col-md-6">
	        		{{ Form::label('item_name','Product name') }}
	        		{{ Form::text('item_name','',['class' => 'form-control']) }}
	        		<div class="col-md-6">
    				@if ($errors->has('item_name'))
		                <span class="help-block col-md-12 error-msg">
		                    <strong>{{ $errors->first('item_name') }}</strong>
		                </span>
		            @endif
    				</div>
    			</div>
    			<div class="col-md-6">
	        		{{ Form::label('item_price','Unit Price') }}
	        		{{ Form::text('item_price','100',['class' => 'form-control', 'readonly' => 'true']) }}
    			</div>

    			
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		{{ Form::label('item_qty', 'Quantity') }}
	        		{{ Form::number('item_qty','1',['class' => 'form-control']) }}
	        	</div>	        	
	        	<div class="col-md-6">
	        		{{ Form::label('item_description', 'Description') }}
	        		{{ Form::text('item_description','',['class' => 'form-control']) }}
	        	</div>	
	        </div>
	    {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-6 -->
</div><!-- end of row -->
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Items</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="items_table" class="table table-striped">
                <tbody><tr>
                  <th>ID</th>
                  <th>Item name</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Subtotal</th>
                </tr>
              </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- end of Box -->
	</div><!-- end of col-md-12 -->
</div><!-- End of row-->
<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Terms & Condition</h3>
				(Leave empty to insert default terms).
			</div><!-- end of box-header -->
			<div class="box-body">
        		{{ Form::textarea('terms','',['class' => 'form-control']) }}
			</div><!-- end of box-header -->

		</div><!-- end of box -->
	</div><!-- end of col-md-6 -->
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-body">
				<div class="table-responsive">
	            <table class="table">
	              <tbody><tr>
	                <th style="width:50%">Subtotal:</th>
	                <td><span id="subtotal"></span></td>
	              </tr>
	              <tr>
	                <th>Shipping:</th>
	                <td>$5.80</td>
	              </tr>
	              <tr>
	                <th>Total:</th>
	                <td><span id="total"></span></td>
	              </tr>
	            </tbody></table>
	          </div><!-- end of div table -->
			</div><!-- end of box-header -->

		</div><!-- end of box -->
	</div><!-- end of col-md-6 -->
</div><!-- End of row-->
</div><!-- end of container -->
<script type="text/javascript">
var count = 1;
var total = 0;
var items_table = document.getElementById("items_table");
//Function to add items to the table
function addItem(){
	var row = items_table.insertRow(count);
	var price = $('#item_price').val();
	var qty = $('#item_qty').val();
	var subtotal = qty * price;

	var id = row.insertCell(0);
	id.innerHTML = count++;

	var item_name = row.insertCell(1);
	item_name.innerHTML = $('#item_name').val();

	var item_desc = row.insertCell(2);
	item_desc.innerHTML = $('#item_description').val();

	var item_qty = row.insertCell(3);
	item_qty.innerHTML = qty;

	var item_price = row.insertCell(4);
	item_price.innerHTML = price;

	var item_subtotal = row.insertCell(5); 
	item_subtotal.innerHTML = subtotal;

	total += subtotal;
	document.getElementById('subtotal').innerHTML = total;
}

</script>
@endsection
