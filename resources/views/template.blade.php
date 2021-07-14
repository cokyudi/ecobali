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
		@stack('css_extend')
		<!-- END: Page CSS-->
	</head>
	<!-- END: Head-->
	<!-- BEGIN: Body-->
	<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
		<!-- BEGIN: Header-->
		<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
			<div class="navbar-wrapper">
				<div class="navbar-header">
					<ul class="nav navbar-nav flex-row">
						<li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
						<li class="nav-item mr-auto">
							<a class="navbar-brand" href="index.html">
								<img class="brand-logo" alt="modern admin logo" src="images/logo/logo.png">
								<h3 class="brand-text">ECO BALI</h3>
							</a>
						</li>
					</ul>
				</div>
				<div class="navbar-container content">
					<div class="collapse navbar-collapse" id="navbar-mobile">
						<ul class="nav navbar-nav mr-auto float-left">
						</ul>
						<ul class="nav navbar-nav float-right">
							<li class="dropdown dropdown-user nav-item">
								<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span id="user-identity" class="mr-1 user-name text-bold-700">{{$user['name']}} / {{$user['role']}}</span><span class="avatar avatar-online"><img src="images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
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
							<li class=""><a class="menu-item" href="index1.html"><i class="la la-database mr-1"></i><span>Collection</span></a>
							</li>
							<li><a class="menu-item" href="invoice-template.html"><i class="la la-bar-chart mr-1"></i><span>Comparison</span></a>
							</li>
							<li><a class="menu-item" href="invoice-template.html"><i class="la la-flag-checkered mr-1"></i><span>Target</span></a>
							</li>
							<li><a class="menu-item" href="invoice-template.html"><i class="la la-ship mr-1"></i><span>Shipment</span></a>
							</li>
							<li><a class="menu-item" href="invoice-template.html"><i class="la la-bitbucket mr-1"></i><span>Activities</span></a>
							</li>
						</ul>
					</li>
					<li class=" nav-item"><a href="#"><i class="la la-map"></i><span class="menu-title" >Maps</span></a></li>
					<li class=" nav-item"><a href="#"><i class="la la-database"></i><span class="menu-title" >Collection</span></a></li>
					<li class=" nav-item"><a href="#"><i class="la la-ship"></i><span class="menu-title" >Shipment</span></a></li>


					<li class="nav-item">
						<a><i class="la la-home"></i><span class="menu-title">Master Data</span></a>
						<ul class="menu-content">
							<li class="@yield('participants')"><a class="menu-item" href="{{url('participants')}}"><i class="la la-database mr-1"></i><span>Participant</span></a></li>
							<li class="@yield('categories')"><a class="menu-item" href="{{url('categories')}}"><i class="la la-database mr-1"></i><span>Category</span></a></li>
							<li class="@yield('areas')"><a class="menu-item" href="{{url('areas')}}"><i class="la la-database mr-1"></i><span>Village</span></a></li>
							<li class="@yield('subdistricts')"><a class="menu-item" href="{{url('subdistricts')}}"><i class="la la-database mr-1"></i><span>District</span></a></li>
							<li class="@yield('districts')"><a class="menu-item" href="{{url('districts')}}"><i class="la la-database mr-1"></i><span>Regency</span></a></li>
							<li class="@yield('boxResources')"><a class="menu-item" href="{{url('boxResources')}}"><i class="la la-database mr-1"></i><span>Box Resource</span></a></li>
							<li class="@yield('purchasePrices')"><a class="menu-item" href="{{url('purchasePrices')}}"><i class="la la-database mr-1"></i><span>Purchase Price</span></a></li>
							<li class="@yield('transportIntensities')"><a class="menu-item" href="{{url('transportIntensities')}}"><i class="la la-database mr-1"></i><span>Transport Intensity</span></a></li>
							<li class="@yield('paymentMethods')"><a class="menu-item" href="{{url('paymentMethods')}}"><i class="la la-database mr-1"></i><span>Payment Method</span></a></li>
							<li class="@yield('banks')"><a class="menu-item" href="{{url('banks')}}"><i class="la la-database mr-1"></i><span>Bank</span></a></li>
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
			<p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2019 <a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">PIXINVENT</a></span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
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
