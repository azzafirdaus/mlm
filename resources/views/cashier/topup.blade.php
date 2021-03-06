@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <form class="form" action="{{ url('cashier/topup') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div class="card cek-saldo cek-topup">
                        <h1 class="text-center form-title hidden-print">Top Up Saldo</h1>
                         @foreach ($errors->all() as $error)
                        <li style='font-size: 16px; color: red; text-align: center;'>{{ $error }}</li>
                         @endforeach

                        <div class="form-group hidden-print">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" type="text" style='font-size: 24px;' autocomplete="off" placeholder="Jumlah Top Up" name="jumlahtopup" id="jumlah-auto">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group hidden-print">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" type="text" style='font-size: 24px;' autocomplete="off" placeholder="Nomor Kartu" name="idkartu" id="idkartu">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-actions hidden-print">
                            <div class="col-md-4 col-md-pull-1" style="padding-left:3em; padding-top:2em;">
                                <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Back
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                            <div class="col-md-4 col-md-push-2" style="padding-top:2em;">
                                <button type="submit" id="lihat" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Submit
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
@stop
