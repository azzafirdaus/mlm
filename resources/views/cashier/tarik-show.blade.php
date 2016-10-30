<!DOCTYPE html>

<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Tarik Saldo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrapCustom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet">
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('assets/plugins/select2/select2_conquer.css') }}" rel="stylesheet">
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="{{ asset('assets/css/style-conquer.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/styleCustom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/themes/default.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/pages/loginWide.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
        <!-- BEGIN EXTERNAL SCRIPTS -->

    </head>
    
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo visible-print">
<!--            <img src="assets/img/logo.png" alt=""/>-->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="{{ url('cashier/tarik') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h3 class="form-title hidden-print" style='font-size: 38px;'>Tarik Tunai</h3>
                <ul>
                     @foreach ($errors->all() as $error)
                    <li style='font-size: 16px; color: red'>{{ $error }}</li>
                     @endforeach
                </ul>

                <div class="form-group hidden-print">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-money fa-fw" style="font-size: 2em"></i>
                        </span>
                        <input class="form-control placeholder-no-fix" type="text" style='font-size: 24px;' autocomplete="off" placeholder="Jumlah Saldo Dikurangi" name="jumlahtarik" id="jumlah-auto" />
                    </div>
                </div>
            
                <div class="form-group hidden-print">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-barcode fa-fw" style="font-size: 2em"></i>
                        </span>
                        <input class="form-control placeholder-no-fix" type="text" style='font-size: 24px;' autocomplete="off" placeholder="No. Kartu" name="idkartu"/>
                    </div>
                </div>

                <div class="form-actions hidden-print">
                    <button type="submit" class="btn btn-info"> 
                        <span class="glyphicon glyphicon-list"></span> Submit
                    </button>
                </div>
                <br>
                <div class="col-md-8 col-md-offset-1" style="font-size: 17px">
                    <div id="tagihan">
                        <div style="width: 300px">
                            <p>No. Kartu : {{ $idkartu }}</p>
                            <p style="font-size: 17px;">Tanggal : {{ $date }}</p>
                        </div>
                        <div>
                            <table class="table table-hover" style="width:310px">
                                <thead>
                                    <tr>
                                        <td>
                                             Saldo Awal
                                        </td>
                                        <td>
                                        : Rp. {{ number_format($saldo) }}
                                        </td>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Jumlah Tarik
                                    </td>
                                    
                                    <td>
                                        : Rp. {{ number_format($jumlahtarik) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Saldo Akhir
                                    </td>
                                    <td>
                                        : Rp. {{ number_format($saldo - $jumlahtarik) }}
                                    </td>
                                </tr>    
                            
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div style="padding-top: 20px"class="form-actions hidden-print">
                    <button type="button" onclick="location.href = '{{ url('cashier') }}';" class="btn btn-primary">
                        <span class="glyphicon glyphicon-chevron-left"></span> Back To Cashier
                    </button>
                    <button type="submit" formaction="tarik/print" class="btn btn-success pull-right" onclick="window.print();">
                        <span class="glyphicon glyphicon-check"></span> Print
                    </button>
                   
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
    </body>
<!-- END BODY -->
</html>
<script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/autoNumeric.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/jquery.lazzynumeric.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-lazzynumeric/js/jquery.lazzynumeric.js') }}" type="text/javascript"></script>


<script type="text/javascript">
     $("#jumlah-auto").lazzynumeric({aSep: ",", mDec: "0"});
     window.onload = function() {
      var input = document.getElementById("jumlah-auto").focus();
    }
</script>