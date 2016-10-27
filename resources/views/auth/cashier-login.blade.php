@extends('layouts.master')

@section('content')
<body class="index-page centered centering"> 
    <div class="container">
        <div class="row">            
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo cek-topup">
                    <!-- BEGIN LOGIN FORM -->
                    <form class="login-form" action="{{ url('/auth/cashierlogin') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                        <h1 class="text-center">Cashier Login</h1>
                        <ul>
                             @foreach ($errors->all() as $error)
                            <li style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>

                
                        <div class="form-group">
                            <div class="col-md-10 col-md-push-1">
                                <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input type="text" class="form-control" style='font-size: 24px;' autocomplete="off" placeholder="Username" name="username">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input type="password" class="form-control" style='font-size: 24px;' autocomplete="off" placeholder="Password" name="password">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-actions">
                            <div class="col-md-4 col-md-push-7">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-paper-plane-o"></i>
                                    Login
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
