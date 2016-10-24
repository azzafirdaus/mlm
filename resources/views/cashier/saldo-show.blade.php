@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <div class="card cek-saldo">
                    <form class="saldo-form" action="{{ url('cashier/saldo') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
                        <h1 class="text-center">Cek Saldo</h1>
                        <div id ="hasil">
                            <br />  
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <div class="alert alert-success">
                                        <div class="container-fluid hasil">
                                            <i class="fa fa-info"></i>
                                            <b> Jumlah Saldo: </b>Rp {{ number_format($saldo) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" onclick="location.href = '{{ url('cashier/saldo') }}';" class="btn btn-info">
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