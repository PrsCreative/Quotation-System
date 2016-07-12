@extends('layouts.admin')

@section('content')
<div id="newProduct" class="content-container">
<div class="row">
    <div class="col-md-12">
    <div class="box box-success">
	    <div class="box-header with-border">
	        <h3 class="box-title">Product Details</h3>
	    </div>
	    <div class="box-body">
	    	@if($product->product_type != '')
	        	{!! Form::open(['url'=>'products/'.$product->id,'id'=>'productForm', 'method'=>'PUT']) !!}
	        	
	        @else
	        	{!! Form::open(['url'=>'products','id'=>'productForm', 'method'=>'POST']) !!}
	        @endif
	        <div class="row">
	        	<div class="col-md-6 left-section">
	        		<div class="row">
	        		<div class="col-md-6">
	        		
		        		{{ Form::label('product_type','Product Type') }}
		        		{{ Form::select('product_type', [''=>'Pick a type','Consumable'=>'Consumable','Service'=>'Service'],
		        						$product->product_type,['class' => 'form-control']) }}
	        		</div>
	        		</div>

	        		{{ Form::label('product_name','Product name') }}
	        		{{ Form::text('product_name',$product->product_name,['class' => 'form-control']) }}

	        		{{ Form::label('internal_reference','Internal Reference') }}
	        		{{ Form::text('internal_reference',$product->internal_reference,['class' => 'form-control']) }}

	        		{{ Form::label('barcode','Barcode') }}
	        		{{ Form::text('barcode',$product->barcode,['class' => 'form-control']) }}
    			</div>
    			<div class="col-md-6">
	    			{{ Form::label('sale_price','Sale Price') }}
	        		{{ Form::number('sale_price',$product->sale_price,['class' => 'form-control']) }}

	        		{{ Form::label('cost','Cost') }}
	        		{{ Form::number('cost',$product->cost,['class' => 'form-control']) }}

	        		{{ Form::label('weight','Weight') }}
	        		{{ Form::number('weight',$product->weight,['class' => 'form-control']) }}

	        		{{ Form::label('volume','Volume') }}
	        		{{ Form::number('volume',$product->volume,['class' => 'form-control']) }}
    			</div>
	        </div><!-- end of row -->
	        {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
</div><!-- end of container -->
<script type="text/javascript">
function submitForm(){
	$('#productForm').submit();
}
</script>
@endsection
