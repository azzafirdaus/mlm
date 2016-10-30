<!DOCTYPE html>

<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Register Customer
        </title>
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

    </head>
    
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
<!--            <img src="assets/img/logo.png" alt=""/>-->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="{{ url('cashier') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h3 class="form-title hidden-print" style='font-size: 38px;'>Register Customer</h3>

                <br>
                <div class="col-sm-9 col-sm-offset-1" id="tagihan">

                    <div style="font-size: 30px">
                    <table class="table table-hover" style="width:450px;">
                        <thead>
                            <tr>                            
                                <th style="font-size: 22px;">
                                     Tanggal
                                </th>
                                <th colspan="4" style="font-size: 22px;">
                                     : {{ $date }}
                                </th>
                            </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>
                                     No. Kartu
                                </td>
                                <td colspan="4">
                                     : {{ $idkartu }}
                                </td>
                            </tr>    
                            <tr>
                                <td>
                                     Isi Saldo
                                </td>
                                <td colspan="4">
                                     : Rp. {{ number_format($saldo) }}
                                </td>
                            </tr>    

                    </tbody>
                    </table>

                    <br>

                </div>
                
                </div>

                <div class="form-actions hidden-print">
                    <button type="button" class="btn btn-primary" onclick="location.href = '{{ url('cashier') }}';">
                        <span class="glyphicon glyphicon-chevron-left"></span> Back
                    </button>
                    <div class="pull-right">
                        <button type="submit" formaction="{{ url('cashier/register/print') }}" class="btn btn-success" onclick="window.print();">
                            <span class="glyphicon glyphicon-check"></span> Print Invoice
                        </button>
                    </div>
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
    </body>
<!-- END BODY -->
</html>
