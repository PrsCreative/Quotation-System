@extends('layouts.admin')

@section('content')
<div id="newCustomer" class="content-container">
<div class="row">
    <div class="col-md-12">
    <div class="box box-danger">
	    <div class="box-header with-border">
	        <h3 class="box-title">Customer Details</h3>
	    </div>
	    <div class="box-body">
	    	@if($customer->customer_type != '')
	        	{!! Form::open(['url'=>'customers/'.$customer->id,'id'=>'customerForm', 'method'=>'put']) !!}
	        @else
	        	{!! Form::open(['url'=>'customers','id'=>'customerForm','method'=>'POST']) !!}
	        @endif

	        <div class="row">
	        	<div class="col-md-6 left-section">
	        		<h3 class="box-title">Details</h3>
	        		<div class="row">
	        		<div class="col-md-6">

		        		{{ Form::label('customer_type','Customer Type') }}
		        		{{ Form::select('customer_type', [''=>'Pick a type','Individual'=>'Individual','Company'=>'Company'],$customer->customer_type,
		        		['class' => $errors->has('customer_type') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('customer_type'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('customer_type') }}</strong>
                			</span>
            			@endif
	        		</div>
	        		<div class="col-md-6">
	        			{{ Form::label('customer_vendor','Customer Or Vendor') }}
	        			{{ Form::select('customer_vendor', [''=>'Pick a type','Customer'=>'Customer','Vendor'=>'Vendor'],$customer->customer_vendor,
	        			['class' => $errors->has('customer_vendor') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('customer_vendor'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('customer_vendor') }}</strong>
                			</span>
            			@endif
	        		</div>
	        		</div>

	        		{{ Form::label('customer_name','Customer name') }}
	        		{{ Form::text('customer_name',$customer->customer_name,
	        		['class' => $errors->has('customer_name') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('customer_name'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('customer_name') }}</strong>
                			</span>
            			@endif
	        		<div id="company_div">
	        		{{ Form::label('company_name','Company name') }}
	        		{{ Form::text('company_name',$customer->company_name,[
	        		'class' => $errors->has('company_name') ? 'form-control danger' : 'form-control',
					$customer->customer_type == 'Individual'? 'readonly' :'' ]) }}
						@if ($errors->has('company_name'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('company_name') }}</strong>
                			</span>
            			@endif
	        		</div>
	        		{{ Form::label('job_position','Job Position') }}
	        		{{ Form::text('job_position',$customer->job_position,['placeholder'=>'e.g. Sales Manager',
	        		'class' => $errors->has('job_position') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('job_position'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('job_position') }}</strong>
                			</span>
            			@endif
    			</div>
    			<div class="col-md-6">
    				<h3 class="box-title">Address</h3>
	    			{{ Form::label('street','Street') }}
	        		{{ Form::text('street',$customer->street,
	        		['class' => $errors->has('street') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('street'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('street') }}</strong>
                			</span>
            			@endif
	        		{{ Form::label('city','City') }}
	        		{{ Form::text('city',$customer->city,
	        		['class' => $errors->has('city') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('city'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('city') }}</strong>
                			</span>
            			@endif
	        		{{ Form::label('country','Country') }}
	        		{{ Form::text('country',$customer->country? $customer->country : 'United Arab Emirates',
	        		['class' => $errors->has('country') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('country'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('country') }}</strong>
                			</span>
            			@endif
	        		{{ Form::label('website','Website') }}
	        		{{ Form::text('website',$customer->website,['placeholder'=>'with http://',
	        		'class' => $errors->has('website') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('website'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('website') }}</strong>
                			</span>
            			@endif
    			</div>
	        </div><!-- end of row -->
	        <div id="contactRow" class="row">
	        	<div class="col-md-6 left-section">
	        		<h3 class="box-title">Contact</h3>
	        		{{ Form::label('phone','Work Phone') }}
	        		{{ Form::text('phone',$customer->phone,
	        		['class' => $errors->has('phone') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('phone'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('phone') }}</strong>
                			</span>
            			@endif
	        		{{ Form::label('mobile','Mobile') }}
	        		{{ Form::text('mobile',$customer->mobile,
	        		['class' => $errors->has('mobile') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('mobile'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('mobile') }}</strong>
                			</span>
            			@endif
	        		{{ Form::label('email','Email') }}
	        		{{ Form::text('email',$customer->email,
	        		['class' => $errors->has('email') ? 'form-control danger' : 'form-control' ]) }}
						@if ($errors->has('email'))
                			<span class="help-block col-md-12 error-msg">
                			<strong>{{ $errors->first('email') }}</strong>
                			</span>
            			@endif
	        	</div>	        	
	        	<div class="col-md-6">
	        		
	        	</div>	
	        </div><!-- end of row -->
	        {!! Form::close() !!}
	        
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
</div><!-- end of container -->
<script type="text/javascript">
$('#customer_type').on('change',function(){
	if($(this).val() == 'Individual'){
		 document.getElementById('company_name').readOnly = true;
	}
	else{
		document.getElementById('company_name').readOnly = false;
	}
});
function submitForm(){
	$('#customerForm').submit();
}
</script>
@endsection
