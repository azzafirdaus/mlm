@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
   <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo cek-topup daftar-kaki">
                    <h1 class="text-center">Daftar Kaki</h1>
                    <input type="hidden" name="idkepala" value="{{ $idkepala }}">
                    @foreach ($errors->all() as $error)
                    <li style='font-size: 16px; color: red; text-align: center'>{{ $error }}</li>
                    @endforeach
                    <p style='font-size: 16px; color: green; text-align: center;'>{{ isset($success) ? $success : ''}}</p>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary col-md-4 col-md-push-2 text-center" onclick="location.href = '{{ url('player/daftar/kepala') }}';" 
                                @if($idkepala == '') style="background-color: grey" 
                                @elseif(isset($idkepala)) disabled 
                                @endif
                            >
                                Kepala
                                <div class="ripple-container"></div>
                            </button>
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
                            <button class="btn btn-default"  onclick="location.href = '{{ url('player/daftar/kaki') }}';" 
                                @if($jumlahkaki == 0) style="background-color: green" 
                                @elseif($jumlahkaki >= 1 && $jumlahkaki <= 2) style="background-color: maroon" disabled 
                                @else disabled 
                                @endif
                            >
                                &nbsp;Kaki Bawah
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                        
                        <div class="col-md-2 col-md-push-1" style="padding-top:1.5em;">
                            <hr />
                        </div>
                        <div class="col-md-4 col-md-push-1">
                            <button class="btn btn-default pull-right" onclick="location.href = '{{ url('player/daftar/kaki') }}';" 
                                @if($jumlahkaki <= 1) style="background-color: green" 
                                @elseif($jumlahkaki == 2) style="background-color: maroon" disabled
                                @else disabled 
                                @endif
                            >
                                &nbsp;Kaki Bawah
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
<script>
    window.onload = function() {
        setTimeout(function(){ location.href = "{{ url('player') }} "; }, 5000);
    };
</script>