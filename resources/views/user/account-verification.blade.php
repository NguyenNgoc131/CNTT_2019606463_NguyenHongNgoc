<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận email | VietBidding</title>
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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="simple-page-form animated flipInY" id="reset-password-form">
            <h4 class="form-title m-b-xl text-center">Xác nhận email đăng ký</h4>

            @if (isset($verification))
                <form action="{{ route('user.verify') }}" method="POST">
                    <div class="form-group">
                        <p>Xin chào {{ $verification->user->name }},</p>

                        <p>Cảm ơn bạn đã đăng ký! Hãy xác nhận tài khoản của bạn bằng cách nhấn vào liên kết sau đây:
                        </p>

                        <a href="{{ route('user.updateInfo', ['token' => $verification->token]) }}">Xác nhận tài
                            khoản</a>

                        <p>(Liên kết hết hạn sau 5 phút)
                        </p>
                    </div>
                </form>
            @else
                <p>Không có thông tin xác nhận.</p>
            @endif
        </div><!-- verify-account -->

    </div><!-- .simple-page-wrap -->
</body>

</html>
