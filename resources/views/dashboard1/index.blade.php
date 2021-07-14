@extends('template', ['user'=>$user])


@push('css_extend')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <style type="text/css">
   	#mapid { height: 100%; width:100%;}
   </style>
@endpush 

@section('content')
          <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->

          <div class="row">
            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h6 class="text-muted font-medium-3">District Coverage</h6>
                        <h3 class="font-large-2">6</h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-map success font-large-5 float-right"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h6 class="text-muted font-medium-3">Total Collection</h6>
                        <h3 class="font-large-2">40.6 TON</h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-database success font-large-5 float-right"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h6 class="text-muted font-medium-3">Total Participant</h6>
                        <h3 class="font-large-2">68</h3>
                      </div>
                      <div class="align-self-center">
                        <i class="la la-users success font-large-5 float-right"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                  <div class="card-header mb-0">
                      <h4 class="card-title">Map</h4>
                      <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                      <div class="heading-elements">
                          <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                              <li><a data-action="close"><i class="ft-x"></i></a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="card-content collapse show">
                      <div class="card-body height-500">
                          <div id="mapid" ></div>
                      </div>
                  </div>
              </div>
          </div>
          </div>

              
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="card">
      <div class="card-header">
          <h4 class="card-title">Pie Chart</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
          <div class="heading-elements">
              <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
              </ul>
          </div>
      </div>
      <div class="card-content collapse show">
          <div class="card-body">
              <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>
              <div id="pie-3d"></div>
          </div>
      </div>
  </div>
  </div>

  <div class="col-lg-6 col-12">
    <div class="card">
      <div class="card-header">
          <h4 class="card-title">Pie Chart</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
          <div class="heading-elements">
              <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
              </ul>
          </div>
      </div>
      <div class="card-content collapse show">
          <div class="card-body">
              <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>
              <div id="pie-3d-exploded"></div>
          </div>
      </div>
  </div>
  </div>
</div>


<div class="row">
  <div class="col-xl-12 col-12">
    <div class="card">
      <div class="card-header">
          <h4 class="card-title">Dinamics</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
              <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
              </ul>
          </div>
      </div>
      <div class="card-content collapse show">
          <div class="card-body chartjs">
              <canvas id="line-chart" height="500"></canvas>
          </div>
      </div>
  </div>
  </div>



</div>
<!--/ Revenue, Hit Rate & Deals -->

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-danger box-shadow-3" href="#"><i class="ft-settings font-medium-3 spinner white"></i></a><div class="customizer-content p-2">
	<h4 class="text-uppercase mb-0">Theme Customizer</h4>
	<hr>
	<p>Customize & Preview in Real Time</p>
	<h5 class="mt-1 mb-1 text-bold-500">Menu Color Options</h5>
	<div class="form-group">
		<!-- Outline Button group -->
		<div class="btn-group customizer-sidebar-options" role="group" aria-label="Basic example">
			<button type="button" class="btn btn-outline-info" data-sidebar="menu-light">Light Menu</button>
			<button type="button" class="btn btn-outline-info" data-sidebar="menu-dark">Dark Menu</button>
		</div>
	</div>
	<hr>
	<h5 class="mt-1 text-bold-500">Layout Options</h5>
	<ul class="nav nav-tabs nav-underline nav-justified layout-options">
		<li class="nav-item">
			<a class="nav-link layouts active" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21" aria-expanded="true">Layouts</a>
		</li>
		<li class="nav-item">
			<a class="nav-link navigation" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22" aria-expanded="false">Navigation</a>
		</li>
		<li class="nav-item">
			<a class="nav-link navbar" id="baseIcon-tab23" data-toggle="tab" aria-controls="tabIcon23" href="#tabIcon23" aria-expanded="false">Navbar</a>
		</li>
	</ul>
	<div class="tab-content px-1 pt-1">
		<div role="tabpanel" class="tab-pane active" id="tabIcon21" aria-expanded="true" aria-labelledby="baseIcon-tab21">
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="collapsed-sidebar" id="collapsed-sidebar">
				<label class="custom-control-label" for="collapsed-sidebar">Collapsed Menu</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="fixed-layout" id="fixed-layout">
				<label class="custom-control-label" for="fixed-layout">Fixed Layout</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
				<label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="static-layout" id="static-layout">
				<label class="custom-control-label" for="static-layout">Static Layout</label>
			</div>
		</div>
		<div class="tab-pane" id="tabIcon22" aria-labelledby="baseIcon-tab22">
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="native-scroll" id="native-scroll">
				<label class="custom-control-label" for="native-scroll">Native Scroll</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="right-side-icons" id="right-side-icons">
				<label class="custom-control-label" for="right-side-icons">Right Side Icons</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="bordered-navigation" id="bordered-navigation">
				<label class="custom-control-label" for="bordered-navigation">Bordered Navigation</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="flipped-navigation" id="flipped-navigation">
				<label class="custom-control-label" for="flipped-navigation">Flipped Navigation</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="collapsible-navigation" id="collapsible-navigation">
				<label class="custom-control-label" for="collapsible-navigation">Collapsible Navigation</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="static-navigation" id="static-navigation">
				<label class="custom-control-label" for="static-navigation">Static Navigation</label>
			</div>
		</div>
		<div class="tab-pane" id="tabIcon23" aria-labelledby="baseIcon-tab23">
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="brand-center" id="brand-center">
				<label class="custom-control-label" for="brand-center">Brand Center</label>
			</div>
			<div class="custom-control custom-checkbox mb-1">
				<input type="checkbox" class="custom-control-input" name="navbar-static-top" id="navbar-static-top">
				<label class="custom-control-label" for="navbar-static-top">Static Top</label>
			</div>
		</div>
	</div>
	<hr>
	<h5 class="mt-1 text-bold-500">Navigation Color Options</h5>
	<ul class="nav nav-tabs nav-underline nav-justified color-options">
		<li class="nav-item w-100">
			<a class="nav-link nav-semi-light active" id="color-opt-1" data-toggle="tab" aria-controls="clrOpt1" href="#clrOpt1" aria-expanded="false">Semi Light</a>
		</li>
		<li class="nav-item  w-100">
			<a class="nav-link nav-semi-dark" id="color-opt-2" data-toggle="tab" aria-controls="clrOpt2" href="#clrOpt2" aria-expanded="false">Semi Dark</a>
		</li>
		<li class="nav-item">
			<a class="nav-link nav-dark" id="color-opt-3" data-toggle="tab" aria-controls="clrOpt3" href="#clrOpt3" aria-expanded="false">Dark</a>
		</li>
		<li class="nav-item">
			<a class="nav-link nav-light" id="color-opt-4" data-toggle="tab" aria-controls="clrOpt4" href="#clrOpt4" aria-expanded="true">Light</a>
		</li>
	</ul>
	<div class="tab-content px-1 pt-1">
		<div role="tabpanel" class="tab-pane active" id="clrOpt1" aria-expanded="true" aria-labelledby="color-opt-1">
			<div class="row">
				<div class="col-6">
					<h6>Solid</h6>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="default">
						<label class="custom-control-label" for="default">Default</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="primary">
						<label class="custom-control-label" for="primary">Primary</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="danger">
						<label class="custom-control-label" for="danger">Danger</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-success" id="success">
						<label class="custom-control-label" for="success">Success</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="blue">
						<label class="custom-control-label" for="blue">Blue</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="cyan">
						<label class="custom-control-label" for="cyan">Cyan</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="pink">
						<label class="custom-control-label" for="pink">Pink</label>
					</div>
				</div>
				<div class="col-6">
					<h6>Gradient</h6>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" checked class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue">
						<label class="custom-control-label" for="bg-gradient-x-grey-blue">Default</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary">
						<label class="custom-control-label" for="bg-gradient-x-primary">Primary</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger">
						<label class="custom-control-label" for="bg-gradient-x-danger">Danger</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success">
						<label class="custom-control-label" for="bg-gradient-x-success">Success</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue">
						<label class="custom-control-label" for="bg-gradient-x-blue">Blue</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan">
						<label class="custom-control-label" for="bg-gradient-x-cyan">Cyan</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-slight-clr" class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink">
						<label class="custom-control-label" for="bg-gradient-x-pink">Pink</label>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="clrOpt2" aria-labelledby="color-opt-2">
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" checked class="custom-control-input bg-default" data-bg="bg-default" id="opt-default">
				<label class="custom-control-label" for="opt-default">Default</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="opt-primary">
				<label class="custom-control-label" for="opt-primary">Primary</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="opt-danger">
				<label class="custom-control-label" for="opt-danger">Danger</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="opt-success">
				<label class="custom-control-label" for="opt-success">Success</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="opt-blue">
				<label class="custom-control-label" for="opt-blue">Blue</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="opt-cyan">
				<label class="custom-control-label" for="opt-cyan">Cyan</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-sdark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="opt-pink">
				<label class="custom-control-label" for="opt-pink">Pink</label>
			</div>
		</div>
		<div class="tab-pane" id="clrOpt3" aria-labelledby="color-opt-3">
			<div class="row">
				<div class="col-6">
					<h3>Solid</h3>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey" id="solid-blue-grey">
						<label class="custom-control-label" for="solid-blue-grey">Default</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-primary" data-bg="bg-primary" id="solid-primary">
						<label class="custom-control-label" for="solid-primary">Primary</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-danger" data-bg="bg-danger" id="solid-danger">
						<label class="custom-control-label" for="solid-danger">Danger</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-success" data-bg="bg-success" id="solid-success">
						<label class="custom-control-label" for="solid-success">Success</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue" data-bg="bg-blue" id="solid-blue">
						<label class="custom-control-label" for="solid-blue">Blue</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan" id="solid-cyan">
						<label class="custom-control-label" for="solid-cyan">Cyan</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-pink" data-bg="bg-pink" id="solid-pink">
						<label class="custom-control-label" for="solid-pink">Pink</label>
					</div>
				</div>

				<div class="col-6">
					<h3>Gradient</h3>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" class="custom-control-input bg-blue-grey" data-bg="bg-gradient-x-grey-blue" id="bg-gradient-x-grey-blue1">
						<label class="custom-control-label" for="bg-gradient-x-grey-blue1">Default</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-primary" data-bg="bg-gradient-x-primary" id="bg-gradient-x-primary1">
						<label class="custom-control-label" for="bg-gradient-x-primary1">Primary</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-danger" data-bg="bg-gradient-x-danger" id="bg-gradient-x-danger1">
						<label class="custom-control-label" for="bg-gradient-x-danger1">Danger</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-success" data-bg="bg-gradient-x-success" id="bg-gradient-x-success1">
						<label class="custom-control-label" for="bg-gradient-x-success1">Success</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-blue" data-bg="bg-gradient-x-blue" id="bg-gradient-x-blue1">
						<label class="custom-control-label" for="bg-gradient-x-blue1">Blue</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-cyan" data-bg="bg-gradient-x-cyan" id="bg-gradient-x-cyan1">
						<label class="custom-control-label" for="bg-gradient-x-cyan1">Cyan</label>
					</div>
					<div class="custom-control custom-radio mb-1">
						<input type="radio" name="nav-dark-clr" checked class="custom-control-input bg-pink" data-bg="bg-gradient-x-pink" id="bg-gradient-x-pink1">
						<label class="custom-control-label" for="bg-gradient-x-pink1">Pink</label>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="clrOpt4" aria-labelledby="color-opt-4">
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue-grey" data-bg="bg-blue-grey bg-lighten-4" id="light-blue-grey">
				<label class="custom-control-label" for="light-blue-grey">Default</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-primary" data-bg="bg-primary bg-lighten-4" id="light-primary">
				<label class="custom-control-label" for="light-primary">Primary</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-danger" data-bg="bg-danger bg-lighten-4" id="light-danger">
				<label class="custom-control-label" for="light-danger">Danger</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-success" data-bg="bg-success bg-lighten-4" id="light-success">
				<label class="custom-control-label" for="light-success">Success</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-blue" data-bg="bg-blue bg-lighten-4" id="light-blue">
				<label class="custom-control-label" for="light-blue">Blue</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-cyan" data-bg="bg-cyan bg-lighten-4" id="light-cyan">
				<label class="custom-control-label" for="light-cyan">Cyan</label>
			</div>
			<div class="custom-control custom-radio mb-1">
				<input type="radio" name="nav-light-clr" class="custom-control-input bg-pink" data-bg="bg-pink bg-lighten-4" id="light-pink">
				<label class="custom-control-label" for="light-pink">Pink</label>
			</div>
		</div>
	</div>
</div>
    </div>
    <!-- End: Customizer-->
        <!-- END: Content -->
        @endsection

@push('ajax_crud')
<script src="https://www.google.com/jsapi"></script>
<script src="{{asset('js/scripts/charts/google/pie/pie.min.js')}}"></script>
<script src="{{asset('js/scripts/charts/google/pie/3d-pie.min.js')}}"></script>
<script src="{{asset('js/scripts/charts/google/pie/3d-pie-exploded.min.js')}}"></script>
<script src="{{asset('js/scripts/charts/chartjs/line/line.min.js')}}"></script>

<script>
var mymap = L.map('mapid').setView([-8.36, 115.19], 8.75);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2twbXBweGkzMmgycTJvcmkxM3ozeDhmaCJ9.w1rN2S1A6G5SJFoitaoQvQ', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGV2YWFkczIiLCJhIjoiY2twbXBweGkzMmgycTJvcmkxM3ozeDhmaCJ9.w1rN2S1A6G5SJFoitaoQvQ'
}).addTo(mymap);


var province = [
{ "type": "Feature", "properties": { "id": 1, "kabupaten": "Negara", "sampah": "100 Kg" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 114.44432, -8.15081 ], [ 114.44544, -8.15147 ], [ 114.45111, -8.15759 ], [ 114.4542, -8.16014 ], [ 114.46142, -8.16371 ], [ 114.46554, -8.1683 ], [ 114.45987, -8.178 ], [ 114.45781, -8.18718 ], [ 114.46193, -8.19432 ], [ 114.47224, -8.19687 ], [ 114.48616, -8.19483 ], [ 114.49543, -8.19585 ], [ 114.5042, -8.20095 ], [ 114.51141, -8.20605 ], [ 114.51708, -8.20758 ], [ 114.52327, -8.20605 ], [ 114.52894, -8.19891 ], [ 114.53461, -8.1933 ], [ 114.54234, -8.19636 ], [ 114.54852, -8.19942 ], [ 114.55883, -8.19993 ], [ 114.56914, -8.1933 ], [ 114.57429, -8.18973 ], [ 114.58254, -8.18463 ], [ 114.59078, -8.18004 ], [ 114.60058, -8.17851 ], [ 114.61346, -8.18208 ], [ 114.61965, -8.18565 ], [ 114.62583, -8.19891 ], [ 114.62892, -8.2086 ], [ 114.63305, -8.21524 ], [ 114.64078, -8.21728 ], [ 114.64748, -8.22289 ], [ 114.65366, -8.22595 ], [ 114.66449, -8.22595 ], [ 114.67067, -8.2234 ], [ 114.67943, -8.22799 ], [ 114.68562, -8.23054 ], [ 114.68974, -8.22748 ], [ 114.6949, -8.21677 ], [ 114.69799, -8.20962 ], [ 114.70005, -8.2035 ], [ 114.7119, -8.20758 ], [ 114.72067, -8.21269 ], [ 114.73252, -8.21932 ], [ 114.74386, -8.22493 ], [ 114.75365, -8.22697 ], [ 114.76035, -8.23819 ], [ 114.76448, -8.24686 ], [ 114.77169, -8.25859 ], [ 114.77684, -8.26369 ], [ 114.78509, -8.2591 ], [ 114.79025, -8.25604 ], [ 114.80519, -8.25553 ], [ 114.81189, -8.25757 ], [ 114.81498, -8.26573 ], [ 114.8155, -8.27389 ], [ 114.81705, -8.28308 ], [ 114.81808, -8.29634 ], [ 114.81911, -8.30042 ], [ 114.8222, -8.31368 ], [ 114.82426, -8.32337 ], [ 114.82581, -8.33152 ], [ 114.82787, -8.33662 ], [ 114.83405, -8.33968 ], [ 114.84282, -8.34274 ], [ 114.849, -8.34121 ], [ 114.86034, -8.34325 ], [ 114.86601, -8.34019 ], [ 114.87168, -8.34172 ], [ 114.87838, -8.34784 ], [ 114.8892, -8.35345 ], [ 114.89693, -8.35855 ], [ 114.90054, -8.36467 ], [ 114.90415, -8.3713 ], [ 114.91188, -8.37742 ], [ 114.92116, -8.38201 ], [ 114.93507, -8.38558 ], [ 114.93765, -8.39781 ], [ 114.93043, -8.4075 ], [ 114.92528, -8.41923 ], [ 114.92734, -8.43095 ], [ 114.92683, -8.43758 ], [ 114.92373, -8.45135 ], [ 114.92064, -8.4595 ], [ 114.91636, -8.4661 ], [ 114.90811, -8.46155 ], [ 114.89339, -8.45324 ], [ 114.87074, -8.44515 ], [ 114.8524, -8.43845 ], [ 114.82741, -8.4336 ], [ 114.81129, -8.42205 ], [ 114.79844, -8.41257 ], [ 114.78023, -8.40656 ], [ 114.76855, -8.40425 ], [ 114.75593, -8.40056 ], [ 114.74262, -8.39802 ], [ 114.73164, -8.39709 ], [ 114.71436, -8.3964 ], [ 114.69801, -8.39825 ], [ 114.67255, -8.40102 ], [ 114.66063, -8.40287 ], [ 114.64475, -8.40518 ], [ 114.63704, -8.40656 ], [ 114.62863, -8.40772 ], [ 114.61929, -8.40587 ], [ 114.60948, -8.40333 ], [ 114.59967, -8.39986 ], [ 114.59173, -8.39686 ], [ 114.58659, -8.39339 ], [ 114.57888, -8.38762 ], [ 114.57024, -8.37641 ], [ 114.56744, -8.37364 ], [ 114.5616, -8.36901 ], [ 114.55809, -8.36532 ], [ 114.55506, -8.36116 ], [ 114.55015, -8.35723 ], [ 114.54642, -8.35446 ], [ 114.54572, -8.35122 ], [ 114.54361, -8.34614 ], [ 114.53964, -8.34267 ], [ 114.53217, -8.34105 ], [ 114.5282, -8.33943 ], [ 114.52315, -8.33451 ], [ 114.52253, -8.33356 ], [ 114.52148, -8.33188 ], [ 114.52049, -8.33029 ], [ 114.51988, -8.32928 ], [ 114.51839, -8.3247 ], [ 114.51807, -8.32381 ], [ 114.51847, -8.32253 ], [ 114.51859, -8.32112 ], [ 114.51871, -8.31985 ], [ 114.5192, -8.31832 ], [ 114.5195, -8.3169 ], [ 114.51979, -8.31511 ], [ 114.51979, -8.31352 ], [ 114.51976, -8.31184 ], [ 114.51055, -8.30127 ], [ 114.50955, -8.30052 ], [ 114.50839, -8.29957 ], [ 114.50739, -8.29867 ], [ 114.50473, -8.29609 ], [ 114.50441, -8.29587 ], [ 114.504, -8.29542 ], [ 114.5038, -8.29504 ], [ 114.50353, -8.29464 ], [ 114.50321, -8.2942 ], [ 114.50299, -8.29388 ], [ 114.50224, -8.29307 ], [ 114.50205, -8.29279 ], [ 114.5018, -8.29255 ], [ 114.50132, -8.29216 ], [ 114.50081, -8.2918 ], [ 114.50042, -8.29143 ], [ 114.49992, -8.29101 ], [ 114.49932, -8.29064 ], [ 114.49906, -8.29036 ], [ 114.49795, -8.28904 ], [ 114.49749, -8.28853 ], [ 114.497, -8.28795 ], [ 114.49639, -8.28735 ], [ 114.49563, -8.28667 ], [ 114.4949, -8.28602 ], [ 114.49455, -8.2855 ], [ 114.49381, -8.285 ], [ 114.49224, -8.28395 ], [ 114.49116, -8.28326 ], [ 114.49, -8.28277 ], [ 114.48889, -8.28225 ], [ 114.48857, -8.28164 ], [ 114.48859, -8.28121 ], [ 114.48862, -8.28066 ], [ 114.48786, -8.27991 ], [ 114.48693, -8.27892 ], [ 114.48591, -8.27832 ], [ 114.48518, -8.27762 ], [ 114.48398, -8.27629 ], [ 114.48316, -8.27525 ], [ 114.48252, -8.2741 ], [ 114.4822, -8.27314 ], [ 114.48223, -8.27234 ], [ 114.48197, -8.2714 ], [ 114.48162, -8.27038 ], [ 114.48103, -8.26955 ], [ 114.48059, -8.26871 ], [ 114.47998, -8.26784 ], [ 114.47946, -8.26674 ], [ 114.4789, -8.2657 ], [ 114.4789, -8.26452 ], [ 114.47884, -8.26296 ], [ 114.4784, -8.26224 ], [ 114.47643, -8.25956 ], [ 114.47559, -8.25858 ], [ 114.47448, -8.25745 ], [ 114.47284, -8.25589 ], [ 114.4717, -8.2535 ], [ 114.47086, -8.25127 ], [ 114.47039, -8.24939 ], [ 114.46984, -8.24752 ], [ 114.46931, -8.2461 ], [ 114.46829, -8.24477 ], [ 114.46365, -8.23937 ], [ 114.46049, -8.23601 ], [ 114.45827, -8.23266 ], [ 114.455, -8.23058 ], [ 114.45384, -8.22769 ], [ 114.45033, -8.22307 ], [ 114.448, -8.21891 ], [ 114.44613, -8.21209 ], [ 114.44449, -8.20596 ], [ 114.44239, -8.19868 ], [ 114.44052, -8.1914 ], [ 114.43865, -8.18492 ], [ 114.43643, -8.16192 ], [ 114.4404, -8.15845 ], [ 114.44379, -8.15267 ], [ 114.44432, -8.15081 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 2, "kabupaten": "Klungkung", "sampah": "90 Kg" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.44428, -8.66051 ], [ 115.45526, -8.66074 ], [ 115.4583, -8.66166 ], [ 115.46577, -8.66305 ], [ 115.47115, -8.66444 ], [ 115.4736, -8.66709 ], [ 115.47453, -8.67159 ], [ 115.47348, -8.67483 ], [ 115.47185, -8.67794 ], [ 115.46858, -8.68106 ], [ 115.46741, -8.68626 ], [ 115.46414, -8.68937 ], [ 115.46204, -8.69411 ], [ 115.45842, -8.69745 ], [ 115.45643, -8.70057 ], [ 115.45293, -8.70334 ], [ 115.45141, -8.70681 ], [ 115.44685, -8.70842 ], [ 115.44405, -8.71165 ], [ 115.44113, -8.71108 ], [ 115.43856, -8.70808 ], [ 115.43915, -8.70484 ], [ 115.43856, -8.70057 ], [ 115.43693, -8.69653 ], [ 115.43377, -8.69284 ], [ 115.43167, -8.69226 ], [ 115.42828, -8.68903 ], [ 115.42793, -8.68522 ], [ 115.4291, -8.68268 ], [ 115.43401, -8.68083 ], [ 115.43693, -8.67702 ], [ 115.4402, -8.67321 ], [ 115.44335, -8.67067 ], [ 115.44428, -8.66848 ], [ 115.44382, -8.66559 ], [ 115.44382, -8.66293 ], [ 115.44428, -8.66051 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 2, "kabupaten": "Klungkung" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.49147, -8.67379 ], [ 115.49567, -8.67148 ], [ 115.49894, -8.67148 ], [ 115.50642, -8.67333 ], [ 115.51062, -8.67517 ], [ 115.52136, -8.67887 ], [ 115.52884, -8.67794 ], [ 115.53865, -8.67563 ], [ 115.54846, -8.67379 ], [ 115.56014, -8.67055 ], [ 115.56995, -8.6761 ], [ 115.57509, -8.68071 ], [ 115.57882, -8.68533 ], [ 115.58069, -8.68995 ], [ 115.58583, -8.69826 ], [ 115.58863, -8.70657 ], [ 115.59237, -8.71119 ], [ 115.59611, -8.7135 ], [ 115.59891, -8.71812 ], [ 115.60265, -8.72412 ], [ 115.60639, -8.72643 ], [ 115.61246, -8.73382 ], [ 115.61993, -8.74213 ], [ 115.62274, -8.74952 ], [ 115.62507, -8.75783 ], [ 115.62834, -8.76244 ], [ 115.62741, -8.76983 ], [ 115.62647, -8.7726 ], [ 115.6218, -8.7763 ], [ 115.619, -8.77722 ], [ 115.61526, -8.77999 ], [ 115.61246, -8.78276 ], [ 115.60966, -8.78784 ], [ 115.60779, -8.79522 ], [ 115.60779, -8.79984 ], [ 115.60499, -8.80815 ], [ 115.60358, -8.80954 ], [ 115.59938, -8.81046 ], [ 115.59471, -8.81554 ], [ 115.5919, -8.81923 ], [ 115.58116, -8.81692 ], [ 115.57462, -8.81277 ], [ 115.56901, -8.80907 ], [ 115.55967, -8.80492 ], [ 115.55033, -8.80076 ], [ 115.54239, -8.79892 ], [ 115.52884, -8.79799 ], [ 115.52884, -8.7943 ], [ 115.52604, -8.78784 ], [ 115.5209, -8.7823 ], [ 115.51155, -8.7763 ], [ 115.50922, -8.77537 ], [ 115.49801, -8.77399 ], [ 115.49053, -8.76475 ], [ 115.48446, -8.76198 ], [ 115.47699, -8.7569 ], [ 115.47138, -8.7509 ], [ 115.46297, -8.74628 ], [ 115.45316, -8.73751 ], [ 115.45409, -8.72828 ], [ 115.45643, -8.71858 ], [ 115.45923, -8.71027 ], [ 115.46671, -8.7038 ], [ 115.47138, -8.69734 ], [ 115.47512, -8.68949 ], [ 115.48212, -8.68487 ], [ 115.48773, -8.68025 ], [ 115.49147, -8.67379 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 5, "kabupaten": "Tabanan" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 114.93241, -8.38489 ], [ 114.9325, -8.38481 ], [ 114.93172, -8.38124 ], [ 114.93198, -8.37716 ], [ 114.93301, -8.37181 ], [ 114.93482, -8.36722 ], [ 114.93868, -8.36085 ], [ 114.94152, -8.35906 ], [ 114.94615, -8.35957 ], [ 114.94847, -8.36187 ], [ 114.95234, -8.36059 ], [ 114.95311, -8.35677 ], [ 114.95414, -8.35243 ], [ 114.95827, -8.34504 ], [ 114.95801, -8.33968 ], [ 114.95775, -8.33509 ], [ 114.96007, -8.32923 ], [ 114.96136, -8.32591 ], [ 114.96239, -8.32107 ], [ 114.96445, -8.31342 ], [ 114.96651, -8.30883 ], [ 114.97038, -8.3073 ], [ 114.97605, -8.30603 ], [ 114.9794, -8.30297 ], [ 114.98429, -8.30016 ], [ 114.98429, -8.29532 ], [ 114.98687, -8.29175 ], [ 114.99306, -8.29608 ], [ 114.99589, -8.30042 ], [ 114.99924, -8.30348 ], [ 115.00336, -8.30603 ], [ 115.00929, -8.30858 ], [ 115.01393, -8.31036 ], [ 115.01934, -8.31138 ], [ 115.02269, -8.30909 ], [ 115.02501, -8.30679 ], [ 115.02707, -8.30424 ], [ 115.0312, -8.30271 ], [ 115.03429, -8.3022 ], [ 115.0397, -8.30399 ], [ 115.04279, -8.30654 ], [ 115.04795, -8.30807 ], [ 115.05465, -8.30934 ], [ 115.05877, -8.31011 ], [ 115.0647, -8.31164 ], [ 115.07088, -8.31291 ], [ 115.07732, -8.31393 ], [ 115.08299, -8.31393 ], [ 115.08892, -8.31368 ], [ 115.09304, -8.3124 ], [ 115.09665, -8.31087 ], [ 115.10052, -8.3096 ], [ 115.10181, -8.30858 ], [ 115.10258, -8.30628 ], [ 115.10361, -8.30297 ], [ 115.10361, -8.3022 ], [ 115.10567, -8.29914 ], [ 115.11134, -8.29965 ], [ 115.11598, -8.30271 ], [ 115.1201, -8.30628 ], [ 115.12345, -8.30756 ], [ 115.12809, -8.3073 ], [ 115.12887, -8.30501 ], [ 115.13106, -8.29481 ], [ 115.13492, -8.28792 ], [ 115.13492, -8.2818 ], [ 115.13492, -8.27389 ], [ 115.14394, -8.26828 ], [ 115.14909, -8.26548 ], [ 115.15476, -8.26344 ], [ 115.15889, -8.25885 ], [ 115.16688, -8.25477 ], [ 115.17151, -8.25094 ], [ 115.17564, -8.24686 ], [ 115.18028, -8.2461 ], [ 115.18749, -8.24763 ], [ 115.19007, -8.25324 ], [ 115.18852, -8.26038 ], [ 115.18801, -8.26701 ], [ 115.18852, -8.27338 ], [ 115.19213, -8.2795 ], [ 115.19574, -8.28512 ], [ 115.19909, -8.29098 ], [ 115.20295, -8.29914 ], [ 115.20605, -8.30603 ], [ 115.20811, -8.31342 ], [ 115.20811, -8.32209 ], [ 115.20888, -8.33127 ], [ 115.20837, -8.33815 ], [ 115.20734, -8.3458 ], [ 115.20527, -8.35192 ], [ 115.20295, -8.36008 ], [ 115.20141, -8.37104 ], [ 115.20476, -8.37869 ], [ 115.20656, -8.38507 ], [ 115.2094, -8.40049 ], [ 115.21043, -8.41069 ], [ 115.21172, -8.42089 ], [ 115.213, -8.42904 ], [ 115.21455, -8.43949 ], [ 115.21223, -8.44842 ], [ 115.20424, -8.45148 ], [ 115.20115, -8.44995 ], [ 115.19419, -8.45097 ], [ 115.18852, -8.45683 ], [ 115.1844, -8.46295 ], [ 115.18234, -8.47263 ], [ 115.18182, -8.47926 ], [ 115.1826, -8.48767 ], [ 115.18414, -8.49251 ], [ 115.17564, -8.51692 ], [ 115.17358, -8.52507 ], [ 115.16945, -8.53119 ], [ 115.16353, -8.53425 ], [ 115.15966, -8.5424 ], [ 115.16018, -8.54979 ], [ 115.15992, -8.5582 ], [ 115.15296, -8.57107 ], [ 115.14832, -8.57795 ], [ 115.14626, -8.58483 ], [ 115.14858, -8.58993 ], [ 115.15064, -8.5963 ], [ 115.15219, -8.60063 ], [ 115.14987, -8.60572 ], [ 115.14471, -8.61006 ], [ 115.14059, -8.61337 ], [ 115.13724, -8.61464 ], [ 115.13209, -8.61286 ], [ 115.1259, -8.61209 ], [ 115.11714, -8.61439 ], [ 115.11173, -8.61974 ], [ 115.10812, -8.62585 ], [ 115.10297, -8.63273 ], [ 115.09936, -8.63401 ], [ 115.09796, -8.63525 ], [ 115.09661, -8.6341 ], [ 115.08399, -8.61401 ], [ 115.06414, -8.58745 ], [ 115.0291, -8.55927 ], [ 114.99138, -8.52272 ], [ 114.97106, -8.50539 ], [ 114.9463, -8.48506 ], [ 114.92236, -8.46941 ], [ 114.91636, -8.4661 ], [ 114.92064, -8.4595 ], [ 114.92373, -8.45135 ], [ 114.92683, -8.43758 ], [ 114.92734, -8.43095 ], [ 114.92528, -8.41923 ], [ 114.93043, -8.4075 ], [ 114.93765, -8.39781 ], [ 114.93507, -8.38558 ], [ 114.93241, -8.38489 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 3, "kabupaten": "Denpasar" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.1896, -8.73896 ], [ 115.18909, -8.73819 ], [ 115.18716, -8.73666 ], [ 115.18433, -8.73373 ], [ 115.18381, -8.73093 ], [ 115.18291, -8.72724 ], [ 115.18239, -8.72303 ], [ 115.18227, -8.71909 ], [ 115.18033, -8.71284 ], [ 115.17776, -8.70839 ], [ 115.17544, -8.70558 ], [ 115.17582, -8.69858 ], [ 115.17557, -8.68992 ], [ 115.17234, -8.68317 ], [ 115.17518, -8.67575 ], [ 115.17621, -8.67142 ], [ 115.17453, -8.66861 ], [ 115.17234, -8.66403 ], [ 115.17595, -8.65677 ], [ 115.17853, -8.65435 ], [ 115.17917, -8.64683 ], [ 115.18033, -8.63868 ], [ 115.17917, -8.63027 ], [ 115.17969, -8.62339 ], [ 115.18227, -8.616 ], [ 115.18845, -8.61346 ], [ 115.19348, -8.61154 ], [ 115.19979, -8.60581 ], [ 115.20494, -8.60314 ], [ 115.20881, -8.59995 ], [ 115.21551, -8.59715 ], [ 115.22337, -8.59473 ], [ 115.2293, -8.59473 ], [ 115.23393, -8.59651 ], [ 115.23522, -8.59957 ], [ 115.23741, -8.60428 ], [ 115.24231, -8.61002 ], [ 115.24708, -8.61549 ], [ 115.25339, -8.62021 ], [ 115.25803, -8.62938 ], [ 115.26048, -8.63626 ], [ 115.26421, -8.64072 ], [ 115.26988, -8.64594 ], [ 115.27311, -8.65142 ], [ 115.27332, -8.65228 ], [ 115.27284, -8.65266 ], [ 115.26887, -8.65566 ], [ 115.26513, -8.65959 ], [ 115.26303, -8.66213 ], [ 115.26209, -8.66698 ], [ 115.2635, -8.67067 ], [ 115.26536, -8.6746 ], [ 115.2649, -8.67991 ], [ 115.26653, -8.68429 ], [ 115.26723, -8.68868 ], [ 115.26525, -8.70031 ], [ 115.26455, -8.70378 ], [ 115.26291, -8.70747 ], [ 115.25988, -8.70966 ], [ 115.25672, -8.7107 ], [ 115.25135, -8.71209 ], [ 115.24785, -8.71319 ], [ 115.24647, -8.71167 ], [ 115.24556, -8.71093 ], [ 115.24331, -8.71049 ], [ 115.24179, -8.71046 ], [ 115.2377, -8.71192 ], [ 115.23506, -8.71364 ], [ 115.231, -8.71555 ], [ 115.22804, -8.71609 ], [ 115.22656, -8.71708 ], [ 115.22601, -8.71851 ], [ 115.22575, -8.71985 ], [ 115.22546, -8.72074 ], [ 115.2254, -8.72249 ], [ 115.2283, -8.72564 ], [ 115.22939, -8.7258 ], [ 115.22998, -8.72481 ], [ 115.23126, -8.72372 ], [ 115.23261, -8.72378 ], [ 115.23418, -8.72262 ], [ 115.23582, -8.72152 ], [ 115.23809, -8.72106 ], [ 115.24014, -8.72199 ], [ 115.24201, -8.72331 ], [ 115.24282, -8.72453 ], [ 115.24481, -8.72608 ], [ 115.24516, -8.72799 ], [ 115.2479, -8.72839 ], [ 115.24913, -8.72833 ], [ 115.25106, -8.72943 ], [ 115.24995, -8.73059 ], [ 115.24796, -8.73139 ], [ 115.24627, -8.73486 ], [ 115.24434, -8.7374 ], [ 115.24388, -8.7393 ], [ 115.2423, -8.7404 ], [ 115.24043, -8.7419 ], [ 115.23862, -8.74305 ], [ 115.23687, -8.74421 ], [ 115.23523, -8.74594 ], [ 115.23424, -8.74784 ], [ 115.23348, -8.74934 ], [ 115.23103, -8.75067 ], [ 115.22998, -8.75246 ], [ 115.22823, -8.75211 ], [ 115.22478, -8.75061 ], [ 115.21976, -8.74905 ], [ 115.21842, -8.74767 ], [ 115.21795, -8.74588 ], [ 115.21733, -8.74532 ], [ 115.21678, -8.74468 ], [ 115.21643, -8.74421 ], [ 115.21627, -8.74357 ], [ 115.21585, -8.74347 ], [ 115.21578, -8.7429 ], [ 115.21533, -8.74249 ], [ 115.21575, -8.74137 ], [ 115.21633, -8.7408 ], [ 115.21659, -8.73975 ], [ 115.21681, -8.73902 ], [ 115.21691, -8.73873 ], [ 115.21739, -8.73749 ], [ 115.21992, -8.73193 ], [ 115.21986, -8.7315 ], [ 115.21992, -8.73093 ], [ 115.21989, -8.73047 ], [ 115.2197, -8.72907 ], [ 115.2186, -8.72878 ], [ 115.21789, -8.72881 ], [ 115.2167, -8.72843 ], [ 115.2159, -8.72865 ], [ 115.21445, -8.72884 ], [ 115.21174, -8.73044 ], [ 115.20694, -8.73337 ], [ 115.20346, -8.73356 ], [ 115.20163, -8.73378 ], [ 115.1986, -8.73524 ], [ 115.19647, -8.73575 ], [ 115.19512, -8.73703 ], [ 115.19282, -8.73877 ], [ 115.19125, -8.73881 ], [ 115.19017, -8.73896 ], [ 115.18964, -8.73894 ], [ 115.1896, -8.73896 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 4, "kabupaten": "Singaraja" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.44696, -8.1696 ], [ 115.44589, -8.17113 ], [ 115.4428, -8.17368 ], [ 115.44109, -8.17577 ], [ 115.43952, -8.17666 ], [ 115.43282, -8.18252 ], [ 115.42844, -8.18354 ], [ 115.41942, -8.18737 ], [ 115.4171, -8.18431 ], [ 115.41479, -8.18201 ], [ 115.41272, -8.17666 ], [ 115.4104, -8.17436 ], [ 115.40138, -8.17206 ], [ 115.39623, -8.17411 ], [ 115.38876, -8.17768 ], [ 115.38438, -8.17615 ], [ 115.38154, -8.17411 ], [ 115.37896, -8.16824 ], [ 115.37613, -8.1662 ], [ 115.37046, -8.16696 ], [ 115.36737, -8.16441 ], [ 115.36479, -8.16135 ], [ 115.36505, -8.15701 ], [ 115.36221, -8.15523 ], [ 115.36247, -8.1537 ], [ 115.35835, -8.14987 ], [ 115.35526, -8.14936 ], [ 115.35088, -8.15191 ], [ 115.34649, -8.15089 ], [ 115.34366, -8.1486 ], [ 115.33954, -8.1486 ], [ 115.33619, -8.15523 ], [ 115.33284, -8.15599 ], [ 115.32974, -8.1537 ], [ 115.32717, -8.15013 ], [ 115.32407, -8.14579 ], [ 115.31944, -8.1486 ], [ 115.31712, -8.15497 ], [ 115.31557, -8.16084 ], [ 115.31325, -8.16416 ], [ 115.30939, -8.16696 ], [ 115.30732, -8.16951 ], [ 115.30552, -8.17487 ], [ 115.30294, -8.1736 ], [ 115.29573, -8.17053 ], [ 115.29083, -8.17028 ], [ 115.28671, -8.16824 ], [ 115.28465, -8.16416 ], [ 115.27898, -8.16263 ], [ 115.27485, -8.16518 ], [ 115.27073, -8.16569 ], [ 115.26738, -8.16518 ], [ 115.263, -8.16849 ], [ 115.26094, -8.17079 ], [ 115.25939, -8.17513 ], [ 115.25681, -8.17768 ], [ 115.25424, -8.17742 ], [ 115.24883, -8.17768 ], [ 115.24496, -8.18074 ], [ 115.24341, -8.18686 ], [ 115.24367, -8.19324 ], [ 115.24522, -8.20063 ], [ 115.24367, -8.2065 ], [ 115.23929, -8.219 ], [ 115.23826, -8.22308 ], [ 115.23877, -8.22741 ], [ 115.23646, -8.23303 ], [ 115.23362, -8.23736 ], [ 115.23001, -8.23915 ], [ 115.22641, -8.24119 ], [ 115.22228, -8.24348 ], [ 115.21275, -8.24425 ], [ 115.20682, -8.24399 ], [ 115.19935, -8.24501 ], [ 115.19265, -8.2445 ], [ 115.1862, -8.24578 ], [ 115.18523, -8.24715 ], [ 115.18028, -8.2461 ], [ 115.17564, -8.24686 ], [ 115.17151, -8.25094 ], [ 115.16688, -8.25477 ], [ 115.15889, -8.25885 ], [ 115.15476, -8.26344 ], [ 115.14909, -8.26548 ], [ 115.14394, -8.26828 ], [ 115.13492, -8.27389 ], [ 115.13492, -8.2818 ], [ 115.13492, -8.28792 ], [ 115.13106, -8.29481 ], [ 115.12887, -8.30501 ], [ 115.12809, -8.3073 ], [ 115.12345, -8.30756 ], [ 115.1201, -8.30628 ], [ 115.11598, -8.30271 ], [ 115.11134, -8.29965 ], [ 115.10567, -8.29914 ], [ 115.10361, -8.3022 ], [ 115.10361, -8.30297 ], [ 115.10258, -8.30628 ], [ 115.10181, -8.30858 ], [ 115.10052, -8.3096 ], [ 115.09665, -8.31087 ], [ 115.09304, -8.3124 ], [ 115.08892, -8.31368 ], [ 115.08299, -8.31393 ], [ 115.07732, -8.31393 ], [ 115.07088, -8.31291 ], [ 115.0647, -8.31164 ], [ 115.05877, -8.31011 ], [ 115.05465, -8.30934 ], [ 115.04795, -8.30807 ], [ 115.04279, -8.30654 ], [ 115.0397, -8.30399 ], [ 115.03429, -8.3022 ], [ 115.0312, -8.30271 ], [ 115.02707, -8.30424 ], [ 115.02501, -8.30679 ], [ 115.02269, -8.30909 ], [ 115.01934, -8.31138 ], [ 115.01393, -8.31036 ], [ 115.00929, -8.30858 ], [ 115.00336, -8.30603 ], [ 114.99924, -8.30348 ], [ 114.99589, -8.30042 ], [ 114.99306, -8.29608 ], [ 114.98687, -8.29175 ], [ 114.98429, -8.29532 ], [ 114.98429, -8.30016 ], [ 114.9794, -8.30297 ], [ 114.97605, -8.30603 ], [ 114.97038, -8.3073 ], [ 114.96651, -8.30883 ], [ 114.96445, -8.31342 ], [ 114.96239, -8.32107 ], [ 114.96136, -8.32591 ], [ 114.96007, -8.32923 ], [ 114.95775, -8.33509 ], [ 114.95801, -8.33968 ], [ 114.95827, -8.34504 ], [ 114.95414, -8.35243 ], [ 114.95311, -8.35677 ], [ 114.95234, -8.36059 ], [ 114.94847, -8.36187 ], [ 114.94615, -8.35957 ], [ 114.94152, -8.35906 ], [ 114.93868, -8.36085 ], [ 114.93482, -8.36722 ], [ 114.93301, -8.37181 ], [ 114.93198, -8.37716 ], [ 114.93172, -8.38124 ], [ 114.9325, -8.38481 ], [ 114.93241, -8.38489 ], [ 114.92116, -8.38201 ], [ 114.91188, -8.37742 ], [ 114.90415, -8.3713 ], [ 114.90054, -8.36467 ], [ 114.89693, -8.35855 ], [ 114.8892, -8.35345 ], [ 114.87838, -8.34784 ], [ 114.87168, -8.34172 ], [ 114.86601, -8.34019 ], [ 114.86034, -8.34325 ], [ 114.849, -8.34121 ], [ 114.84282, -8.34274 ], [ 114.83405, -8.33968 ], [ 114.82787, -8.33662 ], [ 114.82581, -8.33152 ], [ 114.82426, -8.32337 ], [ 114.8222, -8.31368 ], [ 114.81911, -8.30042 ], [ 114.81808, -8.29634 ], [ 114.81705, -8.28308 ], [ 114.8155, -8.27389 ], [ 114.81498, -8.26573 ], [ 114.81189, -8.25757 ], [ 114.80519, -8.25553 ], [ 114.79025, -8.25604 ], [ 114.78509, -8.2591 ], [ 114.77684, -8.26369 ], [ 114.77169, -8.25859 ], [ 114.76448, -8.24686 ], [ 114.76035, -8.23819 ], [ 114.75365, -8.22697 ], [ 114.74386, -8.22493 ], [ 114.73252, -8.21932 ], [ 114.72067, -8.21269 ], [ 114.7119, -8.20758 ], [ 114.70005, -8.2035 ], [ 114.69799, -8.20962 ], [ 114.6949, -8.21677 ], [ 114.68974, -8.22748 ], [ 114.68562, -8.23054 ], [ 114.67943, -8.22799 ], [ 114.67067, -8.2234 ], [ 114.66449, -8.22595 ], [ 114.65366, -8.22595 ], [ 114.64748, -8.22289 ], [ 114.64078, -8.21728 ], [ 114.63305, -8.21524 ], [ 114.62892, -8.2086 ], [ 114.62583, -8.19891 ], [ 114.61965, -8.18565 ], [ 114.61346, -8.18208 ], [ 114.60058, -8.17851 ], [ 114.59078, -8.18004 ], [ 114.58254, -8.18463 ], [ 114.57429, -8.18973 ], [ 114.56914, -8.1933 ], [ 114.55883, -8.19993 ], [ 114.54852, -8.19942 ], [ 114.54234, -8.19636 ], [ 114.53461, -8.1933 ], [ 114.52894, -8.19891 ], [ 114.52327, -8.20605 ], [ 114.51708, -8.20758 ], [ 114.51141, -8.20605 ], [ 114.5042, -8.20095 ], [ 114.49543, -8.19585 ], [ 114.48616, -8.19483 ], [ 114.47224, -8.19687 ], [ 114.46193, -8.19432 ], [ 114.45781, -8.18718 ], [ 114.45987, -8.178 ], [ 114.46554, -8.1683 ], [ 114.46142, -8.16371 ], [ 114.4542, -8.16014 ], [ 114.45111, -8.15759 ], [ 114.44544, -8.15147 ], [ 114.44432, -8.15081 ], [ 114.44531, -8.14735 ], [ 114.44484, -8.14065 ], [ 114.44251, -8.13394 ], [ 114.43935, -8.12828 ], [ 114.43433, -8.12273 ], [ 114.43176, -8.11903 ], [ 114.43351, -8.11221 ], [ 114.43398, -8.1077 ], [ 114.43433, -8.10145 ], [ 114.43573, -8.09706 ], [ 114.44029, -8.09428 ], [ 114.45509, -8.09158 ], [ 114.47751, -8.09343 ], [ 114.49246, -8.09343 ], [ 114.50554, -8.10731 ], [ 114.51115, -8.12026 ], [ 114.52049, -8.12858 ], [ 114.52703, -8.1443 ], [ 114.53731, -8.13875 ], [ 114.55973, -8.13228 ], [ 114.5971, -8.13783 ], [ 114.61205, -8.12673 ], [ 114.63261, -8.12395 ], [ 114.64288, -8.1295 ], [ 114.65643, -8.14014 ], [ 114.66344, -8.14384 ], [ 114.67208, -8.14708 ], [ 114.67675, -8.145 ], [ 114.69777, -8.14777 ], [ 114.70361, -8.15078 ], [ 114.71436, -8.15517 ], [ 114.72604, -8.15771 ], [ 114.73281, -8.16003 ], [ 114.73795, -8.16326 ], [ 114.755, -8.16904 ], [ 114.76831, -8.17274 ], [ 114.78116, -8.17621 ], [ 114.79844, -8.1806 ], [ 114.80569, -8.18361 ], [ 114.81877, -8.18893 ], [ 114.83231, -8.19378 ], [ 114.84119, -8.19193 ], [ 114.85357, -8.19586 ], [ 114.86408, -8.19656 ], [ 114.89515, -8.18985 ], [ 114.90402, -8.18893 ], [ 114.91897, -8.18476 ], [ 114.92925, -8.18315 ], [ 114.93999, -8.185 ], [ 114.95261, -8.18176 ], [ 114.96312, -8.18199 ], [ 114.97877, -8.18083 ], [ 114.99115, -8.17875 ], [ 114.99862, -8.17529 ], [ 115.00423, -8.16835 ], [ 115.01567, -8.16442 ], [ 115.01964, -8.16141 ], [ 115.02431, -8.15633 ], [ 115.03202, -8.15147 ], [ 115.0402, -8.14846 ], [ 115.04767, -8.14407 ], [ 115.05024, -8.13783 ], [ 115.05631, -8.13251 ], [ 115.06192, -8.12673 ], [ 115.06426, -8.12187 ], [ 115.075, -8.11476 ], [ 115.08388, -8.10875 ], [ 115.09018, -8.10204 ], [ 115.09789, -8.09626 ], [ 115.10677, -8.09048 ], [ 115.11634, -8.08493 ], [ 115.12335, -8.08193 ], [ 115.13176, -8.0773 ], [ 115.14063, -8.07383 ], [ 115.14974, -8.06828 ], [ 115.15512, -8.06551 ], [ 115.15979, -8.06389 ], [ 115.16516, -8.06296 ], [ 115.17707, -8.06158 ], [ 115.18572, -8.06158 ], [ 115.19109, -8.06528 ], [ 115.19553, -8.06805 ], [ 115.20066, -8.07083 ], [ 115.20884, -8.07476 ], [ 115.21807, -8.07823 ], [ 115.22577, -8.08008 ], [ 115.23301, -8.08262 ], [ 115.24236, -8.08378 ], [ 115.25053, -8.0847 ], [ 115.25847, -8.08655 ], [ 115.26361, -8.08771 ], [ 115.26805, -8.08886 ], [ 115.27366, -8.09349 ], [ 115.28136, -8.09742 ], [ 115.28697, -8.10089 ], [ 115.29748, -8.10389 ], [ 115.30472, -8.10574 ], [ 115.31266, -8.1069 ], [ 115.32411, -8.11129 ], [ 115.32972, -8.11014 ], [ 115.33836, -8.11106 ], [ 115.34256, -8.11546 ], [ 115.34513, -8.11962 ], [ 115.3505, -8.12239 ], [ 115.35377, -8.12609 ], [ 115.35926, -8.12806 ], [ 115.36487, -8.12922 ], [ 115.37001, -8.1306 ], [ 115.37351, -8.1306 ], [ 115.37655, -8.13338 ], [ 115.38122, -8.13523 ], [ 115.38682, -8.13546 ], [ 115.39126, -8.13777 ], [ 115.39617, -8.13916 ], [ 115.40317, -8.14286 ], [ 115.41135, -8.1491 ], [ 115.41789, -8.15141 ], [ 115.4256, -8.15257 ], [ 115.4319, -8.15534 ], [ 115.44125, -8.15742 ], [ 115.45106, -8.16089 ], [ 115.45227, -8.16215 ], [ 115.44803, -8.16747 ], [ 115.44696, -8.1696 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 2, "kabupaten": "Klungkung" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.37148, -8.57573 ], [ 115.37116, -8.57396 ], [ 115.37374, -8.56581 ], [ 115.36807, -8.55714 ], [ 115.36755, -8.54644 ], [ 115.36601, -8.53777 ], [ 115.35673, -8.52197 ], [ 115.35312, -8.51688 ], [ 115.35312, -8.51127 ], [ 115.35415, -8.50107 ], [ 115.35621, -8.49292 ], [ 115.35828, -8.48731 ], [ 115.36343, -8.48068 ], [ 115.36549, -8.47202 ], [ 115.36807, -8.46794 ], [ 115.37219, -8.46539 ], [ 115.37632, -8.4608 ], [ 115.38456, -8.46182 ], [ 115.39075, -8.46029 ], [ 115.39281, -8.4557 ], [ 115.40157, -8.4552 ], [ 115.40415, -8.46182 ], [ 115.40415, -8.46794 ], [ 115.40621, -8.47355 ], [ 115.41085, -8.47457 ], [ 115.41342, -8.48221 ], [ 115.41188, -8.49394 ], [ 115.41136, -8.50413 ], [ 115.41033, -8.51382 ], [ 115.4093, -8.52146 ], [ 115.416, -8.52044 ], [ 115.42012, -8.51891 ], [ 115.42682, -8.51942 ], [ 115.43198, -8.51229 ], [ 115.43919, -8.50923 ], [ 115.44796, -8.50566 ], [ 115.45208, -8.50158 ], [ 115.45723, -8.50158 ], [ 115.46084, -8.50209 ], [ 115.46548, -8.50719 ], [ 115.47166, -8.51229 ], [ 115.47424, -8.51942 ], [ 115.47733, -8.52962 ], [ 115.47785, -8.53879 ], [ 115.47785, -8.54542 ], [ 115.47785, -8.55103 ], [ 115.47809, -8.55164 ], [ 115.47348, -8.5522 ], [ 115.46741, -8.55404 ], [ 115.46204, -8.55728 ], [ 115.4583, -8.55936 ], [ 115.45234, -8.56686 ], [ 115.44837, -8.57125 ], [ 115.44113, -8.57194 ], [ 115.43623, -8.5731 ], [ 115.43249, -8.57449 ], [ 115.42782, -8.57495 ], [ 115.42244, -8.57495 ], [ 115.41684, -8.57564 ], [ 115.4103, -8.5761 ], [ 115.40493, -8.57841 ], [ 115.40072, -8.57679 ], [ 115.39348, -8.57518 ], [ 115.38507, -8.57472 ], [ 115.37526, -8.57449 ], [ 115.37148, -8.57573 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 6, "kabupaten": "Badung" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.23266, -8.23784 ], [ 115.23793, -8.2428 ], [ 115.24283, -8.2474 ], [ 115.24566, -8.2525 ], [ 115.24978, -8.25734 ], [ 115.25262, -8.26155 ], [ 115.25236, -8.27022 ], [ 115.24978, -8.27736 ], [ 115.24824, -8.28399 ], [ 115.24721, -8.29419 ], [ 115.24875, -8.29929 ], [ 115.25185, -8.30541 ], [ 115.25081, -8.31306 ], [ 115.24875, -8.32224 ], [ 115.24669, -8.3355 ], [ 115.23948, -8.3508 ], [ 115.22917, -8.361 ], [ 115.22608, -8.37732 ], [ 115.22608, -8.39465 ], [ 115.22298, -8.41301 ], [ 115.23226, -8.45124 ], [ 115.23844, -8.45889 ], [ 115.24102, -8.46909 ], [ 115.24205, -8.4803 ], [ 115.24669, -8.49152 ], [ 115.24875, -8.50171 ], [ 115.24489, -8.51509 ], [ 115.2454, -8.51993 ], [ 115.2454, -8.52554 ], [ 115.24618, -8.53242 ], [ 115.24875, -8.53701 ], [ 115.25185, -8.54491 ], [ 115.25288, -8.55332 ], [ 115.25107, -8.55918 ], [ 115.25107, -8.56377 ], [ 115.25107, -8.5681 ], [ 115.25107, -8.57294 ], [ 115.25081, -8.57855 ], [ 115.24953, -8.58568 ], [ 115.24901, -8.59001 ], [ 115.24695, -8.5946 ], [ 115.2436, -8.59689 ], [ 115.24025, -8.59893 ], [ 115.23577, -8.60074 ], [ 115.23522, -8.59957 ], [ 115.23393, -8.59651 ], [ 115.2293, -8.59473 ], [ 115.22337, -8.59473 ], [ 115.21551, -8.59715 ], [ 115.20881, -8.59995 ], [ 115.20494, -8.60314 ], [ 115.19979, -8.60581 ], [ 115.19348, -8.61154 ], [ 115.18845, -8.61346 ], [ 115.18227, -8.616 ], [ 115.17969, -8.62339 ], [ 115.17917, -8.63027 ], [ 115.18033, -8.63868 ], [ 115.17917, -8.64683 ], [ 115.17853, -8.65435 ], [ 115.17595, -8.65677 ], [ 115.17234, -8.66403 ], [ 115.17453, -8.66861 ], [ 115.17621, -8.67142 ], [ 115.17518, -8.67575 ], [ 115.17234, -8.68317 ], [ 115.17557, -8.68992 ], [ 115.17582, -8.69858 ], [ 115.17544, -8.70558 ], [ 115.17776, -8.70839 ], [ 115.18033, -8.71284 ], [ 115.18227, -8.71909 ], [ 115.18239, -8.72303 ], [ 115.18291, -8.72724 ], [ 115.18381, -8.73093 ], [ 115.18433, -8.73373 ], [ 115.18716, -8.73666 ], [ 115.18909, -8.73819 ], [ 115.1896, -8.73896 ], [ 115.18926, -8.73912 ], [ 115.18785, -8.74084 ], [ 115.18591, -8.74246 ], [ 115.18582, -8.74342 ], [ 115.18591, -8.74345 ], [ 115.18591, -8.74377 ], [ 115.18566, -8.74428 ], [ 115.18585, -8.7446 ], [ 115.18585, -8.74495 ], [ 115.18582, -8.74527 ], [ 115.18309, -8.7477 ], [ 115.18192, -8.75128 ], [ 115.18052, -8.75451 ], [ 115.17993, -8.75809 ], [ 115.18087, -8.76097 ], [ 115.18122, -8.76409 ], [ 115.18227, -8.7664 ], [ 115.18355, -8.7679 ], [ 115.18017, -8.76882 ], [ 115.1797, -8.77113 ], [ 115.17666, -8.77367 ], [ 115.1748, -8.77632 ], [ 115.17246, -8.77829 ], [ 115.17246, -8.78048 ], [ 115.17503, -8.77886 ], [ 115.17748, -8.77782 ], [ 115.18052, -8.77852 ], [ 115.18262, -8.77748 ], [ 115.18507, -8.7754 ], [ 115.18881, -8.77575 ], [ 115.19161, -8.77725 ], [ 115.1929, -8.78048 ], [ 115.19477, -8.78233 ], [ 115.19885, -8.78186 ], [ 115.20247, -8.78233 ], [ 115.20528, -8.78325 ], [ 115.20773, -8.78556 ], [ 115.21088, -8.7874 ], [ 115.21485, -8.78994 ], [ 115.21731, -8.79318 ], [ 115.21941, -8.7956 ], [ 115.22163, -8.79733 ], [ 115.22186, -8.79641 ], [ 115.22139, -8.79375 ], [ 115.22186, -8.79075 ], [ 115.22315, -8.78983 ], [ 115.22385, -8.78787 ], [ 115.22303, -8.78533 ], [ 115.22244, -8.78325 ], [ 115.22116, -8.78048 ], [ 115.22011, -8.77817 ], [ 115.21882, -8.77563 ], [ 115.21812, -8.77344 ], [ 115.21719, -8.77009 ], [ 115.21567, -8.76674 ], [ 115.21579, -8.76328 ], [ 115.21579, -8.75809 ], [ 115.21661, -8.75462 ], [ 115.21731, -8.75209 ], [ 115.21988, -8.75232 ], [ 115.22221, -8.75462 ], [ 115.22303, -8.75716 ], [ 115.22326, -8.76051 ], [ 115.22373, -8.76317 ], [ 115.22385, -8.76651 ], [ 115.22443, -8.77136 ], [ 115.22525, -8.77459 ], [ 115.22665, -8.7784 ], [ 115.22665, -8.78256 ], [ 115.2284, -8.7859 ], [ 115.2305, -8.78879 ], [ 115.23226, -8.79202 ], [ 115.23471, -8.79733 ], [ 115.23996, -8.80224 ], [ 115.23529, -8.80524 ], [ 115.23062, -8.81078 ], [ 115.22688, -8.81516 ], [ 115.22501, -8.81932 ], [ 115.22221, -8.82509 ], [ 115.22058, -8.83016 ], [ 115.21731, -8.8334 ], [ 115.21077, -8.83547 ], [ 115.20376, -8.84055 ], [ 115.19161, -8.84263 ], [ 115.18063, -8.84863 ], [ 115.16966, -8.84909 ], [ 115.15985, -8.84863 ], [ 115.15214, -8.84909 ], [ 115.13929, -8.84886 ], [ 115.13018, -8.84794 ], [ 115.12014, -8.84701 ], [ 115.10846, -8.8447 ], [ 115.10005, -8.84355 ], [ 115.09141, -8.84124 ], [ 115.0872, -8.83686 ], [ 115.08534, -8.83201 ], [ 115.0844, -8.82716 ], [ 115.0837, -8.82324 ], [ 115.08463, -8.81932 ], [ 115.08674, -8.81562 ], [ 115.09094, -8.81355 ], [ 115.09608, -8.81331 ], [ 115.09818, -8.81031 ], [ 115.10379, -8.80985 ], [ 115.10986, -8.80708 ], [ 115.1143, -8.80477 ], [ 115.11593, -8.80085 ], [ 115.1178, -8.79693 ], [ 115.12154, -8.79208 ], [ 115.12644, -8.79046 ], [ 115.13112, -8.78954 ], [ 115.13649, -8.78631 ], [ 115.13859, -8.78285 ], [ 115.14466, -8.78077 ], [ 115.15004, -8.78008 ], [ 115.15099, -8.77964 ], [ 115.1524, -8.77897 ], [ 115.15418, -8.77849 ], [ 115.15843, -8.77799 ], [ 115.16184, -8.77359 ], [ 115.16448, -8.76882 ], [ 115.16494, -8.76188 ], [ 115.15231, -8.75404 ], [ 115.14954, -8.74755 ], [ 115.15553, -8.74105 ], [ 115.16423, -8.73442 ], [ 115.16726, -8.72611 ], [ 115.16773, -8.71365 ], [ 115.16493, -8.70464 ], [ 115.15442, -8.68894 ], [ 115.14671, -8.67578 ], [ 115.13363, -8.66169 ], [ 115.11109, -8.64634 ], [ 115.09796, -8.63525 ], [ 115.09936, -8.63401 ], [ 115.10297, -8.63273 ], [ 115.10812, -8.62585 ], [ 115.11173, -8.61974 ], [ 115.11714, -8.61439 ], [ 115.1259, -8.61209 ], [ 115.13209, -8.61286 ], [ 115.13724, -8.61464 ], [ 115.14059, -8.61337 ], [ 115.14471, -8.61006 ], [ 115.14987, -8.60572 ], [ 115.15219, -8.60063 ], [ 115.15064, -8.5963 ], [ 115.14858, -8.58993 ], [ 115.14626, -8.58483 ], [ 115.14832, -8.57795 ], [ 115.15296, -8.57107 ], [ 115.15992, -8.5582 ], [ 115.16018, -8.54979 ], [ 115.15966, -8.5424 ], [ 115.16353, -8.53425 ], [ 115.16945, -8.53119 ], [ 115.17358, -8.52507 ], [ 115.17564, -8.51692 ], [ 115.18414, -8.49251 ], [ 115.1826, -8.48767 ], [ 115.18182, -8.47926 ], [ 115.18234, -8.47263 ], [ 115.1844, -8.46295 ], [ 115.18852, -8.45683 ], [ 115.19419, -8.45097 ], [ 115.20115, -8.44995 ], [ 115.20424, -8.45148 ], [ 115.21223, -8.44842 ], [ 115.21455, -8.43949 ], [ 115.213, -8.42904 ], [ 115.21172, -8.42089 ], [ 115.21043, -8.41069 ], [ 115.2094, -8.40049 ], [ 115.20656, -8.38507 ], [ 115.20476, -8.37869 ], [ 115.20141, -8.37104 ], [ 115.20295, -8.36008 ], [ 115.20527, -8.35192 ], [ 115.20734, -8.3458 ], [ 115.20837, -8.33815 ], [ 115.20888, -8.33127 ], [ 115.20811, -8.32209 ], [ 115.20811, -8.31342 ], [ 115.20605, -8.30603 ], [ 115.20295, -8.29914 ], [ 115.19909, -8.29098 ], [ 115.19574, -8.28512 ], [ 115.19213, -8.2795 ], [ 115.18852, -8.27338 ], [ 115.18801, -8.26701 ], [ 115.18852, -8.26038 ], [ 115.19007, -8.25324 ], [ 115.18749, -8.24763 ], [ 115.18523, -8.24715 ], [ 115.1862, -8.24578 ], [ 115.19265, -8.2445 ], [ 115.19935, -8.24501 ], [ 115.20682, -8.24399 ], [ 115.21275, -8.24425 ], [ 115.22228, -8.24348 ], [ 115.22641, -8.24119 ], [ 115.23001, -8.23915 ], [ 115.23266, -8.23784 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 7, "kabupaten": "Gianyar" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.25094, -8.31217 ], [ 115.25288, -8.31293 ], [ 115.25906, -8.31599 ], [ 115.26267, -8.31956 ], [ 115.26731, -8.32262 ], [ 115.26937, -8.3216 ], [ 115.27504, -8.31854 ], [ 115.28122, -8.31395 ], [ 115.2905, -8.31905 ], [ 115.29153, -8.32262 ], [ 115.29514, -8.3267 ], [ 115.29875, -8.33231 ], [ 115.30081, -8.33129 ], [ 115.30854, -8.32823 ], [ 115.31627, -8.3318 ], [ 115.32194, -8.33078 ], [ 115.32864, -8.3318 ], [ 115.32864, -8.3369 ], [ 115.33225, -8.34047 ], [ 115.33173, -8.3471 ], [ 115.33173, -8.35322 ], [ 115.33122, -8.35985 ], [ 115.33225, -8.36342 ], [ 115.33689, -8.3675 ], [ 115.3374, -8.37668 ], [ 115.3374, -8.38535 ], [ 115.33483, -8.38993 ], [ 115.3307, -8.39707 ], [ 115.32967, -8.40472 ], [ 115.3307, -8.41441 ], [ 115.32967, -8.42206 ], [ 115.32297, -8.4297 ], [ 115.31833, -8.43684 ], [ 115.32246, -8.445 ], [ 115.324, -8.45367 ], [ 115.324, -8.46233 ], [ 115.32658, -8.47304 ], [ 115.32632, -8.48196 ], [ 115.32529, -8.48986 ], [ 115.32658, -8.49521 ], [ 115.32838, -8.50184 ], [ 115.3307, -8.50949 ], [ 115.33354, -8.5128 ], [ 115.33611, -8.51713 ], [ 115.33921, -8.51942 ], [ 115.34436, -8.52121 ], [ 115.349, -8.52172 ], [ 115.35132, -8.51917 ], [ 115.35404, -8.51818 ], [ 115.35673, -8.52197 ], [ 115.36601, -8.53777 ], [ 115.36755, -8.54644 ], [ 115.36807, -8.55714 ], [ 115.37374, -8.56581 ], [ 115.37116, -8.57396 ], [ 115.37148, -8.57573 ], [ 115.37036, -8.5761 ], [ 115.36312, -8.57726 ], [ 115.35891, -8.57957 ], [ 115.35261, -8.58488 ], [ 115.3519, -8.58927 ], [ 115.34887, -8.59273 ], [ 115.34653, -8.59527 ], [ 115.34233, -8.59735 ], [ 115.33719, -8.60058 ], [ 115.33182, -8.60359 ], [ 115.32668, -8.60659 ], [ 115.32247, -8.61144 ], [ 115.31663, -8.61675 ], [ 115.31009, -8.61952 ], [ 115.30379, -8.62483 ], [ 115.30145, -8.62899 ], [ 115.29561, -8.63315 ], [ 115.28218, -8.64458 ], [ 115.27774, -8.64873 ], [ 115.27332, -8.65228 ], [ 115.27311, -8.65142 ], [ 115.26988, -8.64594 ], [ 115.26421, -8.64072 ], [ 115.26048, -8.63626 ], [ 115.25803, -8.62938 ], [ 115.25339, -8.62021 ], [ 115.24708, -8.61549 ], [ 115.24231, -8.61002 ], [ 115.23741, -8.60428 ], [ 115.23577, -8.60074 ], [ 115.24025, -8.59893 ], [ 115.2436, -8.59689 ], [ 115.24695, -8.5946 ], [ 115.24901, -8.59001 ], [ 115.24953, -8.58568 ], [ 115.25081, -8.57855 ], [ 115.25107, -8.57294 ], [ 115.25107, -8.5681 ], [ 115.25107, -8.56377 ], [ 115.25107, -8.55918 ], [ 115.25288, -8.55332 ], [ 115.25185, -8.54491 ], [ 115.24875, -8.53701 ], [ 115.24618, -8.53242 ], [ 115.2454, -8.52554 ], [ 115.2454, -8.51993 ], [ 115.24489, -8.51509 ], [ 115.24875, -8.50171 ], [ 115.24669, -8.49152 ], [ 115.24205, -8.4803 ], [ 115.24102, -8.46909 ], [ 115.23844, -8.45889 ], [ 115.23226, -8.45124 ], [ 115.22298, -8.41301 ], [ 115.22608, -8.39465 ], [ 115.22608, -8.37732 ], [ 115.22917, -8.361 ], [ 115.23948, -8.3508 ], [ 115.24669, -8.3355 ], [ 115.24875, -8.32224 ], [ 115.25081, -8.31306 ], [ 115.25094, -8.31217 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 8, "kabupaten": "Karangasem" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.44696, -8.1696 ], [ 115.44924, -8.16629 ], [ 115.45354, -8.16345 ], [ 115.45643, -8.16644 ], [ 115.45993, -8.17037 ], [ 115.47056, -8.17794 ], [ 115.47383, -8.17979 ], [ 115.47967, -8.18026 ], [ 115.48364, -8.18141 ], [ 115.48925, -8.18673 ], [ 115.49392, -8.19089 ], [ 115.49766, -8.19205 ], [ 115.50209, -8.19505 ], [ 115.507, -8.20245 ], [ 115.51214, -8.20638 ], [ 115.51774, -8.21031 ], [ 115.52358, -8.21424 ], [ 115.53246, -8.21817 ], [ 115.54134, -8.22187 ], [ 115.55021, -8.22788 ], [ 115.55885, -8.23227 ], [ 115.56761, -8.24285 ], [ 115.57789, -8.25279 ], [ 115.58116, -8.25672 ], [ 115.58653, -8.26157 ], [ 115.59004, -8.26596 ], [ 115.59261, -8.27197 ], [ 115.59588, -8.27821 ], [ 115.60148, -8.28099 ], [ 115.60545, -8.28723 ], [ 115.60966, -8.29231 ], [ 115.6148, -8.29786 ], [ 115.6176, -8.3011 ], [ 115.6204, -8.30734 ], [ 115.62612, -8.31554 ], [ 115.62869, -8.32201 ], [ 115.63383, -8.32571 ], [ 115.63944, -8.3308 ], [ 115.64598, -8.33449 ], [ 115.65345, -8.33519 ], [ 115.65882, -8.33889 ], [ 115.66466, -8.34166 ], [ 115.67307, -8.3442 ], [ 115.67704, -8.34836 ], [ 115.68826, -8.35344 ], [ 115.69246, -8.35576 ], [ 115.6962, -8.35691 ], [ 115.69993, -8.35853 ], [ 115.70087, -8.36315 ], [ 115.70274, -8.36893 ], [ 115.70694, -8.37263 ], [ 115.70928, -8.37609 ], [ 115.71138, -8.38164 ], [ 115.71138, -8.38996 ], [ 115.71068, -8.39643 ], [ 115.70998, -8.40059 ], [ 115.70788, -8.40544 ], [ 115.70461, -8.40798 ], [ 115.70063, -8.41329 ], [ 115.69725, -8.41901 ], [ 115.69258, -8.42664 ], [ 115.6879, -8.43218 ], [ 115.68066, -8.43796 ], [ 115.67506, -8.44304 ], [ 115.66922, -8.44558 ], [ 115.66338, -8.44859 ], [ 115.65707, -8.45413 ], [ 115.6489, -8.45598 ], [ 115.64002, -8.45852 ], [ 115.63465, -8.46153 ], [ 115.63301, -8.46753 ], [ 115.63161, -8.47192 ], [ 115.62881, -8.47423 ], [ 115.62414, -8.47793 ], [ 115.6204, -8.48116 ], [ 115.61713, -8.48833 ], [ 115.6148, -8.49248 ], [ 115.61211, -8.50299 ], [ 115.60557, -8.50461 ], [ 115.59646, -8.50877 ], [ 115.58875, -8.51177 ], [ 115.58338, -8.51454 ], [ 115.57871, -8.51501 ], [ 115.57427, -8.51062 ], [ 115.56259, -8.50692 ], [ 115.55535, -8.50577 ], [ 115.54531, -8.50299 ], [ 115.5369, -8.50092 ], [ 115.52709, -8.50346 ], [ 115.51658, -8.50692 ], [ 115.50957, -8.51177 ], [ 115.5084, -8.51824 ], [ 115.5112, -8.52147 ], [ 115.51237, -8.53002 ], [ 115.51004, -8.53811 ], [ 115.50431, -8.54273 ], [ 115.49684, -8.54434 ], [ 115.4875, -8.54896 ], [ 115.48119, -8.55127 ], [ 115.47809, -8.55164 ], [ 115.47785, -8.55103 ], [ 115.47785, -8.54542 ], [ 115.47785, -8.53879 ], [ 115.47733, -8.52962 ], [ 115.47424, -8.51942 ], [ 115.47166, -8.51229 ], [ 115.46548, -8.50719 ], [ 115.46084, -8.50209 ], [ 115.45723, -8.50158 ], [ 115.45208, -8.50158 ], [ 115.44796, -8.50566 ], [ 115.43919, -8.50923 ], [ 115.43198, -8.51229 ], [ 115.42682, -8.51942 ], [ 115.42012, -8.51891 ], [ 115.416, -8.52044 ], [ 115.4093, -8.52146 ], [ 115.41033, -8.51382 ], [ 115.41136, -8.50413 ], [ 115.41188, -8.49394 ], [ 115.41342, -8.48221 ], [ 115.41085, -8.47457 ], [ 115.40621, -8.47355 ], [ 115.40415, -8.46794 ], [ 115.40415, -8.46235 ], [ 115.40473, -8.46173 ], [ 115.40756, -8.45637 ], [ 115.41246, -8.44669 ], [ 115.41503, -8.43777 ], [ 115.41658, -8.43012 ], [ 115.41864, -8.42018 ], [ 115.41864, -8.41431 ], [ 115.41426, -8.40322 ], [ 115.41194, -8.39558 ], [ 115.40756, -8.38614 ], [ 115.40112, -8.37543 ], [ 115.39519, -8.36906 ], [ 115.39545, -8.36192 ], [ 115.39751, -8.35325 ], [ 115.40138, -8.34484 ], [ 115.40653, -8.34025 ], [ 115.41188, -8.3282 ], [ 115.4133, -8.32285 ], [ 115.41677, -8.3166 ], [ 115.41845, -8.30959 ], [ 115.41909, -8.305 ], [ 115.4209, -8.29926 ], [ 115.42322, -8.29391 ], [ 115.42734, -8.28335 ], [ 115.42889, -8.27596 ], [ 115.43069, -8.27086 ], [ 115.43352, -8.26678 ], [ 115.43791, -8.26295 ], [ 115.43997, -8.26193 ], [ 115.45002, -8.25505 ], [ 115.45259, -8.24995 ], [ 115.45208, -8.24816 ], [ 115.45002, -8.24587 ], [ 115.44718, -8.2428 ], [ 115.44667, -8.23898 ], [ 115.44512, -8.23337 ], [ 115.44306, -8.22903 ], [ 115.43971, -8.22215 ], [ 115.43997, -8.21781 ], [ 115.44151, -8.21347 ], [ 115.44409, -8.20735 ], [ 115.44924, -8.20404 ], [ 115.45182, -8.19894 ], [ 115.45234, -8.19409 ], [ 115.44924, -8.19128 ], [ 115.4428, -8.18848 ], [ 115.43945, -8.18593 ], [ 115.4361, -8.18287 ], [ 115.43687, -8.18006 ], [ 115.43945, -8.17776 ], [ 115.44109, -8.17577 ], [ 115.44494, -8.1736 ], [ 115.44696, -8.1696 ] ] ] ] } },
{ "type": "Feature", "properties": { "id": 9, "kabupaten": "Bangli" }, "geometry": { "type": "MultiPolygon", "coordinates": [ [ [ [ 115.44109, -8.17577 ], [ 115.43945, -8.17776 ], [ 115.43687, -8.18006 ], [ 115.4361, -8.18287 ], [ 115.43945, -8.18593 ], [ 115.4428, -8.18848 ], [ 115.44924, -8.19128 ], [ 115.45234, -8.19409 ], [ 115.45182, -8.19894 ], [ 115.44924, -8.20404 ], [ 115.44409, -8.20735 ], [ 115.44151, -8.21347 ], [ 115.43997, -8.21781 ], [ 115.43971, -8.22215 ], [ 115.44306, -8.22903 ], [ 115.44512, -8.23337 ], [ 115.44667, -8.23898 ], [ 115.44718, -8.2428 ], [ 115.45002, -8.24587 ], [ 115.45208, -8.24816 ], [ 115.45259, -8.24995 ], [ 115.45002, -8.25505 ], [ 115.43997, -8.26193 ], [ 115.43791, -8.26295 ], [ 115.43352, -8.26678 ], [ 115.43069, -8.27086 ], [ 115.42889, -8.27596 ], [ 115.42734, -8.28335 ], [ 115.42322, -8.29391 ], [ 115.4209, -8.29926 ], [ 115.41909, -8.305 ], [ 115.41845, -8.30959 ], [ 115.41677, -8.3166 ], [ 115.4133, -8.32285 ], [ 115.41188, -8.3282 ], [ 115.40653, -8.34025 ], [ 115.40138, -8.34484 ], [ 115.39751, -8.35325 ], [ 115.39545, -8.36192 ], [ 115.39519, -8.36906 ], [ 115.40112, -8.37543 ], [ 115.40756, -8.38614 ], [ 115.41194, -8.39558 ], [ 115.41426, -8.40322 ], [ 115.41864, -8.41431 ], [ 115.41864, -8.42018 ], [ 115.41658, -8.43012 ], [ 115.41503, -8.43777 ], [ 115.41246, -8.44669 ], [ 115.40756, -8.45637 ], [ 115.40473, -8.46173 ], [ 115.40415, -8.46235 ], [ 115.40415, -8.46182 ], [ 115.40157, -8.4552 ], [ 115.39281, -8.4557 ], [ 115.39075, -8.46029 ], [ 115.38456, -8.46182 ], [ 115.37632, -8.4608 ], [ 115.37219, -8.46539 ], [ 115.36807, -8.46794 ], [ 115.36549, -8.47202 ], [ 115.36343, -8.48068 ], [ 115.35828, -8.48731 ], [ 115.35621, -8.49292 ], [ 115.35415, -8.50107 ], [ 115.35312, -8.51127 ], [ 115.35312, -8.51688 ], [ 115.35404, -8.51818 ], [ 115.35132, -8.51917 ], [ 115.349, -8.52172 ], [ 115.34436, -8.52121 ], [ 115.33921, -8.51942 ], [ 115.33611, -8.51713 ], [ 115.33354, -8.5128 ], [ 115.3307, -8.50949 ], [ 115.32838, -8.50184 ], [ 115.32658, -8.49521 ], [ 115.32529, -8.48986 ], [ 115.32632, -8.48196 ], [ 115.32658, -8.47304 ], [ 115.324, -8.46233 ], [ 115.324, -8.45367 ], [ 115.32246, -8.445 ], [ 115.31833, -8.43684 ], [ 115.32297, -8.4297 ], [ 115.32967, -8.42206 ], [ 115.3307, -8.41441 ], [ 115.32967, -8.40472 ], [ 115.3307, -8.39707 ], [ 115.33483, -8.38993 ], [ 115.3374, -8.38535 ], [ 115.3374, -8.37668 ], [ 115.33689, -8.3675 ], [ 115.33225, -8.36342 ], [ 115.33122, -8.35985 ], [ 115.33173, -8.35322 ], [ 115.33173, -8.3471 ], [ 115.33225, -8.34047 ], [ 115.32864, -8.3369 ], [ 115.32864, -8.3318 ], [ 115.32194, -8.33078 ], [ 115.31627, -8.3318 ], [ 115.30854, -8.32823 ], [ 115.30081, -8.33129 ], [ 115.29875, -8.33231 ], [ 115.29514, -8.3267 ], [ 115.29153, -8.32262 ], [ 115.2905, -8.31905 ], [ 115.28122, -8.31395 ], [ 115.27504, -8.31854 ], [ 115.26937, -8.3216 ], [ 115.26731, -8.32262 ], [ 115.26267, -8.31956 ], [ 115.25906, -8.31599 ], [ 115.25288, -8.31293 ], [ 115.25094, -8.31217 ], [ 115.25185, -8.30541 ], [ 115.24875, -8.29929 ], [ 115.24721, -8.29419 ], [ 115.24824, -8.28399 ], [ 115.24978, -8.27736 ], [ 115.25236, -8.27022 ], [ 115.25262, -8.26155 ], [ 115.24978, -8.25734 ], [ 115.24566, -8.2525 ], [ 115.24283, -8.2474 ], [ 115.23793, -8.2428 ], [ 115.23266, -8.23784 ], [ 115.23362, -8.23736 ], [ 115.23646, -8.23303 ], [ 115.23877, -8.22741 ], [ 115.23826, -8.22308 ], [ 115.23929, -8.219 ], [ 115.24367, -8.2065 ], [ 115.24522, -8.20063 ], [ 115.24367, -8.19324 ], [ 115.24341, -8.18686 ], [ 115.24496, -8.18074 ], [ 115.24883, -8.17768 ], [ 115.25424, -8.17742 ], [ 115.25681, -8.17768 ], [ 115.25939, -8.17513 ], [ 115.26094, -8.17079 ], [ 115.263, -8.16849 ], [ 115.26738, -8.16518 ], [ 115.27073, -8.16569 ], [ 115.27485, -8.16518 ], [ 115.27898, -8.16263 ], [ 115.28465, -8.16416 ], [ 115.28671, -8.16824 ], [ 115.29083, -8.17028 ], [ 115.29573, -8.17053 ], [ 115.30294, -8.1736 ], [ 115.30552, -8.17487 ], [ 115.30732, -8.16951 ], [ 115.30939, -8.16696 ], [ 115.31325, -8.16416 ], [ 115.31557, -8.16084 ], [ 115.31712, -8.15497 ], [ 115.31944, -8.1486 ], [ 115.32407, -8.14579 ], [ 115.32717, -8.15013 ], [ 115.32974, -8.1537 ], [ 115.33284, -8.15599 ], [ 115.33619, -8.15523 ], [ 115.33954, -8.1486 ], [ 115.34366, -8.1486 ], [ 115.34649, -8.15089 ], [ 115.35088, -8.15191 ], [ 115.35526, -8.14936 ], [ 115.35835, -8.14987 ], [ 115.36247, -8.1537 ], [ 115.36221, -8.15523 ], [ 115.36505, -8.15701 ], [ 115.36479, -8.16135 ], [ 115.36737, -8.16441 ], [ 115.37046, -8.16696 ], [ 115.37613, -8.1662 ], [ 115.37896, -8.16824 ], [ 115.38154, -8.17411 ], [ 115.38438, -8.17615 ], [ 115.38876, -8.17768 ], [ 115.39623, -8.17411 ], [ 115.40138, -8.17206 ], [ 115.4104, -8.17436 ], [ 115.41272, -8.17666 ], [ 115.41479, -8.18201 ], [ 115.4171, -8.18431 ], [ 115.41942, -8.18737 ], [ 115.42844, -8.18354 ], [ 115.43282, -8.18252 ], [ 115.43952, -8.17666 ], [ 115.44109, -8.17577 ] ] ] ] } }
];

L.geoJSON(province, {
    style: function(feature) {
        switch (feature.properties.kabupaten) {
            case 'Negara': return {fillColor: "#0000ff", fillOpacity:0.3};
            case 'Klungkung': return {fillColor: "#0000ff", fillOpacity:0.2};
			case 'Denpasar': return {fillColor: "#0000ff", fillOpacity:0.6};
			case 'Badung': return {fillColor: "#0000ff", fillOpacity:0.4};
        }
    },
   onEachFeature: function (feature, layer) {
       layer.bindPopup(feature.properties.kabupaten+" </br>  "+feature.properties.sampah);
   }
	}).addTo(mymap);
</script>
@endpush 