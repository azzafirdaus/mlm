@extends('layouts.master')

@section('content')
<body class="index-page centered centering"> 
    <div class="container">
        <div class="row register">
            <div class="col-md-6 col-md-push-3">
                @foreach ($errors->all() as $error)
                <li style='font-size: 16px; color: white'>{{ $error }}</li>
                @endforeach
                
                <div class="btn btn-success" onclick="location.href = '{{ url('player/daftar') }}';">
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
