<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>SIM Rekam Medis | RSD Mangusada</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}">
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">

    <!-- vector map CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dist/jasny-bootstrap.min.css') }}">



    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <div class="wrapper error-page pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="/">
                    <img class="brand-img mr-10" src="{{ asset('assets/image/logo.png') }}" width="100px" />
                    <span class="brand-text">SIM-RM</span>
                </a>
            </div>
            <div class="form-group mb-0 pull-right">
                <a class="inline-block btn btn-success btn-rounded btn-outline nonecase-font" href="/">Back to
                    Home</a>
            </div>
            <div class="clearfix"></div>
        </header>

        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0 error-bg-img">
            <div class="container-fluid">
                <!-- Row -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-30">
                                        <span class="block error-head text-center txt-success mb-10">403</span>
                                        <span class="text-center nonecase-font mb-20 block error-comment">Oops! Internal
                                            Server Error</span>
                                        <p class="text-center">You don't have permission to access this page.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dist/jasny-bootstrap.min.js') }}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('assets/js/dist/jquery.slimscroll.js') }}"></script>

    <!-- Init JavaScript -->
    <script src="{{ asset('assets/js/dist/init.js') }}"></script>
</body>

</html>
