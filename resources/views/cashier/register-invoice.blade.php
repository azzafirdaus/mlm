@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <form class="form" action="{{ url('cashier/register') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <div class="card cek-saldo cek-topup">
                        <h1 class="text-center hidden-print">Register Customer</h1>
                        <ul>
                             @foreach ($errors->all() as $error)
                            <li style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>
                        <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>
                        
                        <div id="tagihan">
                            <br />
                            <div class="row hidden-print">
                                <div class="col-md-10 col-md-push-1 hidden-print">
                                    <hr />
                                </div>
                            </div>
                            <br />
                            <div class="row ">
                                <div class="col-md-10 col-md-push-1 text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor Kartu</th>
                                                <th class="text-center">Isi Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $idkartu }}</td>
                                                <td class="text-center">Rp. {{ number_format($saldo) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br />
                            <div class="form-actions hidden-print">
                                <div class="col-md-4">
                                    <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                        <i class="fa fa-angle-left"></i>
                                        Back to Cashier
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                                <div class="col-md-4 pull-right">
                                    <button type="submit" formaction="register/print" onclick="window.print();" class="btn btn-primary btn-print">
                                        <i class="fa fa-print"></i>
                                        Print
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
@stop