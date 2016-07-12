@extends('layouts.admin')

@section('content')
<div id="newCustomer" class="content-container">
<div class="row">
    <div class="col-md-12">
    <div class="box box-danger">
	    <div class="box-header with-border">
	        <h3 class="box-title">Quotations</h3>
	    </div>
	    <div class="box-body">
	    	<table id="table_quotations" class="table table-hover table-bordered table-striped dataTable">
		        <thead><tr>
		        	<td>ID</td>
		            <td>Customer</td>
		            <td>Expiry Date</td>
		            <td>Payment Term</td>
		            <td>Total</td>
		            <td>Status</td>
		            <td>More</td>
		        </tr></thead>
		        <tbody>
		        <tr>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td><a href="{{URL::to('/')}}"><i class="fa fa-fw fa-arrow-circle-right"></i></a></td>
		        </tr>
		        </tbody>
		        <tfoot><tr>
		        	<td>ID</td>
		            <td>Customer</td>
		            <td>Expiry Date</td>
		            <td>Payment Term</td>
		            <td>Total</td>
		            <td>Status</td>
		            <td>More</td>
		        </tr></tfoot>
    		</table>
	    </div><!-- End Box Body -->
    </div><!-- End Box -->
    </div><!-- end of col-md-12 -->
</div><!-- end of row -->
</div><!-- end of container -->
<!-- Datatables -->

<script src="{{URL::to('/')}}/adminlte/plugins/datatables/dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/adminlte/plugins/datatables/datatables.min.css"></link>



<script type="text/javascript">
jQuery('#table_quotations_filter :input').addClass('borka');
jQuery(function () {
    jQuery('#table_quotations').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": false,
    "responsive": true,
    "autoWidth": true
    });
});
</script>
@endsection
