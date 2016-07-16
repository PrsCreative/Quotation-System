@extends('layouts.admin')

@section('content')
{{$customer_name = ''}}
<div id="newQuote" class="content-container">
<div class="row">
    <div class="col-md-6">
    <div class="box box-success">
	    <div class="box-header with-border">
	        <h3 class="box-title">Customer Details</h3>
			<div class="box-tools">
				<button id="editCustomerBtn" style="display:none;" class="btn btn-success mbtn" 
				type="button">Edit</button>
			</div>
	    </div><!-- end of box-header with-border -->
	    <div class="box-body">
	        {!! Form::open(['url'=>'quotation/new', 'id'=>'quoteForm']) !!}
	        <div class="row{{ $errors->has('customer') ? ' has-error' : '' }}">
	        	<div id="customerm" class="col-md-12 selectm">
					<input type="hidden" id="customer_id" name="customer_id" value="{{$quote->customer_id}}" />
					{{ Form::label('customer','Customer name') }}
					<select id="customer" class="form-control">
						<option {{$quote->customer_id? '':'selected'}}>Pick a Customer</option>
						<?php
						foreach($customers as $customer){
							$selected = '';
							if($quote->customer_id == $customer->id){
									$selected = 'selected';
									$customer_name = $customer->customer_name;
							} 
						?>
						<option value="{{$customer->id}}" {{$selected}}>{{$customer->customer_name}}</option>
						<?php
						}//end foreach
						?>
					</select>
					<span class="help-block col-md-12 error-msg">
						<strong id="error_customer_id"></strong>
					</span>
    			</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		{{ Form::label('expiry_date', 'Expiry Date') }}
	        		{{ Form::date('expiry_date',$quote->expiry_date,['class' => 'form-control']) }}
					<span class="help-block col-md-12 error-msg">
						<strong id="error_expiry_date"></strong>
					</span>
	        	</div>	        	
	        	<div class="col-md-6">
	        		{{ Form::label('payment_term', 'Payment Term') }}
	        		<?php 
	        			$payment_terms = [''=>'Pick a term', '15 Days'=>'15 Days','30 Days Net'=>'30 Days Net',
	        							  'Immediate Payment'=>'Immediate Payment']; 
	        		?>
	        		{{ Form::select('payment_term',$payment_terms,$quote->payment_term,['class' => 'form-control']) }}
					<span class="help-block col-md-12 error-msg">
						<strong id="error_payment_term"></strong>
					</span>
	        	</div>	
	        </div>
	        {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-6 -->


	<div class="col-md-6">
    <div class="box box-primary">
    	{!! Form::open(['url'=>'quotations/new', 'id'=>'itemForm']) !!}
	    <div class="box-header with-border">
	        <h3 class="box-title">Add Items</h3>
	        <div class="box-tools">
						<button id="startAdd" class="btn btn-info mbtn" type="button">
							Start Adding	        		
	        	</button>
	        	<button id="addItem" style="display:none;" class="btn btn-primary mbtn" type="button">
							Add Item	        		
	        	</button>
          </div>
	    </div>
	    <div class="box-body">
	        <div class="row">
				<div class="col-md-6 selectm">
						<input type="hidden" id="quote_id" name="quote_id" value="{{$quote->id}}" />
						<input type="hidden" id="product_id" name="product_id" value="" />
				{{ Form::label('item_name','Product name') }}
				<select id="item_name" class="form-control">
					<option selected="selected">Pick an item</option>
					@foreach($products as $product)
					<option value="{{$product->id}}">{{$product->product_name}}</option>
					@endforeach
				</select>

				<span class="help-block col-md-12 error-msg">
						<strong id="error_item_name"></strong>
				</span>
				
				</div>
				
				<div class="col-md-6">
					<div class="col-md-6">
							{{ Form::label('item_price','Unit Price') }}
							{{ Form::text('item_price','0',['class' => 'form-control']) }}
					</div>
					<div class="col-md-6">
							{{ Form::label('item_price_orig','Original Price') }}
							{{ Form::text('item_price_orig','0',['class' => 'form-control', 'readonly' => 'true']) }}
					</div>
					<span class="help-block col-md-12 error-msg">
						<strong id="error_item_price"></strong>
					</span>
				</div>   			
	        </div>
	        <div class="row">
	        	<div class="col-md-3">
	        		{{ Form::label('item_qty', 'Quantity') }}
	        		{{ Form::number('item_qty','1',['class' => 'form-control']) }}
	        	</div>
				<div class="col-md-3">
	        		{{ Form::label('item_qty_total', 'Available') }}
	        		{{ Form::number('item_qty_total','',['class' => 'form-control','readonly'=>'true']) }}
	        	</div>	 	        	
	        	<div class="col-md-6">
	        		{{ Form::label('item_description', 'Description') }}
	        		{{ Form::text('item_description','',['class' => 'form-control', 'placeholder'=>'Optional']) }}
	        	</div>
				<span class="help-block col-md-12 error-msg">
						<strong id="error_item_qty"></strong>
				</span>	
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
            <div class="box-body table-responsive">
              <table id="items_table" class="table table-striped table-responsive">
					<thead>
						<tr>
							<th>ID</th>
							<th>Item name</th>
							<th>Description</th>
							<th>Qty</th>
							<th>Unit Price</th>
							<th>Subtotal</th>
						</tr>
					</thead>
                <tbody>
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
	              <tbody>
								<!--<tr>
	                <th style="width:50%">Subtotal:</th>
	                <td><span id="subtotal"></span></td>
	              </tr>
	              <tr>
	                <th>Shipping:</th>
	                <td>$5.80</td>
	              </tr>-->
	              <tr>
	                <th>Total:</th>
	                <td><span id="total">0.00 AED</span></td>
	              </tr>
	            </tbody></table>
	          </div><!-- end of div table -->
			</div><!-- end of box-header -->

		</div><!-- end of box -->
	</div><!-- end of col-md-6 -->
</div><!-- End of row-->
</div><!-- end of container -->
<!-- select2 js -->
<script src="{{URL::to('/')}}/adminlte/plugins/select2/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/adminlte/plugins/select2/select2.min.css">
<!-- datatabl js -->
<script src="{{URL::to('/')}}/adminlte/plugins/datatables/dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/adminlte/plugins/datatables/datatables.min.css"></link>
<!-- variables needed to be initialized through blade/php -->
<script>
var searchProductUrl = "{{URL::to('/search/products/')}}/";
var searchInventoryUrl = "{{URL::to('/search/inventory/')}}/";
var host = "{{URL::to('/')}}";
var customer_name = "{{$customer_name}}";
</script>
<!-- quotation js functions -->
<script type="text/javascript" src="{{URL::to('/')}}/js/quote.js"></script>
@endsection
