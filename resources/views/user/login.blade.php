<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập | VietBidding</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/misc-pages.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
</head>

<body class="simple-page">
    <div id="back-to-home">
        <a href="{{ route('user.getDashboard') }}" class="btn btn-outline btn-default"><i
                class="fa fa-home animated zoomIn"></i></a>
    </div>
    <div class="simple-page-wrap">
        <div class="simple-page-logo animated swing">
            <a href="{{ route('user.getDashboard') }}">
                <span><i class="fa fa-gg"></i></span>
                <span>VietBidding</span>
            </a>
        </div><!-- logo -->

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="simple-page-form animated flipInY" id="login-form">
            <h4 class="form-title m-b-xl text-center">Đăng Nhập Tài Khoản VietBidding</h4>
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="sign-in-email" type="email" class="form-control" name="email" placeholder="Email"
                        required>
                </div>

                <div class="form-group">
                    <input id="sign-in-password" type="password" class="form-control" name="password"
                        placeholder="Mật khẩu" required>
                </div>

                <div class="form-group m-b-xl">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="keep_me_logged_in" name="remember"/>
                        <label for="keep_me_logged_in">Ghi nhớ đăng nhập</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="ĐĂNG NHẬP">
            </form>
        </div><!-- #login-form -->

        <div class="simple-page-footer">
            <p><a href="{{ route('user.getPasswordForget') }}"> Quên mật khẩu ?</a></p>
            <p>
                <small>Chưa có tài khoản VietBidding ?</small>
                <a href="{{ route('user.getSignup') }}">ĐĂNG KÝ NGAY</a>
            </p>
        </div><!-- .simple-page-footer -->


    </div><!-- .simple-page-wrap -->
</body>

</html>
