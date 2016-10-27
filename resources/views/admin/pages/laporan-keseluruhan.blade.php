@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Kas
    </h3>
    
    <br />
    <button type="button" class="btn btn-success"><i class="fa fa-download"></i> Export</button>
    <button type="button" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
      
    <br /><br /><br /><br />
      
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-8 pull-right">
        <div class="col-md-2">
            <h5 style="margin-top:0.5em;"><strong>Periode</strong></h5>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span>
                <input type="date" class="form-control form-filter">
            </div>
        </div>
      </div>
      <br /><br /><br />
      <div class="col-md-12">
        <div class="portlet">
          <div class="portlet-body">
            <div class="laporan-kas">
              <p>Tanggal Transaksi:</p>
              <p>Nominal Top Up Kartu:</p>
              <p>Nominal Registrasi Kartu:</p>
              <p>Nominal Penarikan Saldo:</p>
            </div>
            <br/><br />
            <!-- print struk -->
            <div class="struk">
                <p>Tanggal Transaksi:</p>
                <p>Total Laporan Kas:</p>
            </div><!-- end of print struk --> 
                          
          </div>
        </div>
        <!-- End: life time stats -->
      </div>
    </div>
    <!-- END PAGE CONTENT-->
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER-->
@stop
