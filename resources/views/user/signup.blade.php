<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký | VietBidding</title>
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
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="simple-page-form animated flipInY" id="signup-form">
            <h4 class="form-title m-b-xl text-center">Đăng Ký Tài Khoản Mới</h4>
            <form action="{{ route('user.register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="sign-up-name" type="text" class="form-control" name="name" placeholder="Tên người dùng"
                        value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <input id="sign-up-email" type="email" class="form-control" name="email" placeholder="Email"
                        value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input id="sign-up-password" type="password" class="form-control" name="password"
                        placeholder="Mật khẩu" required>
                </div>

                <div class="form-group">
                    <input id="confirm-password" type="password" class="form-control" placeholder="Xác nhận mật khẩu"
                        required>
                </div>

                <input type="submit" class="btn btn-primary" value="ĐĂNG KÝ">
            </form>
        </div><!-- #signup-form -->

        <div class="simple-page-footer">
            <p>
                <small>Đã có tài khoản VietBidding ?</small>
                <a href="{{ route('user.getLogin') }}">ĐĂNG NHẬP</a>
            </p>
        </div><!-- .simple-page-footer -->


    </div><!-- .simple-page-wrap -->


    <script src="../assets/js/signup.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
