@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <form class="form" action="{{ url('cashier/topup') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div class="card cek-saldo cek-topup">
                        <h1 class="text-center form-title hidden-print" style="padding-top:1em;">Top Up Saldo</h1>
                         <ul>
                             @foreach ($errors->all() as $error)
                            <li style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>
                        <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>

                        <div class="form-group hidden-print">
                            <div class="col-md-10 col-md-push-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </span>
                                    <div class="form-group is-empty is-focused">
                                        <input text="text" class="form-control" autocomplete="off" placeholder="Jumlah Top Up" name="jumlahtopup" id="topup">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden-print">
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
                        <br />
                        <div class="form-actions hidden-print">
                            <div class="col-md-4 col-md-pull-1" style="padding-left:3em; padding-top:2em;">
                                <button id = "lihat" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Submit
                                    <div class="ripple-container"></div>
                                </button>
                               
                            </div>
                        </div>

                        <div id="tagihan">
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-push-1 hidden-print">
                                     <br/>
                                    <hr />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-push-1 text-center">
                                    <p>No. Kartu: {{ $idkartu }}</p>
                                    <br />
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Saldo Sebelum</th>
                                                <th class="text-center">Jumlah Top Up</th>
                                                <th class="text-center">Saldo Sekarang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $sebelum }}</td>
                                                <td class="text-center">{{ $jumlahtopup }}</td>
                                                <td class="text-center">{{ $sebelum + $jumlahtopup }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br />
                            <div class="form-actions hidden-print">
                                <input type="hidden" name="idkartu" value="{{ $idkartu }}">
                                <input type="hidden" name="jumlahtopup" value="{{ $jumlahtopup }}">
                    
                                <div class="col-md-4 pull-right" style="padding-left:2em;">
                                    <button type="submit" formaction="topup/print" onclick="window.print();" class="btn btn-primary btn-print">
                                        <i class="fa fa-print"></i>
                                        Print
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                                <div class="col-md-4 col-md-pull-1">
                                    <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                        <i class="fa fa-angle-left"></i>
                                        Back to Cashier
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
