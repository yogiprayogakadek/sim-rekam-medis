<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V12</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="https://colorlib.com/etc/lf/Login_v12/images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/lf/Login_v12/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/lf/Login_v12/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/lf/Login_v12/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/lf/Login_v12/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/css/util.css">
    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/css/main.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url({{ asset('assets/image/login.jpg') }});">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="login100-form-avatar">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="AVATAR">
                    </div>
                    <span class="login100-form-title p-t-20 p-b-45">
                        SIM-Rekam Medis
                    </span>
                    <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                        <input class="input100 @error('username') is-invalid @enderror" type="text" name="username"
                            placeholder="Username" value="{{ old('username') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="pass"
                            placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://colorlib.com/etc/lf/Login_v12/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v12/vendor/bootstrap/js/popper.js"></script>
    <script src="https://colorlib.com/etc/lf/Login_v12/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v12/vendor/select2/select2.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v12/js/main.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
</body>

</html>
