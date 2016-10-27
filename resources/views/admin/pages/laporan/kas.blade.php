@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Kas
    </h3>
    
    <br class="hidden-print"/>
    <button type="button" onclick="window.print();" class="btn btn-success pull-left hidden-print"><i class="fa fa-print"></i> Print</button>
      
    <br class="hidden-print" /><br class="hidden-print"/><br class="hidden-print"/>
      
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <br />
      <div class="col-md-12">
        <div class="portlet">
          <div class="portlet-body">
            <div class="laporan-kas">
              <p>Tanggal Transaksi : {{ $lastDate }}</p>
              <p>Nominal Top Up Kartu : Rp. {{ number_format($totalTopup) }}</p>
              <p>Nominal Registrasi Kartu : Rp. {{ number_format($totalRegister) }}</p>
              <p>Nominal Penarikan Saldo :  Rp. {{ number_format($totalTarik) }}</p>
            </div>
            <br/><br />
            <!-- print struk -->
            <div class="struk">
                <p>Total Laporan Kas : Rp. {{ number_format($totalTopup + $totalRegister - $totalTarik) }}</p>
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
