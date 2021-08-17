<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	<!-- Mirrored from pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/ltr/vertical-modern-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 14:30:44 GMT -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
		<meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
		<meta name="author" content="PIXINVENT">
		<title>Dashboard sales - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin Dashboard</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="apple-touch-icon" href="images/ico/apple-icon-120.png">
		<link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/app-assets/images/ico/favicon.ico">
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

		@stack('css_extend')
		<!-- END: Page CSS-->
	</head>
	<!-- END: Head-->
	<!-- BEGIN: Body-->
	<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
		<!-- BEGIN: Header-->
{{--		<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">--}}
{{--			<div class="navbar-wrapper">--}}
{{--				<div class="navbar-header">--}}
{{--                    <a class="navbar-brand" href="index.html">--}}
{{--                        <img class="brand-logo" alt="modern admin logo" src="{{asset('images/logo/test.png')}}">--}}
{{--                        <h3 class="brand-text ml-1">ECO BALI</h3>--}}
{{--                    </a>--}}

{{--				</div>--}}
{{--				<div class="navbar-container content">--}}
{{--					<div class="collapse navbar-collapse" id="navbar-mobile">--}}
{{--						<ul class="nav navbar-nav mr-auto float-left">--}}
{{--						</ul>--}}
{{--						<ul class="nav navbar-nav float-right">--}}
{{--							<li class="dropdown dropdown-user nav-item">--}}
{{--								<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span id="user-identity" class="mr-1 user-name text-bold-700">{{$user['name']}} / {{$user['role']}}</span><span class="avatar avatar-online"><img src="{{asset('images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span></a>--}}
{{--								<div class="dropdown-menu dropdown-menu-right">--}}
{{--									<a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="user-cards.html"><i class="ft-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="ft-message-square"></i> Chats</a>--}}
{{--									<div class="dropdown-divider"></div>--}}
{{--									<a class="dropdown-item" href="{{url('logout')}}"><i class="ft-power"></i> Logout</a>--}}
{{--								</div>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</nav>--}}
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                        <li class="nav-item mr-auto">
                            <a class="navbar-brand" href="index.html"><img class="brand-logo" alt="modern admin logo" src="{{asset('images/logo/test.png')}}">
                                <h3 class="brand-text">ECO BALI</h3></a>
                        </li>

                        <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                    </ul>
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span id="user-identity" class="mr-1 user-name text-bold-700">{{$user['name']}} / {{$user['role']}}</span><span class="avatar avatar-online"><img src="{{asset('images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="app-email.html"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="user-cards.html"><i class="ft-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="ft-message-square"></i> Chats</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('logout')}}"><i class="ft-power"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
		<!-- END: Header-->
		<!-- BEGIN: Main Menu-->
		<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
			<div class="main-menu-content">
				<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
					<li class=" navigation-header"><span>Main Menu</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Main Menu"></i></li>
					<li class=" nav-item">
						<a><i class="la la-home"></i><span class="menu-title">Dashboard</span></a>
						<ul class="menu-content">
							<li class="@yield('dashboard-collection')"><a class="menu-item" href="{{url('dashboard1')}}"><i class="la la-arrow-circle-down mr-1"></i><span>Collection</span></a>
							</li>
							<li class="@yield('dashboard-comparison')"><a class="menu-item" href="{{url('dashboard-comparison')}}"><i class="la la-bar-chart mr-1"></i><span>Comparison</span></a>
							</li>
							<li class="@yield('dashboard-target')"><a class="menu-item" href="{{url('dashboard-target')}}"><i class="la la-crosshairs mr-1"></i><span>Target</span></a>
							</li>
							<li class="@yield('dashboard-shipment')"><a class="menu-item" href="{{url('dashboard-shipment')}}"><i class="la la-shipping-fast mr-1"></i><span>Shipment</span></a>
							</li>
							<li class="@yield('dashboard-activities')"><a class="menu-item" href="{{url('dashboard-activities')}}"><i class="la la-universal-access mr-1"></i><span>Activities</span></a>
							</li>
						</ul>
					</li>
					<li class="@yield('map') nav-item"><a href="{{url('map')}}"><i class="la la-map-marked-alt"></i><span class="menu-title" >Map</span></a></li>
					<li class="@yield('collections') nav-item"><a href="{{url('collections')}}"><i class="la la-arrow-circle-down"></i><span class="menu-title" >Collection</span></a></li>
                    <li class="@yield('sales') nav-item"><a href="{{url('sales')}}"><i class="la la-dollar-sign"></i><span class="menu-title" >Sales</span></a></li>
					<li class="@yield('participantList') nav-item"><a href="{{url('participantList')}}"><i class="la la-user-friends"></i><span class="menu-title" >Participant List</span></a></li>


					<li class="nav-item">
						<a><i class="la la-home"></i><span class="menu-title">Master Data</span></a>
						<ul class="menu-content">
							<li class="@yield('participants')"><a class="menu-item" href="{{url('participants')}}"><i class="la la-users mr-1"></i><span>Participant</span></a></li>
							<li class="@yield('categories')"><a class="menu-item" href="{{url('categories')}}"><i class="la la-layer-group mr-1"></i><span>Category</span></a></li>
							<li class="@yield('areas')"><a class="menu-item" href="{{url('areas')}}"><i class="la la-map-marker mr-1"></i><span>Area</span></a></li>
							<li class="@yield('districts')"><a class="menu-item" href="{{url('districts')}}"><i class="la la-search-location mr-1"></i><span>District</span></a></li>
							<li class="@yield('regencies')"><a class="menu-item" href="{{url('regencies')}}"><i class="la la-globe-asia mr-1"></i><span>Regency</span></a></li>
							<li class="@yield('boxResources')"><a class="menu-item" href="{{url('boxResources')}}"><i class="la la-box mr-1"></i><span>UBC Source</span></a></li>
							<li class="@yield('purchasePrices')"><a class="menu-item" href="{{url('purchasePrices')}}"><i class="la la-money-bill-wave mr-1"></i><span>Price</span></a></li>
							<li class="@yield('transportIntensities')"><a class="menu-item" href="{{url('transportIntensities')}}"><i class="la la-truck-moving mr-1"></i><span>Transport Intensity</span></a></li>
							<li class="@yield('paymentMethods')"><a class="menu-item" href="{{url('paymentMethods')}}"><i class="la la-file-invoice-dollar mr-1"></i><span>Payment Method</span></a></li>
							<li class="@yield('banks')"><a class="menu-item" href="{{url('banks')}}"><i class="la la-comments-dollar mr-1"></i><span>Bank</span></a></li>
                            <li class="@yield('papermills')"><a class="menu-item" href="{{url('papermills')}}"><i class="la la-industry mr-1"></i><span>Papermill</span></a></li>
                            <li class="@yield('papermillCategories')"><a class="menu-item" href="{{url('papermillCategories')}}"><i class="la la-layer-group mr-1"></i><span>Papermill Categories</span></a></li>
                            <li class="@yield('activityPrograms')"><a class="menu-item" href="{{url('activityPrograms')}}"><i class="la la-universal-access mr-1"></i><span>Program Activity</span></a></li>
                            <li class="@yield('activities')"><a class="menu-item" href="{{url('activities')}}"><i class="la la-chalkboard mr-1"></i><span>Activity</span></a></li>
                            <li class="@yield('potentials')"><a class="menu-item" href="{{url('potentials')}}"><i class="la la-compress mr-1"></i><span>Category Potential</span></a></li>
						</ul>
					</li>

					<li class=" navigation-header"><span>Application</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Application"></i></li>
					@if ($user['role'] == 'Admin')
						<li class="@yield('users') nav-item"><a href="{{url('user-management')}}"><i class="la la-user"></i><span class="menu-title" >User List</span></a></li>
					@endif
				</ul>
			</div>
		</div>
		<!-- END: Main Menu-->

        <!-- BEGIN: Content -->
        @yield('content')
        <!-- END: Content -->

		<!-- BEGIN: Footer-->
		<footer class="footer footer-static footer-light navbar-border navbar-shadow">
			<p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2021 </span><span class="float-md-right d-none d-lg-block">DevoID Project<span id="scroll-top"></span></span></p>
		</footer>
		<!-- END: Footer-->
		<!-- BEGIN: Vendor JS-->
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
		<!-- BEGIN: Page JS-->

        @stack('ajax_crud')
		<!-- BEGIN Vendor JS-->
		<!-- BEGIN: Page Vendor JS-->


	</body>
	<!-- END: Body-->
</html>
