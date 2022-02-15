<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8" />
    <title>CÔNG TY TNHH VẬT TƯ THIẾT BỊ Y TẾ VIỆT HẢI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/config/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('assets/css/config/default/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{asset('assets/css/config/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{asset('assets/css/config/default/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    @yield('css')

    @livewireStyles

</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid bg-danger">
                <ul class="list-unstyled topnav-menu float-end mb-0">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            @if(empty(Auth::user()->profile_photo_path))
                                <img src="{{ asset('image/unnamed.png') }}" alt="" class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" class="rounded-circle" alt="">
                            @endif
                            <span class="text-light">
                                {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Chào mừng !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('profile_info') }}" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span> Tài khoản của tôi</span>
                            </a>

                            <!-- item-->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fe-log-out"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </form>

                        </div>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">

                    <a href="{{ route('dashboard') }}" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('image/logo.jpg')}}" alt="" height="65">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('image/logo1.jpg')}}" alt="" height="65">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    @can('system.view.basic')
                    <ul id="side-menu">

                        <li>
                            <a href="{{ route('management.create_invoice') }}">
                                <i class="text-warning" data-feather="file"></i>
                                <span> Tạo hóa đơn </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('management.list_invoice') }}">
                            <i class="text-warning" data-feather="list"></i>
                                <span> Danh sách hóa đơn </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarProduct" data-bs-toggle="collapse">
                            <i class="text-warning" data-feather="shopping-cart"></i>
                                <span> Quản lý sản phẩm </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProduct">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('management.list_product') }}">Danh sách sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('management.add_product') }}">Thêm sản phẩm mới</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('management.category') }}">Danh mục sản phẩm</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarStoreHouse" data-bs-toggle="collapse">
                                <i class="text-warning" data-feather="package"></i>
                                <span> Quản lý kho </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarStoreHouse">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('management.import_to_store_house') }}">Lịch sử nhập hàng</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('management.import') }}">Nhập hàng</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarHuman" data-bs-toggle="collapse">
                                <i class="text-warning" data-feather="users"></i>
                                <span> Quản lý nhân sự </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarHuman">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('management.personel') }}">Danh sách nhân sự</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('management.wage') }}">Lương</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarAccount" data-bs-toggle="collapse">
                                <i class="text-warning" data-feather="user-check"></i>
                                <span> Quản lý tài khoản </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarAccount">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('user.confirm_user') }}">Tài khoản mới</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.grant_permission_index') }}">Cấp quyền cho tài khoản</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.role_index') }}">Nhóm quản trị</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('management.promotion') }}">
                                <i class="text-warning" data-feather="calendar"></i>
                                <span> CT khuyến mãi </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('management.list_customer') }}">
                                <i class="text-warning" data-feather="command"></i>
                                <span> Khách hàng </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('management.provider') }}">
                                <i class="text-warning" data-feather="home"></i>
                                <span> Nhà cung cấp </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('management.statistical') }}">
                                <i class="text-warning" data-feather="database"></i>
                                <span> Thống kê </span>
                            </a>
                        </li>

                    </ul>
                    @endcan
                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                @section('content')
                {{ !empty($slot) ? $slot : '' }}
                @show
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &backcong; CÔNG TY TNHH VẬT TƯ THIẾT BỊ Y TẾ VIỆT HẢI - <a href="{{ route('dashboard') }}">Trang chủ</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    @yield('script')

    <script src="{{asset('assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

    <!-- App js-->
    <script src="{{asset('assets/js/app.min.js')}}"></script>


    @livewireScripts

</body>

</html>