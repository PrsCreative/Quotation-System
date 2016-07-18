<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$settings->company_name}} | Quotation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/bootstrap/css/bootstrap.min.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/adminlte/dist/css/AdminLTE.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body><!-- onload="window.print();">-->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> {{$settings->company_name}}
          <small class="pull-right">Date: {{date('d/m/Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>{{$settings->company_name}}</strong><br>
          {{$settings->address1}}<br>
          {{$settings->address2}}<br>
          {{$settings->phone}}<br>
          {{$settings->email}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{$quote->customer->customer_name}}</strong><br>
          {{$quote->customer->street.','.$quote->customer->city}}<br>
          {{$quote->customer->country}}<br>
          Phone: {{$quote->customer->phone.' '.$quote->customer->mobile}}<br>
          {{$quote->customer->email? 'Email:'.$quote->customer->email:''}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Quotation #00{{$quote->id}}</b><br>
        <br>
        <b>Issue Date:</b> {{date('j/m/Y',strtotime($quote->created_at))}}<br>
        <b>Expiry Date:</b> {{date('j/m/Y',strtotime($quote->expiry_date))}}<br>
        <b>Payment Term:</b> {{$quote->payment_term}}<br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $count = 0;
          $total = 0;
          ?>
          @foreach($items as $item)
          <tr>
            <td>{{++$count}}</td>
            <td>{{$item->product->product_name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->sale_price}}</td>
            <td>{{$item->subtotal}}</td>
          </tr>
          <?php $total += $item->subtotal; ?>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Terms & Conditions:</p>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Payment term: </p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%; font-weight:normal;">Subtotal:</th>
              <td>{{$total}}</td>
            </tr>
            <tr>
              <th><strong>Amount Due:</strong></th>
              <td>{{$total}}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
