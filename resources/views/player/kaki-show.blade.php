@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
   <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo cek-topup daftar-kaki">
                    <h1 class="text-center">Daftar Kaki</h1>
                    <br /><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn btn-primary col-md-4 col-md-push-2 text-center">
                                Kepala
                                <div class="ripple-container"></div>
                            </div>
                        </div>
                    </div>
                    <br /><br /><br />
                    <div class="row">
                        <div class="col-md-4 col-md-push-2">
                            <hr class="line-rotate-min"/>
                        </div>
                        <div class="col-md-4 col-md-push-2">
                            <hr class="line-rotate"/>
                        </div>
                    
                    </div>
                    <br /><br /><br />
                    <div class="row">
                        <div class="col-md-4 col-md-push-1">
                            <div class="btn btn-default" @if($jumlahkaki >= 1) style="background-color: maroon" @endif >
                                &nbsp;Kaki Bawah
                                <div class="ripple-container"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-md-push-1" style="padding-top:1.5em;">
                            <hr />
                        </div>
                        <div class="col-md-4 col-md-push-1">
                            <div class="btn btn-default pull-right" @if($jumlahkaki == 2) style="background-color: maroon" @endif>
                                &nbsp;Kaki Bawah
                                <div class="ripple-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="padding-left:0; padding-top:3em; margin-left:-2em;">
                            <button type="button" onclick="location.href = '{{ url('player/kaki') }}';" class="btn btn-info">
                                <i class="fa fa-angle-left"></i>
                                Back
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop