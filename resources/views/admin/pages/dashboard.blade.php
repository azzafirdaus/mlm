@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Dashboard
    </h3>
    
    <br />
    <h4>Total Transaksi: {{ isset($total)? $total : 0}}</h4>
    <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
</div>
<!-- END PAGE HEADER-->
@stop



