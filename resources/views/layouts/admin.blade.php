@include('layouts.head')

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <!-- Main Header aka navbar -->
  @include('layouts.header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.sidebar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) 
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>
    -->

    <!-- Main content -->
    <section class="content">
      @if(Session::has('flash_msg'))
      <div class="alert m-alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i>{{ Session::get('flash_msg') }}</h4>
          <a data-dismiss="alert" aria-hidden="true">Dismiss</a>
      </div>
      @endif
      <!-- Your Page Content Here -->
      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- control right sidebar -->
  @include('layouts.rightSidebar')
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<!--
<script src="{{URL::to('/')}}/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
-->
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::to('/')}}/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/')}}/adminlte/dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
