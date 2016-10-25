@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo">
                    <form class="saldo-form" action="{{ url('cashier/saldo') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
                        <h1 class="text-center">Cek Saldo</h1>
                        <ul class="list-unstyled">
                             @foreach ($errors->all() as $error)
                            <li class="text-center" style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>
                        <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>

                        <div id ="hasil-isi" class="row">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" placeholder="Nomor Kartu" name="idkartu" id="idkartu">
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
                            <div class="col-md-4 col-md-push-4" style="padding-left:2em; padding-top:2em;">
                                <button type="submit" id="hasil-cek" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Cek
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

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("idkartu").focus();
    }
</script>