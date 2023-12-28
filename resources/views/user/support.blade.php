<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Câu hỏi | VietBidding</title>

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
                                        <h4 class="panel-title"><strong>Tài khoản VietBidding</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-1" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="heading-1">
                                    <div class="panel-body">
                                        <p><strong>Q: Tạo tài khoản VietBidding như thế nào?</strong></p>
                                        <ul>
                                            <strong>A: Rất đơn giản, bạn chỉ cần làm theo các bước sau:</strong>
                                            <li>1. Vào trang đăng ký, điền đầy đủ thông tin trên form đăng ký</li>
                                            <li>2. Sau khi nhấn đăng ký, kiểm tra email đăng ký và chờ VietBidding gửi
                                                mail xác nhận</li>
                                            <li>3. Trong mail gửi về, nhấn vào link xác nhận để kích hoạt tài khoản</li>
                                            <li>Lưu ý, liên kết sẽ hết hạn trong 5 phút, nếu hết hạn thì cần vào form
                                                đăng ký nhập lại thông tin để lấy liên kết xác nhận mới</li>
                                        </ul>
                                        <br>
                                        <p><strong>Q: Phải làm sao khi quên mật khẩu?</strong></p>
                                        <ul>
                                            <strong>A: VietBidding sẽ giúp bạn lấy lại mật khẩu tài khoản bằng
                                                cách:</strong>
                                            <li>1. Tại trang Đăng nhập, nhấn vào Quên Mật Khẩu</li>
                                            <li>2. Điền email đăng ký tài khoản mà bạn muốn tìm lại mật khẩu và gửi yêu
                                                cầu đặt lại mật khẩu</li>
                                            <li>3. Kiểm tra email của bạn để lấy mật khẩu sau khi được đặt lại</li>
                                            <li>4. Đăng nhập với mật khẩu mới và vào phần Tài khoản để đổi lại thành mật
                                                khẩu dễ nhớ hơn (khuyến nghị)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-2">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-2" aria-expanded="false"
                                        aria-controls="collapse-2">
                                        <h4 class="panel-title"><strong>Chức năng tìm kiếm</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-2" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-2">
                                    <div class="panel-body">
                                        <ul>
                                            <b>Tìm kiếm theo Mã Thông Báo Mời Thầu (Mã TBMT)</b>
                                            <li>Chức năng này cho phép người dùng nhanh chóng tra cứu thông tin với độ
                                                chính xác cao khi biết mã TBMT cụ thể.
                                            </li>
                                            <li>Bằng cách nhập mã này vào hệ thống, người dùng có thể truy cập nhanh
                                                chóng đến chi tiết liên quan và cập nhật mới nhất về thông báo đấu thầu.
                                            </li>
                                        </ul>
                                        <br>
                                        <ul>
                                            <b>Tìm kiếm theo Tên Gói Thầu</b>
                                            <li>Tìm kiếm dựa trên tên gói thầu giúp người dùng dễ dàng xác định và truy
                                                cập đến các dự án mua sắm hoặc đấu thầu mà bạn quan tâm.
                                            </li>
                                            <li>Tối ưu hóa thời gian và giúp người dùng có cái nhìn tổng quan về nội
                                                dung và yêu cầu của gói thầu.
                                            </li>
                                        </ul>
                                        <br>
                                        <ul>
                                            <b>Tìm kiếm theo Lĩnh Vực</b>
                                            <li>Tính năng này cho phép người dùng lọc và tìm kiếm thông tin đấu thầu
                                                theo các lĩnh vực hoặc ngành nghề cụ thể mà họ quan tâm. Điều này giúp
                                                người dùng tập trung vào những thông báo và dự án mua sắm phù hợp với
                                                chuyên môn và lĩnh vực của mình.
                                            </li>

                                        </ul>
                                        <br>
                                        <ul>
                                            <b>Tìm kiếm theo Tỉnh/Thành Phố</b>
                                            <li>Tìm kiếm dựa trên địa điểm giúp người dùng nhanh chóng xác định và truy
                                                cập đến các thông báo và dự án đấu thầu diễn ra tại một tỉnh hoặc thành
                                                phố cụ thể. Điều này hữu ích cho các doanh nghiệp và tổ chức muốn tìm
                                                kiếm cơ hội kinh doanh hoặc hợp tác tại một khu vực địa lý cụ thể.
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-3">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-3" aria-expanded="false"
                                        aria-controls="collapse-3">
                                        <h4 class="panel-title"><strong>Chuyên gia tư vấn</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-3" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-3">
                                    <div class="panel-body">
                                        <p><strong>Q: Tại sao không thể vào mục Tư vấn?</strong></p>
                                        <p>A: Bạn cần đăng ký tài khoản VietBidding để có thể sử dụng chức năng tư vấn
                                            với sự hỗ trợ của các chuyên gia dày dặn kinh nghiệm</p>
                                        <br>
                                        <p><strong>Q: Tại sao cần sử dụng dịch vụ của chuyên gia tư vấn đấu
                                                thầu?</strong></p>
                                        <p>A: Chuyên gia tư vấn đấu thầu có kiến thức sâu rộng về quy trình đấu thầu,
                                            giúp bạn hiểu rõ hơn về các quy định, tối ưu hóa chiến lược và giảm rủi ro.
                                        </p>
                                        <br>
                                        <p><strong>Q: Dịch vụ cụ thể mà chuyên gia tư vấn đấu thầu có thể cung cấp là
                                                gì?</strong></p>
                                        <p>A: Các dịch vụ bao gồm hỗ trợ chuẩn bị tài liệu đấu thầu, đánh giá và chọn
                                            nhà thầu, đàm phán hợp đồng, và giải quyết vấn đề trong quá trình thực hiện
                                            dự án.</p>
                                        <br>
                                        <p><strong>Phí dịch vụ của chuyên gia tư vấn đấu thầu là bao nhiêu?</strong></p>
                                        <p>A: Phí dịch vụ tư vấn dựa theo <i><strong>Điều 9 Nghị định số
                                                    63/2014/NĐ-CP</strong></i>. Phí có thể thay đổi tùy thuộc vào dự án
                                            và phạm vi công việc. Liên hệ trực tiếp với chuyên gia để nhận báo giá cụ
                                            thể và thảo luận về điều kiện thanh toán.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading-4">
                                    <a class="accordion-toggle" role="button" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-4" aria-expanded="false"
                                        aria-controls="collapse-4">
                                        <h4 class="panel-title"><strong>Chức năng đặt lịch hẹn</strong></h4>
                                        <i class="fa acc-switch"></i>
                                    </a>
                                </div>
                                <div id="collapse-4" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="heading-4">
                                    <div class="panel-body">
                                        <p><strong>Q: Đặt lịch hẹn với chuyên gia như nào?</strong></p>
                                        <ul>
                                            <strong>A: Nếu cần tư vấn, bạn có thể đặt lịch hẹn với chuyên gia bằng
                                                cách</strong>
                                            <li>1. Tại trang Tư vấn, chọn chuyên gia bạn muôn đặt lịch hẹn</li>
                                            <li>2. Điền thông tin vào form đặt lịch hẹn ở bên dưới thông tin của chuyên
                                                gia</li>
                                            <li>3. Ngày hẹn sẽ hiển thị các ngày chuyên gia có thể tư vấn trực tiếp cho
                                                bạn</li>
                                            <li>4. Sau khi kiểm tra thông tin chính xác, bạn nhấn vào nút Đăt lịch</li>
                                            <li>5. Chuyên gia sẽ phản hồi qua email của bạn trong vòng từ 3-5 ngày, hãy
                                                theo dõi email để cập nhật thông tin sớm nhất</li>
                                        </ul>
                                        <br>
                                        <p><strong>Q: Phải làm sao khi quên mật khẩu?</strong></p>
                                        <ul>
                                            <strong>A: VietBidding sẽ giúp bạn lấy lại mật khẩu tài khoản bằng
                                                cách:</strong>
                                            <li>1. Tại trang Đăng nhập, nhấn vào Quên Mật Khẩu</li>
                                            <li>2. Điền email đăng ký tài khoản mà bạn muốn tìm lại mật khẩu và gửi yêu
                                                cầu đặt lại mật khẩu</li>
                                            <li>3. Kiểm tra email của bạn để lấy mật khẩu sau khi được đặt lại</li>
                                            <li>4. Đăng nhập với mật khẩu mới và vào phần Tài khoản để đổi lại thành mật
                                                khẩu dễ nhớ hơn (khuyến nghị)</li>
                                        </ul>
                                    </div>
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
