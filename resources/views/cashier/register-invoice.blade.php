@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="card cek-saldo reset-kartu">
                    <form class="saldo-form" action="{{ url('cashier/register') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h1 class="text-center hidden-print" style="padding-top:2em; padding-bottom:0.3em;">Tarik Tunai</h1>

                        @foreach ($errors->all() as $error)
                        <li style='font-size: 16px; color: red; text-align:center'>{{ $error }}</li>
                        @endforeach
                        
                        <div id="kosong-kartu">
                            <div class="row hidden-print">
                                <div class="col-md-10 col-md-push-1">
                                    <hr />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-push-1 text-center">
                                    <p>No. Kartu: {{ isset($idkartu) ? $idkartu : '-' }}</p>
                                    <p class="visible-print">Tanggal: {{ $date }}</p>                                    
                                    <br />
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sisa Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">Rp. {{ number_format($saldo) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br />
                            <div class="row hidden-print">
                                <div class="col-md-4 col-md-pull-1" style="padding-left:3em;">
                                    <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                        <i class="fa fa-angle-left"></i>
                                        Back to cashier
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                                <div class="col-md-4 col-md-push-4" style="padding-left:0;">
                                    <button type="submit" formaction="register/print" onclick="window.print();" class="btn btn-primary btn-print">
                                        <i class="fa fa-print"></i>
                                        Print
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
