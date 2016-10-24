@extends('layouts.master')

@section('content')
<body class="index-page centered centering"> 
    <div class="container">
        <div class="row register">
            <div class="col-md-6 col-md-push-3">
                <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>
                <div class="btn btn-success" onclick="">
                    &nbsp;&nbsp;Daftar&nbsp;&nbsp;
                    <div class="ripple-container"></div>
                </div>
                <br /><br /><br /><br />
                <div class="btn btn-info" onclick="location.href = '{{ url('player/saldo') }}';">
                    Cek Saldo
                    <div class="ripple-container"></div>
                </div>
                <br />
                <div class="btn btn-info text-center" onclick="location.href = '{{ url('player/kaki') }}';">
                    &nbsp;&nbsp;Cek Kaki&nbsp;&nbsp;
                    <div class="ripple-container"></div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
