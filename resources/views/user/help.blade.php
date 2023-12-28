<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Giới thiệu | VietBidding</title>

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/app.css">
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
                    <div class="col-md-10">
                        <div class="panel-group accordion" id="accordion" role="tablist"
                            aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-1">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-1" aria-expanded="true"
                                        aria-controls="collapse-1">
                                        <h4 class="panel-title"><strong>Tổng quan về VietBidding</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-1" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="heading-1">
                                    <div class="panel-body">
                                        <p>
                                            VietBidding là một trang web chuyên cung cấp thông tin về các gói thầu từ
                                            nhiều
                                            lĩnh vực và ngành nghề trên cả nước. Không giống như những nền tảng thông
                                            thường, VietBidding tập trung vào việc tối ưu hóa trải nghiệm người dùng
                                            bằng
                                            cách hiển thị toàn bộ thông tin về một gói thầu trên một trang duy nhất.
                                        </p> <br>
                                        <strong>Các tính năng của VietBidding</strong>
                                        <ul>
                                            <li><i class="fa fa-check"></i> Tổng hợp dữ liệu giúp nhà thầu nắm bắt
                                                thông
                                                tin nhanh hơn, dễ dàng hơn.</li>
                                            <li><i class="fa fa-search"></i> Chức năng tìm kiếm tiện lợi, dễ dàng tìm
                                                thấy
                                                gói thầu theo yêu cầu.</li>
                                            <li><i class="fa fa-users"></i> Có các chuyên gia sẵn sàng tư vấn, giúp
                                                nâng
                                                cao tỉ lệ đấu thầu thành công.</li>
                                            <li><i class="fa fa-calendar"></i> Đặt lịch hẹn với chuyên gia đơn giản,
                                                nhanh
                                                chóng.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-2">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-2" aria-expanded="false"
                                        aria-controls="collapse-2">
                                        <h4 class="panel-title"><strong>Độc đáo và tiện lợi</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-2" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-2">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Với VietBidding, người dùng có thể tiết kiệm thời gian khi không cần
                                                phải
                                                tìm
                                                kiếm thông tin từng trang web hoặc phải truy cập nhiều nguồn tin khác
                                                nhau.
                                            </li>
                                            <li>Việc
                                                cập nhật thông tin liên tục giúp đảm bảo rằng mọi thông tin trên trang
                                                web
                                                đều
                                                là mới nhất và chính xác nhất.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-3">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-3" aria-expanded="false"
                                        aria-controls="collapse-3">
                                        <h4 class="panel-title"><strong>Nguồn thông tin đáng tin cậy</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-3" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-3">
                                    <div class="panel-body">
                                        <ul>
                                            <li>VietBidding cam kết cung cấp các thông tin đấu thầu chính xác và đáng
                                                tin
                                                cậy từ
                                                các tổ chức, doanh nghiệp uy tín.</li>
                                            <li>Điều này giúp người dùng có cái nhìn toàn diện và chi tiết về các gói
                                                thầu,
                                                từ đó đưa ra quyết định mua sắm hoặc tham gia đấu thầu một cách thông
                                                minh.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-4">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-4" aria-expanded="false"
                                        aria-controls="collapse-4">
                                        <h4 class="panel-title"><strong>Hỗ trợ tối đa cho người dùng</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-4" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-4">
                                    <div class="panel-body">
                                        <ul>
                                            <li>Không chỉ cung cấp thông tin, VietBidding còn hỗ trợ người dùng trong
                                                quá
                                                trình
                                                tham gia đấu thầu qua mạng, giúp họ hiểu rõ hơn về quy trình, yêu cầu,
                                                và
                                                các
                                                bước cần thiết. Đảm bảo rằng mọi bên đều có cơ hội cạnh tranh công bằng
                                                và hiệu quả trên nền tảng này.</li>

                                            <li>Điều này được thực hiện bởi đội ngũ chuyên gia tư vấn có nhiều năm kinh
                                                nghiệm,
                                                giúp khách hàng nắm bắt thông tin gói thầu nhanh hơn. Ngoài ra, các
                                                chuyên
                                                gia
                                                còn giúp phân tích chuyên sâu, tăng tỉ lệ cạnh tranh đấu thầu thành
                                                công.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="box p-md text-center _bg_white">
                                    <p class="text-primary fz-lg"><i class="fa fa-file-code-o"></i></p>
                                    <h4 class="text-primary">Cập nhật nhanh chóng</h4>
                                    <p>Đảm bảo người dùng luôn nhận được thông tin mới nhất và cập nhật liên tục.</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="box p-md text-center">
                                    <p class="text-primary fz-lg"><i class="fa fa-heart-o"></i></p>
                                    <h4 class="text-primary">Nguồn tin đáng tin cậy</h4>
                                    <p>Dữ liệu được cung cấp từ <a href="http://muasamcong.mpi.gov.vn"
                                            class="text-success">Hệ thống mạng đấu thầu quốc gia</a>, đảm bảo tính
                                        chính
                                        xác và đáng tin cậy.</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="box p-md text-center">
                                    <p class="text-primary fz-lg"><i class="fa fa-file-text-o"></i></p>
                                    <h4 class="text-primary">Dữ liệu gọn gàng</h4>
                                    <p>Thông tin được tổ chức rõ ràng và dễ dàng theo dõi, tiết kiệm thời
                                        gian và tối ưu hóa trải nghiệm.</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="box p-md text-center">
                                    <p class="text-primary fz-lg"><i class="fa fa-exclamation-circle"></i></p>
                                    <h4 class="text-primary">Sử dụng dễ dàng</h4>
                                    <p>Giao diện được thiết kế đơn giản giúp truy cập và tương tác với nền tảng một cách
                                        nhanh
                                        chóng và hiệu quả.</p>
                                </div>
                            </div>
                        </div>
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
    <script src="../assets/js/dashboard2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6"></script>
</body>

</html>
