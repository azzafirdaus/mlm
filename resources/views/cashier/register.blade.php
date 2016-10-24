@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <form class="form" action="{{ url('cashier/register') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <div class="card cek-saldo cek-topup">
                        <h1 class="text-center">Register Customer</h1>
                        <ul>
                             @foreach ($errors->all() as $error)
                            <li style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>
                        <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>
                        
                        <div class="form-group">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" autocomplete="off" placeholder="Saldo Kartu" name="saldo">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" autocomplete="off" placeholder="Nomor Kartu" name="idkartu">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br /><br/>
                        <div class="form-actions">
                            <div class="col-md-4">
                                <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                    <i class="fa fa-angle-left"></i>
                                    Back
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                            <div class="col-md-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-regis">
                                    <i class="fa fa-check"></i>
                                    Daftar
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

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("idkartu").focus();
    }
</script>