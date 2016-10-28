@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Registrasi Kartu
    </h3>
      
    <br /><br /><br /><br />
    
    <!-- BEGIN PAGE CONTENT-->
		<div class="row">
            <form class="top-tanggal-form" action="{{ url('admin/laporan/register') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
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
                            <button class="btn btn-default" type="submit"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="date" max="{{ date('Y-m-d') }}" class="form-control form-filter" name="startdate" value="{{ isset($startdate)? $startdate : ''}}">
                        </div>
                    </div>
                     <div class="col-md-1">
                        <p style="margin-top:0.3em;">To:</p>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="date" max="{{ date('Y-m-d') }}" class="form-control form-filter" name="enddate" value="{{ isset($enddate)? $enddate : ''}}">
                        </div>
                    </div>
                </div>
                <br /><br /><br />
                <div class="col-md-12">
                    <div class="portlet">
                        <div class="portlet-body">
                            <p class="hidden">{{ $count = 1 }}</p>
                            <!-- print struk -->
                            <div class="struk">
                                <p>Tanggal Transaksi : {{ isset($startdate) ? $startdate : 'start' }} - {{ isset($enddate) ? $enddate : 'last' }}</p>
                                <p>Total Nominal : Rp. {{ number_format($jumlah) }} </p>
                                <p>Total Top Up Kartu : {{ count($data) }}</p>
                            </div><!-- end of print struk --> 
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
                                        
                                        @foreach($data as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $count++ }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->idkartu }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('Y-m-d', strtotime($item->tanggal)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->jenis }}
                                            </td>
                                            <td class="text-center">
                                                Rp. {{ number_format($item->total) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->namakasir }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
	        </form>
        </div>
		<!-- END PAGE CONTENT-->

      
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER-->
<!-- CONTENT BODY GOES HERE >>>> -->
@stop