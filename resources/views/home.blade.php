<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	<head>
		<title>Dashboard eco-Bali</title>

{{--        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">--}}
{{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('images/logo/test.png')}}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/jqvmap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->

        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/colors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('css/core/menu/menu-types/vertical-menu-modern.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/core/colors/palette-gradient.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/morris.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('fonts/simple-line-icons/style.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/core/colors/palette-gradient.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
		<!-- END: Page CSS-->
	</head>
	<!-- END: Head-->
	<!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-header" style="background: #fff">
                    <img class="brand-logo" alt="modern admin logo" src="{{asset('images/logo/test.png')}}" width="80" style="display: block; margin: auto;">
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 deva">Dashboard</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{url('dashboard1')}}"><i class="fa fa-truck"></i> Collection</a>
                                    <a class="dropdown-item" href="{{url('dashboard-comparison')}}"><i class="la la-bar-chart"></i> Comparison</a>
                                    <a class="dropdown-item" href="{{url('dashboard-target')}}"><i class="la la-crosshairs"></i> Target</a>
                                    <a class="dropdown-item" href="{{url('dashboard-shipment')}}"><i class="la la-shipping-fast"></i> Shipment</a>
                                    <a class="dropdown-item" href="{{url('dashboard-activities')}}"><i class="la la-universal-access"></i> Activities</a>
                                </div>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="{{url('participantList')}}">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4">Participant</span>
                                </a>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="{{url('map')}}">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4">Map</span>
                                </a>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 deva">Input Data</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{url('collections')}}"><i class="fa fa-truck"></i> Collection</a>
                                    <a class="dropdown-item" href="{{url('sales')}}"><i class="la la-dollar-sign"></i> Sales</a>
                                    <a class="dropdown-item" href="{{url('activities')}}"><i class="la la-chalkboard"></i> Activities</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>


        <script src="{{asset('vendors/js/vendors.min.js')}}"></script>

        <!-- BEGIN Vendor JS-->
        <!-- BEGIN: Page Vendor JS-->

        <script src="{{asset('vendors/js/charts/chart.min.js')}}"></script>
        <script src="{{asset('vendors/js/charts/raphael-min.js')}}"></script>
        <script src="{{asset('vendors/js/charts/morris.min.js')}}"></script>
        <script src="{{asset('vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
        <script src="{{asset('vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}"></script>
        <script src="{{asset('data/jvector/visitor-data.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <!-- chart pie -->

        <!-- chart line -->

        <!-- datatable -->
        <script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>

        <!-- END: Page Vendor JS-->
        <!-- BEGIN: Theme JS-->
        <script src="{{asset('js/core/app-menu.min.js')}}"></script>
        <script src="{{asset('js/core/app.min.js')}}"></script>
        <script src="{{asset('js/scripts/customizer.min.js')}}"></script>
        <script src="{{asset('js/scripts/footer.min.js')}}"></script>
        <!-- END: Theme JS-->

        <script src="{{asset('js/scripts/popover/popover.min.js')}}"></script>

    </body>


{{--	<body data-open="click">--}}
{{--		<!-- BEGIN: Header-->--}}
{{--        <!-- Navigation -->--}}
{{--        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="#">--}}
{{--                    <img src="https://placeholder.pics/svg/150x50/888888/EEE/Logo" alt="..." height="36">--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link font-medium-5" aria-current="page" href="#">Dashboard</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#">Link</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Dropdown--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                                <li>--}}
{{--                                    <hr class="dropdown-divider">--}}
{{--                                </li>--}}
{{--                                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <div class="container">--}}
{{--            <h1 class="mt-4">Logo Nav by Start Bootstrap</h1>--}}
{{--            <p>The logo in the navbar is now a default Bootstrap feature in Bootstrap! Make sure to set the height--}}
{{--                of the logo within the HTML or using CSS. For best results, use an SVG image as your logo.</p>--}}
{{--        </div>--}}

{{--	</body>--}}
	<!-- END: Body-->
</html>
