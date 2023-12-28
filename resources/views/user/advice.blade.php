<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Tư vấn | VietBidding</title>

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/advice.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <script src="../libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="menubar-top menubar-light theme-primary">
    <!--============= start main area -->

    <!-- APP NAVBAR ==========-->
    <nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

        <!-- navbar header -->
        <div class="navbar-header">
            <button type="button" id="menubar-toggle-btn"
                class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
                <span class="sr-only">Toggle navigation</span>
                <span class="hamburger-box"><span class="hamburger-inner"></span></span>
            </button>

            <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="zmdi zmdi-hc-lg zmdi-more"></span>
            </button>

            <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse"
                data-target="#navbar-search" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="zmdi zmdi-hc-lg zmdi-search"></span>
            </button>

            <a href="{{ route('user.getDashboard') }}" class="navbar-brand">
                <span class="brand-icon"><i class="fa fa-gg"></i></span>
                <span class="brand-name" style="font-size: 20px">VietBidding</span>
            </a>
        </div><!-- .navbar-header -->

        <div class="navbar-container container-fluid">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
                    <li class="hidden-float hidden-menubar-top">
                        <a href="javascript:void(0)" role="button" id="menubar-fold-btn"
                            class="hamburger hamburger--arrowalt is-active js-hamburger">
                            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                        </a>
                    </li>
                    <li>
                        <h5 class="page-title hidden-menubar-top">Dashboard</h5>
                    </li>
                </ul>

                <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">

                    <li class="dropdown">
                        @auth
                            <!-- Nếu người dùng đã đăng nhập -->

                            @if (Auth::user()->role == 'user')
                                <a href="{{ route('user.getProfile') }}" class="side-panel-toggle" data-toggle="class"
                                    data-target="#side-panel" data-class="open" role="button">
                                    <i class="fa fa-user"> {{ Auth::user()->name }}</i>
                                @else
                                    <a href="{{ route('admin.getIndex') }}" class="side-panel-toggle" data-toggle="class"
                                        data-target="#side-panel" data-class="open" role="button">
                                        <i class="fa fa-user"> Xin chào, Admin {{ Auth::user()->name }}</i>
                            @endif

                            </a>
                        @else
                            <!-- Nếu người dùng chưa đăng nhập -->
                            <a href="{{ route('user.getSignup') }}" class="side-panel-toggle" data-toggle="class"
                                data-target="#side-panel" data-class="open" role="button">
                                <i class="fa fa-user-plus"> Đăng ký</i>
                            </a>
                        @endauth
                    </li>

                    <li class="dropdown">
                        @auth
                            <!-- Nếu người dùng đã đăng nhập -->
                            <a href="{{ route('user.getLogout') }}" class="side-panel-toggle" data-toggle="class"
                                data-target="#side-panel" data-class="open" role="button">
                                <i class="fa fa-sign-out"> Đăng xuất</i>
                            </a>
                        @else
                            <!-- Nếu người dùng chưa đăng nhập -->
                            <a href="{{ route('user.getLogin') }}" class="side-panel-toggle" data-toggle="class"
                                data-target="#side-panel" data-class="open" role="button">
                                <i class="fa fa-sign-in"> Đăng nhập</i>
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div><!-- navbar-container -->
    </nav>
    <!--========== END app navbar -->

    <!-- APP ASIDE ==========-->
    <aside id="menubar" class="menubar light">

        <div class="menubar-scroll" style="width:100%">
            <div class="menubar-scroll-inner">
                <ul class="app-menu">
                    <li class="has-submenu">
                        <a href="{{ route('user.getDashboard') }}" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Trang Chủ</span>
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="{{ route('user.getHelp') }}" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                            <span class="menu-text">Giới thiệu</span>
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="{{ route('user.getSupport') }}" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                            <span class="menu-text">Câu hỏi</span>
                        </a>
                    </li>

                    <li class="has-submenu">
                        @if (auth()->check())
                            <a href="{{ route('user.getAdvice') }}" class="submenu-toggle">
                                <i class="menu-icon zmdi zmdi-inbox zmdi-hc-lg"></i>
                                <span class="menu-text">Tư vấn</span>
                            </a>
                        @else
                            <a href="#"
                                onclick="alert('Vui lòng đăng nhập để sử dụng chức năng tư vấn'); return false;"
                                class="submenu-toggle">
                                <i class="menu-icon zmdi zmdi-inbox zmdi-hc-lg"></i>
                                <span class="menu-text">Tư vấn</span>
                            </a>
                        @endif
                    </li>

                    <li class="time-display has-submenu ">
                        <a class="submenu-toggle">
                            <span id="current-date" class="menu-text"></span>
                            <span id="current-time" class="menu-text"></span>
                        </a>
                    </li>
                </ul><!-- .app-menu -->
            </div>
        </div><!-- .menubar-scroll -->
    </aside>
    <!--========== END app aside -->

    <!-- navbar search -->
    <div id="navbar-search" class="navbar-search collapse">
        <div class="navbar-search-inner">
            <form action="#">
                <span class="search-icon"><i class="fa fa-search"></i></span>
                <input class="search-field" type="search" placeholder="search..." />
            </form>
            <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search"
                aria-expanded="false">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search"
            aria-expanded="false"></div>
    </div><!-- .navbar-search -->

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <!-- Thông tin chuyên gia -->
                    <div class="col-md-8">
                        <div class="widget countries-widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Thông tin chuyên gia</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                @if (isset($selectedExpert))
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>{{ $selectedExpert->name }}</h4>
                                        </div>
                                        <div class="panel-body">
                                            <!-- Phần bên trái chứa hình ảnh -->
                                            <div class="expert-image">
                                                <img src="{{ $selectedExpert->image_url }}"
                                                    alt="{{ $selectedExpert->name }}.img" class="img-responsive">
                                            </div>
                                            <!-- Phần bên phải chứa thông tin -->
                                            <div class="expert-info">
                                                <p><strong>Bằng cấp:</strong> {{ $selectedExpert->degree }}</p>
                                                <p><strong>Kinh nghiệm tư vấn:</strong> {{ $selectedExpert->experience }} năm
                                                </p>
                                                <p><strong>Gói thầu tư vấn thành công:</strong>
                                                    {{ $selectedExpert->successful_bids }}
                                                    ({{ $selectedExpert->success_rate }}%)</p>
                                                <p><strong>Email:</strong> {{ $selectedExpert->email }}</p>
                                                <p><strong>Văn phòng:</strong> {{ $selectedExpert->office }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div><!-- .widget-body -->
                        </div><!-- .widget -->

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

                        <div class="widget countries-widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Đặt lịch hẹn</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                @if (isset($selectedExpert) && isset($selectedExpert['ngayhen']))
                                    <form id="appointmentForm" class="form-horizontal"
                                        action="{{ route('user.appointment', $selectedExpert->id) }}" method="post"
                                        onsubmit="return validateForm();">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Họ tên: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ Auth::user()->name }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Email của bạn:
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email"
                                                    value="{{ Auth::user()->email }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="col-sm-3 control-label">Số điện
                                                thoại: </label>
                                            <div class="col-sm-9">
                                                <input type="phone" class="form-control" id="phone"
                                                    value="{{ old('phone') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date" class="col-sm-3 control-label">Chọn ngày: </label>
                                            <div class="col-sm-9">
                                                <select type="text" class="form-control" id="date"
                                                    name="date">
                                                    @php
                                                    // Tách chuỗi thành mảng
                                                    $dates = explode(', ', $selectedExpert->ngayhen);
                                                
                                                    // Chuyển đổi các chuỗi thành đối tượng DateTime
                                                    $dateTimeObjects = [];
                                                    foreach ($dates as $dateStr) {
                                                        $dateTimeObjects[] = DateTime::createFromFormat('d/m/Y H:i', $dateStr);
                                                    }
                                                
                                                    // Sắp xếp các đối tượng DateTime
                                                    usort($dateTimeObjects, function($a, $b) {
                                                        return $a <=> $b;  // Sắp xếp theo thứ tự tăng dần
                                                    });
                                                
                                                    // Chuyển đổi trở lại chuỗi đã sắp xếp
                                                    $sortedDates = [];
                                                    foreach ($dateTimeObjects as $dateTime) {
                                                        $sortedDates[] = $dateTime->format('d/m/Y H:i');
                                                    }
                                                @endphp
                                                
                                                @foreach ($sortedDates as $date)
                                                    <option value="{{ $date }}">{{ $date }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="MaTBMT" class="col-sm-3 control-label">Mã TBMT: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="MaTBMT"
                                                    name="MaTBMT" placeholder="Nhập mã TBMT muốn tư vấn" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phí tư vấn: </label>
                                            <div class="col-sm-9">
                                                <span id="note">Theo Điều 9 Nghị định 63/2014/NĐ-CP, tỉ lệ với
                                                    phần trăm (%) giá gói thầu
                                                    <br>
                                                    Phí tư vấn cụ thể sẽ được trao đổi
                                                    qua mail với chuyên gia</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9" style="width:30%;">
                                                <button class="btn-date btn-primary form-control" type="submit"
                                                    onclick="confirmAppointment()">Đặt lịch</button>
                                            </div>
                                        </div>

                                @endif
                            </div><!-- .widget-body -->
                            </form>
                        </div><!-- .widget -->
                    </div><!-- END column -->

                    <!-- Danh sách chuyên gia -->

                    <div class="col-md-4">
                        <div class="widget countries-widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Danh sách chuyên gia</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="list-group m-0">
                                    @foreach ($experts as $expert)
                                        <a href="{{ route('user.getExpertInfo', $expert->id) }}">
                                            <div class="list-group-item clearfix">
                                                <span class="pull-left fw-500 fz-md">{{ $expert->name }}</span>
                                                <div class="pull-right">
                                                    <span>Tư vấn thành công: {{ $expert->successful_bids }}</span><br>
                                                    <span>Tỉ lệ thành công: {{ $expert->success_rate }}%</span>
                                                </div>
                                            </div><!-- .list-group-item -->
                                        </a>
                                    @endforeach
                                </div><!-- .list-group -->
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- END row -->
            </section><!-- .app-content -->
        </div><!-- .wrap -->
        <!-- APP FOOTER -->
        <div class="wrap p-t-0">
            <footer class="app-footer">
                <div class="clearfix">
                    
                    <div class="copyright pull-left">&copy;2023 VietBidding</div>
                </div>
            </footer>
        </div>
        <!-- /#app-footer -->
    </main>
    <!--========== END app main -->

    <!-- APP CUSTOMIZER -->

    <!-- SIDE PANEL -->

    <!-- build:js ../assets/js/core.min.js -->
    <script src="../libs/bower/jquery/dist/jquery.js"></script>
    <script src="../libs/bower/jquery-ui/jquery-ui.min.js"></script>
    <script src="../libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
    <script src="../libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <script src="../libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../libs/bower/PACE/pace.min.js"></script>
    <!-- endbuild -->

    <!-- build:js ../assets/js/app.min.js -->
    <script src="../assets/js/library.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/app.js"></script>
    <!-- endbuild -->
    <script src="../libs/bower/moment/moment.js"></script>
    <script src="../libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="../assets/js/fullcalendar.js"></script>
    <script src="../assets/js/advice.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6"></script>
</body>

</html>
