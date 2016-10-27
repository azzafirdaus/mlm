@extends('layouts.master')

@section('content')
<body class="index-page centered">     
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <div class="card cek-saldo">
                    <form class="kaki-form" action="{{ url('player/daftar/kepala') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
                        <h1 class="text-center">Cek Kepala</h1>
                        @foreach ($errors->all() as $error)
                        <li style='font-size: 16px; color: red; text-align: center;'>{{ $error }}</li>
                        @endforeach
                        <div id ="hasil-isi" class="row">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" style='font-size: 24px;' placeholder="Nomor Kartu" name="idkartu" id="idkartu">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>
<body class="index-page centered"> 
<!-- <div class="btn btn-info pull-right" onclick="location.href = '{{ url('player/saldo') }}';">
    Cek Saldo
    <div class="ripple-container"></div>
</div> -->
@stop

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("idkartu").focus();
    }
</script>