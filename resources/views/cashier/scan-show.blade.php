@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <div class="card cek-saldo">
                    <form class="saldo-form" action="{{ url('cashier/scan') }}" method="get">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
                        <h1 class="text-center">Cek Scan Kartu</h1>
                        <div id ="hasil">
                            <br />  
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <div class="alert alert-success">
                                        <div class="container-fluid hasil">
                                            <i class="fa fa-info"></i>
                                            &nbsp;<b> Jumlah Scan: </b>{{ $scan }} kali
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-4 col-md-pull-1" style="padding-left:0; padding-top:0;">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-angle-left"></i>
                                    Back
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@stop