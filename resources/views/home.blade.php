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
{{--                <div class="navbar-header" style="background: #fff">--}}

{{--                </div>--}}
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                            <img class="brand-logo" alt="modern admin logo" src="{{asset('images/logo/test.png')}}" width="75" style="display: block; margin: auto;">
                            <li style="padding-top: 18px">
                                <span class="user-name text-bold-700 font-medium-5 color-home">ecoBali</span><br>
                                <span class="user-name text-bold-700 font-medium-2 color-home">UBC/KBM</span>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 color-home">Dashboard<i class="la la-sort-down"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item color-home" href="{{url('dashboard1')}}" ><i class="fa fa-truck"></i> Collection</a>
                                    <a class="dropdown-item color-home" href="{{url('dashboard-comparison')}}"><i class="la la-bar-chart"></i> Comparison</a>
                                    <a class="dropdown-item color-home" href="{{url('dashboard-target')}}"><i class="la la-crosshairs"></i> Target</a>
                                    <a class="dropdown-item color-home" href="{{url('dashboard-shipment')}}"><i class="la la-shipping-fast"></i> Shipment</a>
                                    <a class="dropdown-item color-home" href="{{url('dashboard-activities')}}"><i class="la la-universal-access"></i> Activities</a>
                                </div>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="{{url('participantList')}}">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 color-home">Participant</span>
                                </a>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="{{url('map')}}">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 color-home">Map</span>
                                </a>
                            </li>
                            @if ($user['role'] == 'Admin')
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700 font-medium-4 color-home">Input Data<i class="la la-sort-down"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item color-home" href="{{url('collections')}}"><i class="fa fa-truck"></i> Collection</a>
                                    <a class="dropdown-item color-home" href="{{url('sales')}}"><i class="la la-dollar-sign"></i> Sales</a>
                                    <a class="dropdown-item color-home" href="{{url('activities')}}"><i class="la la-chalkboard"></i> Activities</a>
                                </div>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div data-ride="carousel" class="carousel slide" data-interval="10000" id="carousel-example-generic">
{{--                <div id="carousel-example-generic" class="carousel slide" data-interval="10000" data-ride="carousel" >--}}
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="{{asset('images/homepage/1.jpg')}}" class="img-fluid" alt="First slide">

                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/homepage/2.jpg')}}" class="img-fluid" alt="Second slide" >
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/homepage/3.jpg')}}" class="img-fluid" alt="Third slide" >
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/homepage/4.jpg')}}" class="img-fluid" alt="Fourth slide" >
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/homepage/5.jpg')}}" class="img-fluid" alt="Fifth slide" >
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="app-content" style="margin-right: 30px; margin-left: 30px" >
            <div class="content-wrapper pt-1">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-4 col-12 ">
                            <a href="{{url('map')}}">
                                <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="numberCircle">
                                            <i class="la la-map-marked-alt font-large-3 color-home" style="margin-top: 7px;"></i>
                                        </div>
                                        <div class="media-body col-12 text-center mt-2">
                                            <h6 class="font-weight-bold font-large-1 color-home">Map</h6>
                                        </div>
                                        <div class="media d-flex mt-2">
                                            <div class="media-body text-center ">
                                                <p style="font-style: italic" class="font-medium-1 black">Shows the distribution of partners based on category and region</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-12 ">
                            <a href="{{url('dashboard1')}}">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="numberCircle">
                                                <i class="la la-home font-large-3 color-home" style="margin-top: 7px;"></i>
                                            </div>
                                            <div class="media-body col-12 text-center mt-2">

                                                <h6 class="font-weight-bold font-large-1 color-home">Dashboard</h6>

                                            </div>
                                            <div class="media d-flex mt-2">
                                                <div class="media-body text-center ">
                                                    <p style="font-style: italic" class="font-medium-1 black">Shows several dashboards including UBC data collection, data comparison, target achievement, sales data, and activities related to Used Beverage Cartons (UBC) recycling</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-12 ">
                            <a href="{{url('participantList')}}">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="numberCircle">
                                                <i class="la la-user-friends font-large-3 color-home" style="margin-top: 7px;"></i>
                                            </div>
                                            <div class="media-body col-12 text-center mt-2">
                                                <h6 class="font-weight-bold font-large-1 color-home">Participant</h6>

                                            </div>
                                            <div class="media d-flex mt-2">
                                                <div class="media-body text-center ">
                                                    <p style="font-style: italic" class="font-medium-1 black">Shows partner data including name, location, category, status, number of UBC, average per pickup, pickup continuity, and potential number of UBC</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>




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


</html>
