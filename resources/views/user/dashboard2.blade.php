<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
    <title>Thông báo mời thầu | VietBidding</title>

    <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="../libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="../libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/core.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/dashboard2.css">
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

                    <li class="time-display has-submenu">
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
                    <div class="col-md-4" style="height:200px">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title pull-left">Số TBMT trong ngày</h4>
                                <small class="pull-right currentDate"></small>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body clearfix" style="height: 200px">
                                <div class="pull-left">
                                    <h3 class="text-color m-t-xs m-b-md fw-600 fz-lg">{{ $totalNotificationsToday }}
                                    </h3>
                                    <div class="{{ $textTBMT }}">
                                        <i class="{{ $classTBMT }}"></i>
                                        <span>{{ $messageTBMT }}</span>
                                    </div>
                                </div>

                                <div class="m-t-md" data-plugin="sparkline"
                                    data-options="{{ $TBMT_count }}, { type: 'bar', chartRangeMin:0, height: 100, barColor: '#188ae2', barWidth: 12, barSpacing: 10 }">
                                </div>

                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END cloumn -->


                    <div class="col-md-4" style="height:200px">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title pull-left">Tổng giá trị các gói (VND)</h4>
                                <small class="pull-right currentDate"></small>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body clearfix" style="height: 200px">
                                <div class="pull-left" style="flex: 1;">
                                    <h3 class="text-color m-t-xs m-b-md fw-600 fz-lg">
                                        {{ number_format($totalPriceToday, 0, ',', ',') }}
                                    </h3>
                                    <div class="{{ $textPrice }}">
                                        <i class="{{ $classPrice }}"></i>
                                        <span>{{ $messagePrice }}</span>
                                    </div>
                                </div>

                                <div class="m-t-md" data-plugin="sparkline"
                                    data-options="{{ $tong_gia }}, { type: 'bar', chartRangeMin:0, height: 100, barColor: '#188ae2', barWidth: 12, barSpacing: 10 }">
                                </div>


                            </div><!-- .widget-body -->

                        </div><!-- .widget -->
                    </div><!-- END cloumn -->

                    <div class="col-md-4">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Tỉ lệ Lĩnh vực</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div data-plugin="chart"
                                    data-options="{
                                        tooltip : {
                                            trigger: 'item',
                                            formatter: '{b} <br> {d}%'
                                        },
                                series : [
                                    {
                                        name: 'Lĩnh Vực',
                                        type: 'pie',
                                        radius : '90%',
                                        center: ['50%', '50%'],
                                        data:[
                                            {value:{{ $xayLap_count }}, name:'Xây lắp'},
                                            {value:{{ $hangHoa_count }}, name:'Hàng hoá'},
                                            {value:{{ $tuVan_count }}, name:'Tư vấn'},
                                            {value:{{ $phiTuVan_count }}, name:'Phi tư vấn'}
                                        ],
                                        itemStyle: {
                                            emphasis: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                            }
                                        }
                                    }
                                ]
                            }"
                                    style="height: 170px;">
                                </div>


                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row -->

                <div class="row">

                    {{-- Chart bar --}}
                    <div class="col-md-8">
                        <div class="widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Số TBMT theo ngày</h4>
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div data-plugin="chart"
                                    data-options="{
                                        tooltip: {
                                            trigger: 'axis',
                                            axisPointer: {
                                                type: 'shadow'
                                            }
                                        },
                                        legend: {
                                            data: ['Xây lắp', 'Hàng hoá', 'Tư vấn', 'Phi tư vấn']
                                        },
                                        grid: {
                                            left: '3%',
                                            right: '4%',
                                            bottom: '3%',
                                            containLabel: true
                                        },
                                        xAxis: [
                                            {
                                                type: 'category',
                                                data:  {{ $sevenDaysAgo }}
                                            }
                                        ],
                                        yAxis: [
                                            {
                                                type: 'value'
                                            }
                                        ],
                                        series: [
                                            {
                                                name: 'Xây lắp',
                                                type: 'bar',
                                                data: {{ $xay_lap }},
                                            },
                                            {
                                                name: 'Hàng hoá',
                                                type: 'bar',
                                                data: {{ $hang_hoa }}
                                            },
                                            {
                                                name: 'Tư vấn',
                                                type: 'bar',
                                                data: {{ $tu_van }}
                                            },
                                            {
                                                name: 'Phi tư vấn',
                                                type: 'bar',
                                                data: {{ $phi_tu_van }}
                                            }
                                        ]
                            }"
                                    style="height: 360px">


                                </div>

                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->

                    <div class="col-md-4">
                        <div class="widget countries-widget">
                            <header class="widget-header">
                                <h4 class="widget-title">Top tổng giá trị gói thầu (VND)
                                    <small class="pull-right currentDate"></small>
                                </h4>

                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="list-group m-0">
                                    @foreach ($topProvinces as $provinceName => $totalValue)
                                        <div class="list-group-item clearfix">
                                            <span class="pull-left fw-500 fz-md">{{ $provinceName }}</span>
                                            <div class="pull-right">
                                                <span>{{ number_format($totalValue, 0, ',', ',') }}</span>
                                            </div>
                                        </div><!-- .list-group-item -->
                                    @endforeach
                                </div><!-- .list-group -->
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row-->


                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <center>
                                    <h4 class="widget-title">Thông Báo Mời Thầu</h4>
                                </center>

                                <div class="search-table">
                                    <!-- Thanh tìm kiếm -->
                                    <div class="search-bar">
                                        <form action="{{ route('user.getDashboard') }}" method="GET">
                                            <span>Tìm kiếm theo </span>
                                            <select name="searchColumn" id="searchColumn">
                                                <option value="MaTBMT">Mã TBMT</option>
                                                <option value="TenGoiThau">Tên gói thầu</option>
                                                <option value="LinhVuc">Lĩnh Vực</option>
                                                <option value="TinhThanh">Tỉnh thành</option>
                                            </select>
                                            <input type="text" name="searchTerm" id="searchInput"
                                                value="{{ old('searchTerm') }}" placeholder="Nhập từ khoá...">
                                            <button class="btn-purple rounded" type="submit">Tìm</button>
                                        </form>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        Hiển thị:
                                        <select id="pageSizeSelect">
                                            <option value="10" @if ($pageSize == 10) selected @endif>10
                                            </option>
                                            <option value="20" @if ($pageSize == 20) selected @endif>20
                                            </option>
                                            <option value="50" @if ($pageSize == 50) selected @endif>50
                                            </option>
                                            <option value="100" @if ($pageSize == 100) selected @endif>
                                                100
                                            </option>
                                        </select>
                                        gói thầu trên mỗi trang
                                    </div>
                                </div>

                            </header>
                            <hr class="widget-separator" />
                            <div class="widget-body">
                                <div class="table-responsive">

                                    <table id="default-datatable" class="table table-striped custom-table"
                                        cellspacing="0" width="100%">
                                        {{-- class="table no-cellborder custom-table" --}}
                                        <thead>
                                            <tr>
                                                <th>Mã TBMT</th>
                                                <th>Tên gói thầu</th>
                                                <th>Lĩnh vực</th>
                                                <th>Trạng thái</th>
                                                <th>Tỉnh thành</th>
                                                @auth
                                                    <th>Giá gói thầu (VND)</th>
                                                    <th>Thực hiện</th>
                                                @endauth
                                                <th>Ngày đăng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($noDataMessage != '')
                                                <center>
                                                    <div class="alert alert-danger" role="alert"
                                                        style="font-size:20px;font-weight:2px;">
                                                        {{ $noDataMessage }}
                                                        <br>
                                                        {{ $alert1 }}
                                                    </div>
                                                </center>
                                            @else
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td class="text-info">
                                                            {{ substr($item['MaTBMT'], strpos($item['MaTBMT'], ':')) }}
                                                        </td>
                                                        <td>{{ $item['TenGoiThau'] }}</td>
                                                        <td>{{ $item['LinhVuc'] }}</td>
                                                        <td><span
                                                                class="label label-info">{{ $item['TrangThai'] }}</span>
                                                        </td>
                                                        <td>{{ $item['TinhThanh'] }}</td>
                                                        @auth
                                                            <td>{{ $item['GiaGoiThau'] }}</td>
                                                            <td>{{ $item['ThoiGianThucHien'] }}</td>
                                                        @endauth
                                                        <td>
                                                            <div>
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item['NgayDang'])->format('d/m/Y') }}
                                                            </div>
                                                            <div>
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item['NgayDang'])->format('H:i:s') }}
                                                            </div>
                                                        </td>
                                                        <td><a href="{{ $item['LienKet'] }}">Xem chi tiết</a></td>
                                                        {{-- <td>
                                                        @auth
                                                            <button class="btn btn-primary btn-sm"
                                                                onclick="followThau('{{ $item['MaTBMT'] }}')">Theo
                                                                dõi</button>
                                                        @endauth
                                                    </td> --}}

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <center>
                                        <div class="d-flex justify-content-between">
                                            <!-- Liên kết trở về trang đầu tiên -->
                                            @if ($data->currentPage() > 1)
                                                <a href="{{ $data->url(1) }}">Trang đầu</a>
                                            @endif

                                            <!-- Hiển thị danh sách các trang 2, 3, ... -->
                                            @if ($data->lastPage() > 1)
                                                <ul class="pagination">
                                                    @for ($i = max(1, $data->currentPage() - 2); $i <= min($data->currentPage() + 2, $data->lastPage()); $i++)
                                                        @if ($data->currentPage() == $i)
                                                            <li class="page-item active"><span
                                                                    class="page-link">{{ $i }}</span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link"
                                                                    href="{{ $data->url($i) }}">{{ $i }}</a>
                                                            </li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            @endif

                                            <!-- Liên kết tới trang cuối cùng -->
                                            @if ($data->currentPage() < $data->lastPage())
                                                <a href="{{ $data->url($data->lastPage()) }}">Trang cuối</a>
                                            @endif
                                        </div>
                                    </center>
                                    <script>
                                        var pageSizeFromSession = {{ session('pageSize', 10) }};
                                    </script>
                                </div>
                            </div>
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row-->
            </section><!-- .app-content -->
        </div><!-- .wrap -->

        <!-- APP FOOTER -->
        <div class="wrap p-t-0">
            <footer class="app-footer">
                <div class="clearfix">
                    {{-- <ul class="footer-menu pull-right">
                        <li><a href="javascript:void(0)">Careers</a></li>
                        <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        <li><a href="javascript:void(0)">Feedback <i class="fa fa-angle-up m-l-md"></i></a></li>
                    </ul> --}}
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
