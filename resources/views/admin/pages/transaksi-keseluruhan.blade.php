@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title" style="font-size:28px;">
        Transaksi Keseluruhan
        </h3>
        <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-success pull-left">
            <span class="glyphicon glyphicon-download-alt"></span> Export
        </button>  
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<!-- END PAGE HEADER-->
<br>
<!-- BEGIN CRUD TABLE -->
<div class="portlet-body">
    <div class="table-responsive">
    <table id="table" class="table table-hover customFontSize">

        <thead>
            <tr>
                <th class="customFontSize">
                     Tanggal Transaksi
                </th>
                <th class="customFontSize">
                     {{ $lastDate }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                     Nominal Top Up Kartu
                </td>
                <td>
                     Rp. {{ number_format($totalTopup) }}
                </td>
            </tr>
            <tr>
                <td>
                     Nominal Registrasi
                </td>
                <td>
                     Rp. {{ number_format($totalRegister) }}
                </td>
            </tr>
            <tr>
                <td>
                     Nominal Tarik Tunai
                </td>
                <td>
                     Rp. {{ number_format($totalTarik) }}
                </td>
            </tr>
            <tr>
                <td>
                     Total
                </td>
                <td>
                     Rp. {{ number_format($totalTopup + $totalRegister - $totalTarik) }}
                </td>
            </tr>
        </tbody>

    </table>


    <br>  

    
</div>
<!-- END CRUD TABLE -->
@stop



