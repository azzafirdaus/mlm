@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo reset-kartu">
                    <form class="saldo-form" action="{{ url('cashier/tarik') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h1 class="text-center">Tarik Tunai</h1>

                        @foreach ($errors->all() as $error)
                        <li style='font-size: 16px; color: red; text-align: center;'>{{ $error }}</li>
                        @endforeach

                        <!-- addition -->
                        <div class="row">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" style='font-size: 24px;' placeholder="Jumlah Saldo Dikurangi" name="jumlahtarik" id="jumlah-auto">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end of addition -->

                        <div class="row">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" style='font-size: 24px;' placeholder="Nomor Kartu" name="idkartu" id="idkartu">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-4 col-md-pull-1" style="padding-left:3em; padding-top:2em;">
                                <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                    <i class="fa fa-angle-left"></i>
                                    Back
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                            <div class="col-md-4 col-md-push-3" style="padding-left:3em; padding-top:2em;">
                                <button type="submit" id="hasil-cek" class="btn btn-primary">
                                    <i class="fa fa-credit-card"></i>
                                    Submit
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