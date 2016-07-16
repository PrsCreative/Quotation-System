<!DOCTYPE html>
<html class="login-page">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ isset($title)? $title : 'Login' }} | themall</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/bootstrap/css/bootstrap.min.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/dist/css/AdminLTE.css"/>
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/dist/css/skins/skin-red.css"/>
  <!-- My CSS -->
  <link rel="stylesheet" href="{{URL::to('/')}}/css/style.css"/>
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/plugins/iCheck/square/red.css">
  <!-- jQuery 2.2.0 -->
  <script src="{{URL::to('/')}}/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src="{{URL::to('/')}}/adminlte/plugins/iCheck/icheck.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Quotation</b> System</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="checkbox icheck">
                        <label>
                        <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div><!-- /.col-xs-8 -->
                <div class="col-md-4">
                    <button type="submit" class="btn login-btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div><!-- /.col -->
                <div class="col-md-12 text-center">
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>
        </form>
</div>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>