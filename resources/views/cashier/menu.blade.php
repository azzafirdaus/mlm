@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">        
        <div class="row">
            <div class="col-md-10 col-md-push-1">
                <div class="card cek-saldo cek-topup">
                    <h1 class="text-center">Cashier Menu</h1>
                    <div class="row">
                        <div class="col-md-10 col-md-push-1">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-md-push-1">
                            <button type="button" onclick="location.href = '{{ url('cashier/saldo') }}';" class="btn btn-primary btn-cashier">
                                <i class="fa fa-search"></i>
                                Cek Saldo
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                        <div class="col-md-3 col-md-push-1">
                            <button class="btn btn-primary btn-cashier" data-toggle="modal" data-target="#openMd1">
                                <i class="fa fa-credit-card"></i>
                                Open Transaction
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-md-12 col-md-push-1" style="padding-left:0;">
                            <div class="col-md-12 text-center" style="padding-left: 2.8em; padding-right:0;">
                                <ul>
                                     @foreach ($errors->all() as $error)
                                    <li style='font-size: 16px; color: red'>{{ $error }}</li>
                                     @endforeach
                                <p style='font-size: 16px; color: green; margin-top:-2em!important;'>{{ isset($success)? $success : '' }}</p>

                                <?='<span style="font-size: 16px; color: red">'.Session::get('condition').'</span>'?>
                                </ul>
                                <br />
                                <ul class="nav nav-pills" role="tablist">
                                    <li>
                                        <a href="{{ url('cashier/register') }}">
                                            <i class="fa fa-user"></i>
                                            <br />
                                            Register
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('cashier/topup') }}">
                                            <i class="fa fa-money"></i>
                                            <br />
                                            Top Up Kartu
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('cashier/tarik') }}">
                                            <i class="fa fa-dollar"></i>
                                            <br />
                                            Tarik Saldo
                                        </a>
                                    </li>
                               </ul>
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="row form-actions">
                        <div class="col-sm-8">
                            <button type="button" onclick="location.href = '{{ url('auth/cashierlogout') }}';" class="btn btn-info">
                                <i class="fa fa-sign-out"></i>
                                Logout
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                        <div class="col-sm-2" style="padding-left:4.5em;">                
                            <button type="button" onclick="location.href = '{{ url('cashier/kaki') }}';" class="btn btn-success">
                                <span class="glyphicon glyphicon-list"></span> Cek Kaki
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN MODAL-->
    <!-- MODAL 1-->
    <div id="openMd1" class="modal fade" tabindex="-1" aria-hidden="true">  
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title">Anda yakin ingin membuka transaksi?</h3>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-success" id="openTrans" data-toggle="modal" data-target="#openMd2">Lanjut</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL 2-->
    <div id="openMd2" class="modal fade" tabindex="-1" aria-hidden="true">
        <form class="login-form" action="{{ url('cashier/opentransaction') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h3 class="modal-title">Masukkan kata sandi Anda</h3>
                    </div>
                    <div class="modal-body">
                        <div class="scroller" data-always-visible="1" data-rail-visible1="1">
                            <p>
                                <input type="password" class="form-control" name="password" id="password" />
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                        <button type="submit" class="btn btn-success" id="openTrans">Lanjut</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL-->
</body>
@stop

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("password").focus();
    }
</script>