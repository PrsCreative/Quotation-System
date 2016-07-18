@extends('layouts.admin')

@section('content')
<div id="newCustomer" class="content-container">
<div class="row">
    <div class="col-md-12">
    <div class="box box-danger">
	    <div class="box-header with-border">
	        <h3 class="box-title">General Settings</h3>
	    </div>
	    <div class="box-body">
	       	{!! Form::open(['url'=>'saveSettings','id'=>'settingsForm', 'method'=>'post']) !!}
			<div class="form-group {{$errors->has('company_name') ? 'has-error' : ''}}">
				{{ Form::label('company_name','Company Name') }}
				{{ Form::text('company_name',$settings->company_name,['class' => 'form-control','placeholder'=>'Company name' ]) }}
			</div>
			<div class="form-group {{$errors->has('address1') ? 'has-error' : ''}}">
				{{ Form::label('address1','Address line 1') }}
				{{ Form::text('address1',$settings->address1,['class' => 'form-control','placeholder'=>'Address line 1' ]) }}
			</div>
			<div class="form-group {{$errors->has('address2') ? 'has-error' : ''}}">
				{{ Form::label('address2','Address line 2') }}
				{{ Form::text('address2',$settings->address2,['class' => 'form-control','placeholder'=>'Address line 2' ]) }}
			</div>
			<div class="form-group {{$errors->has('country') ? 'has-error' : ''}}">
				{{ Form::label('country','Country') }}
				{{ Form::text('country',$settings->country,['class' => 'form-control','placeholder'=>'Country' ]) }}
			</div>
			<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
				{{ Form::label('email','Email (this will be shown in the quotations)') }}
				{{ Form::email('email',$settings->email,['class' => 'form-control','placeholder'=>'Email e.g. hello@somecompany.com' ]) }}
			</div>
			<div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
				{{ Form::label('phone','Phone') }}
				{{ Form::text('phone',$settings->phone,['class' => 'form-control','placeholder'=>'Phone' ]) }}
			</div>
			<div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
				{{ Form::label('mobile','Mobile') }}
				{{ Form::text('mobile',$settings->mobile,['class' => 'form-control','placeholder'=>'Mobile' ]) }}
			</div>
			<div class="form-group {{$errors->has('terms') ? 'has-error' : ''}}">
				{{ Form::label('terms','Terms and Conditions') }}
				{{ Form::textarea('terms',$settings->terms,['class' => 'form-control','placeholder'=>'Terms and Conditions' ]) }}
			</div>
			   
	    </div><!-- End Box Body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-danger">Submit</button>
		</div>	        	
		{!! Form::close() !!}
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
</div><!-- end of container -->
<script type="text/javascript">

</script>
@endsection
