@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Tarik Tunai
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
                <div class="col-md-1">
                    <p style="margin-top:0.3em;">From:</p>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                        <input type="date" class="form-control form-filter">
                    </div>
                </div>
                 <div class="col-md-1">
                    <p style="margin-top:0.3em;">To:</p>
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
						<div class="table-container">
							<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="5%" class="text-center">
                                         No.
                                    </th>
                                    <th class="text-center">
                                         No. Kartu
                                    </th>
                                    <th class="text-center">
                                         Tanggal
                                    </th>
                                    <th class="text-center">
                                         Transaksi
                                    </th>
                                    <th class="text-center">
                                         Jumlah Saldo
                                    </th>
                                    <th class="text-center">
                                         Nama Kasir
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">xx</td>
                                        <td class="text-center">xx</td>
                                        <td class="text-center">xx</td>
                                        <td class="text-center">xx</td>
                                        <td class="text-center">xx</td>
                                    </tr>
                                </tbody>
							</table>
						</div>
                        
                        <!-- print struk -->
                        <div class="struk">
                            <p>Tanggal Transaksi:</p>
                            <p>Total Nominal:</p>
                            <p>Total Tarik Tunai:</p>
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
<!-- CONTENT BODY GOES HERE >>>> -->
@stop