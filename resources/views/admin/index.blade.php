<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Admin | VietBidding</title>

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/admin/index.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <script src="../libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <!-- APP NAVBAR ==========-->
    <nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

        <!-- navbar header -->
        <div class="navbar-header">

            <a href="{{ route('user.getDashboard') }}" class="navbar-brand">
                <span class="brand-icon"><i class="fa fa-gg"></i></span>
                <span class="brand-name">VietBidding</span>
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
                        <h5 class="page-title hidden-menubar-top hidden-float">Thông tin tài khoản</h5>
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
        <div class="menubar-scroll">
            <div class="menubar-scroll-inner">
                <ul class="app-menu">
                    <li class="has-submenu">
                        <a href="{{ route('admin.getIndex') }}">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Tài khoản</span>
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-bars"></i>
                            <span class="menu-text">Danh mục gói thầu</span>
                            <span class="label label-warning menu-label">2</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('admin.getLinhVuc') }}"><span class="menu-text">Lĩnh vực</span></a>
                            </li>
                            <li><a href="{{ route('admin.getCity') }}"><span class="menu-text">Tỉnh thành</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="{{ route('admin.getExperts') }}">
                            <i class="menu-icon fa fa-briefcase"></i>
                            <span class="menu-text">Chuyên gia</span>
                        </a>
                    </li>

                </ul><!-- .app-menu -->
            </div><!-- .menubar-scroll-inner -->
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Danh sách tài khoản</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tên người dùng</th>
                                            <th>Email</th>
                                            <th>Phân quyền</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr>
                                                <!-- Các cột thông tin người dùng -->
                                                <td>
                                                    <span class="editable"
                                                        id="name{{ $item['id'] }}">{{ $item['name'] }}</span>
                                                    <input type="text" class="form-control"
                                                        id="nameInput{{ $item['id'] }}" name="nameInput{{ $item['id'] }}"
                                                        value="{{ $item['name'] }}" style="display: none;">
                                                </td>
                                                <td><input type="email" class="form-control"
                                                        id="email{{ $item['id'] }}" name="email"
                                                        value="{{ substr($item['email'], 0, 5) . str_repeat('*', strlen($item['email']) - 15) . substr($item['email'], -10) }}"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <span class="editable"
                                                        id="role{{ $item['id'] }}">{{ $item['role'] }}</span>
                                                    <input type="text" class="form-control"
                                                        id="roleInput{{ $item['id'] }}" name="roleInput{{ $item['id'] }}"
                                                        value="{{ $item['role'] }}" style="display: none;">
                                                </td>
                                                <td>{{ $item['created_at'] }}</td>
                                                <td>{{ $item['updated_at'] }}</td>
                                                <td>
                                                    <button class="btn btn-warning"
                                                        onclick="toggleEdit({{ $item['id'] }})"
                                                        id="editBtn{{ $item['id'] }}"
                                                        style="margin-bottom: 2px;">Sửa</button>
                                                    <form action="{{ route('admin.delete', ['id' => $item['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xoá tài khoản này không?')"
                                                            id="confirmDeleteBtn{{ $item['id'] }}">Xoá</button>
                                                    </form>
                                                    <form id="updateInfo{{ $item['id'] }}"
                                                        action="{{ route('admin.update', ['id' => $item['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-success"
                                                            onclick="saveChanges({{ $item['id'] }})"
                                                            style="display: none; margin-bottom: 2px;"
                                                            id="saveBtn{{ $item['id'] }}">Lưu</button>
                                                    </form>
                                                    <button class="btn btn-info"
                                                        onclick="cancelEdit({{ $item['id'] }})"
                                                        style="display: none; margin-top: 2px"
                                                        id="cancelBtn{{ $item['id'] }}">Huỷ</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <center>
                                    <div class="d-flex justify-content-between">
                                        <!-- Liên kết trở về trang đầu tiên -->
                                        @if ($datas->currentPage() > 1)
                                            <a href="{{ $datas->url(1) }}">Trang đầu</a>
                                        @endif

                                        <!-- Hiển thị danh sách các trang 2, 3, ... -->
                                        @if ($datas->lastPage() > 1)
                                            <ul class="pagination">
                                                @for ($i = max(1, $datas->currentPage() - 2); $i <= min($datas->currentPage() + 2, $datas->lastPage()); $i++)
                                                    @if ($datas->currentPage() == $i)
                                                        <li class="page-item active"><span
                                                                class="page-link">{{ $i }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{ $datas->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endif
                                                @endfor
                                            </ul>
                                        @endif

                                        <!-- Liên kết tới trang cuối cùng -->
                                        @if ($datas->currentPage() < $datas->lastPage())
                                            <a href="{{ $datas->url($datas->lastPage()) }}">Trang cuối</a>
                                        @endif
                                    </div>
                                </center>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row -->
            </section><!-- .app-content -->
        </div><!-- .wrap -->

        <!-- APP FOOTER -->
        {{-- <div class="wrap p-t-0">
            <footer class="app-footer">
                <div class="clearfix">
                    <ul class="footer-menu pull-right">
                        <li><a href="javascript:void(0)">Careers</a></li>
                        <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        <li><a href="javascript:void(0)">Feedback <i class="fa fa-angle-up m-l-md"></i></a></li>
                    </ul>
                    <div class="copyright pull-left">&copy;2023 Nguyễn Hồng Ngọc</div>
                </div>
            </footer>
        </div> --}}
        <!-- /#app-footer -->
    </main>
    <!--========== END app main -->

    <!-- APP CUSTOMIZER -->
    <div id="app-customizer" class="app-customizer">
        <a href="javascript:void(0)" class="app-customizer-toggle theme-color" data-toggle="class" data-class="open"
            data-active="false" data-target="#app-customizer">
            <i class="fa fa-gear"></i>
        </a>
        <div class="customizer-tabs">
            <!-- tabs list -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#menubar-customizer"
                        aria-controls="menubar-customizer" role="tab" data-toggle="tab">Menubar</a></li>
                <li role="presentation"><a href="#navbar-customizer" aria-controls="navbar-customizer"
                        role="tab" data-toggle="tab">Navbar</a></li>
            </ul><!-- .nav-tabs -->

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane in active fade" id="menubar-customizer">
                    <div class="hidden-menubar-top hidden-float">
                        <div class="m-b-0">
                            <label for="menubar-fold-switch">Fold Menubar</label>
                            <div class="pull-right">
                                <input id="menubar-fold-switch" type="checkbox" data-switchery data-size="small" />
                            </div>
                        </div>
                        <hr class="m-h-md">
                    </div>
                    <div class="radio radio-default m-b-md">
                        <input type="radio" id="menubar-light-theme" name="menubar-theme"
                            data-toggle="menubar-theme" data-theme="light">
                        <label for="menubar-light-theme">Light</label>
                    </div>

                    <div class="radio radio-inverse m-b-md">
                        <input type="radio" id="menubar-dark-theme" name="menubar-theme"
                            data-toggle="menubar-theme" data-theme="dark">
                        <label for="menubar-dark-theme">Dark</label>
                    </div>
                </div><!-- .tab-pane -->
                <div role="tabpanel" class="tab-pane fade" id="navbar-customizer">
                    <!-- This Section is populated Automatically By javascript -->
                </div><!-- .tab-pane -->
            </div>
        </div><!-- .customizer-taps -->
        <hr class="m-0">
        <div class="customizer-reset">
            <button id="customizer-reset-btn" class="btn btn-block btn-outline btn-primary">Reset</button>
            <a href="https://themeforest.net/item/infinity-responsive-web-app-kit/16230780"
                class="m-t-sm btn btn-block btn-danger">Buy Now</a>
        </div>
    </div><!-- #app-customizer -->

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
    <script src="../assets/js/admin/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
