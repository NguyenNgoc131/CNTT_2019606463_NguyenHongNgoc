<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quên Mật Khẩu | VietBidding</title>
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
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="simple-page-form animated flipInY" id="reset-password-form">
            <h4 class="form-title m-b-xl text-center">Reset Your Password</h4>

            <form method="POST" action="{{ route('user.postPasswordResetConfirm') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label for="action">Bạn muốn:</label>
                <select name="action">
                    <option value="accept">Đồng ý đặt lại mật khẩu</option>
                    <option value="reject">Từ chối đặt lại mật khẩu</option>
                </select>
                <button type="submit">Xác nhận</button>
            </form>
        </div><!-- #reset-password-form -->

    </div><!-- .simple-page-wrap -->
</body>

</html>
