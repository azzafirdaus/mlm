@extends('layouts.master')

@section('content')
<body class="index-page centered"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3">
                <div class="card cek-saldo reset-kartu">
                    <form class="saldo-form" action="{{ url('cashier/reset') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h1 class="text-center hidden-print">Kosongkan Saldo</h1>

                        <ul>
                             @foreach ($errors->all() as $error)
                            <li style='font-size: 16px; color: red'>{{ $error }}</li>
                             @endforeach
                        </ul>
                        <?='<span style="font-size: 16px; color: red">'.Session::get('loginError').'</span>'?>

                        <div class="row hidden-print">
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
                        <div class="row hidden-print">
                            <div class="col-md-4 col-md-push-1">
                                <button id="kosong" type="submit" class="btn btn-primary">
                                    <i class="fa fa-credit-card"></i>
                                    Submit
                                    <div class="ripple-container"></div>
                                </button>
                            </div>                            
                        </div>
                        <div id="kosong-kartu">
                            <br />
                            <div class="row hidden-print">
                                <div class="col-md-10 col-md-push-1">
                                    <hr />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-10 col-md-push-1 text-center">
                                    <p>No. Kartu: {{ isset($idkartu) ? $idkartu : '-' }}</p>
                                    <br />
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sisa Saldo Kartu</th>
                                                <th class="text-center">Jumlah Saldo Kartu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">Rp. {{ number_format($saldo) }}</td>
                                                <td class="text-center">Rp. {{ number_format($jumlah) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br />
                            <div class="row hidden-print">
                                <div class="col-md-4">
                                    <button type="button" onclick="location.href = '{{ url('/cashier') }}';" class="btn btn-info">
                                        <i class="fa fa-angle-left"></i>
                                        Back
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                                <div class="col-md-4 pull-right">
                                    <button type="submit" formaction="reset/print" onclick="window.print();" class="btn btn-primary btn-print">
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

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("idkartu").focus();
    }
</script>