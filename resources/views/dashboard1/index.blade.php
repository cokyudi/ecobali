@extends('template', ['user'=>$user])
@section('dashboard-collection','active')

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
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush

@section('dashboard1','active')
@section('content')
          <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->

            <div class="row">

                <div class="col-lg-3 col-12 pb-1">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-custom">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="font-weight-bold font-medium-2 " >

                                            District Coverage
                                            <i class="la la-info-circle " data-toggle="popover"
                                               data-content="Jumlah kecamatan yang menjadi lokasi pengumpulan Kemasan Bekas Minuman (KBM) " data-trigger="hover"
                                               data-original-title="Number of District where Used Beverage Cartons (UBC) are collected">
                                            </i>
                                        </h6>

                                        <h3 class="font-large-4" id="district_coverage"></h3>
                                    </div>
                                    <div class="align-self-center">
                                        <img src="{{asset('images/icons/district.png')}}" alt="" height="70px">
{{--                                        <i class="la la-map-marker success font-large-5 float-right"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 pb-1">
                    <div class="card" >
                        <div class="card-content" >
                            <div class="card-body card-custom">
{{--                                <div class="media d-flex test-deva" style="padding-top: 1.5rem;">--}}
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="font-weight-bold font-medium-2" >Regency Coverage
                                            <i class="la la-info-circle" data-toggle="popover"
                                               data-content="Jumlah Kabupaten yang menjadi lokasi pengumpulan Kemasan Bekas Minuman (KBM)" data-trigger="hover"
                                               data-original-title="Number of Regency where Used Beverage Cartons (UBC) are collected">
                                            </i>
                                        </h6>
                                        <h3 class="font-large-4" id="regency_coverage"></h3>
                                    </div>
                                    <div class="align-self-center">
                                        <img src="{{asset('images/icons/regency.png')}}" alt="" height="70px">
{{--                                        <i class="la la-map success font-large-5 float-right"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 pb-1">
                    <div class="card ">
                        <div class="card-content">
                            <div class="card-body card-custom">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="font-weight-bold font-medium-2">Total <br>Collection
                                            <i class="la la-info-circle" data-toggle="popover"
                                               data-content="Jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan di ecoBali" data-trigger="hover"
                                               data-original-title="Total number of Used Beverage Cartons (UBC) collected at ecoBali">
                                            </i>
                                        </h6>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="font-large-3 collectionTon mb-0 mt-1" id="total_collection_ton"></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="font-medium-5 collectionKg" id="total_collection_kg"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <img src="{{asset('images/icons/jumlah-kotak-susu.png')}}" alt="" height="75px">
{{--                                        <i class="la la-box success font-large-5 float-right"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 pb-1">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-custom">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="font-weight-bold font-medium-2">Total Participant
                                            <i class="la la-info-circle" data-toggle="popover"
                                               data-content="Jumlah Partisipan yang mengumpulkan Kemasan Bekas Minuman (KBM) di ecoBali" data-trigger="hover"
                                               data-original-title="Total of Participants who collect Used Beverage Cartons (UBC)">
                                            </i>
                                        </h6>
                                        <h3 class="font-large-4" id="total_participant"></h3>
                                    </div>
                                    <div class="align-self-center">
                                        <img src="{{asset('images/icons/participant.png')}}" alt="" height="60px">
{{--                                        <i class="la la-users success font-large-5 float-right"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

          </div>

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold font-medium-3">Composition of Participants
                                <i class="la la-info-circle" data-toggle="popover"
                                   data-content="Jumlah dan persentase Partisipan yang mengumpulkan Kemasan Bekas Minuman (KBM) berdasarkan kategori. <br>
(Rumus: jumlah partisipan setiap kategori / total partisipan seluruh kategori)" data-trigger="hover" data-html="true"
                                   data-original-title="Total number and percentage of participants who collect Used Beverage Cartons (UBC) based on category <br>
(Formula: total participants per category / total participants all categories)">
                                </i>
                            </h4>
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
                                <div id="pie-3d"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold font-medium-3">Contribution of Participants
                                <i class="la la-info-circle" data-toggle="popover"
                                   data-content="Jumlah dan persentase Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan kategori<br>
(Rumus: jumlah KBM setiap kategori / total KBM seluruh kategori)" data-trigger="hover" data-html="true"
                                   data-original-title="Total number and percentage of Used Beverage Cartons (UBC) collected based on category <br>
                                (Formula: total UBC per category / total UBC all categories)">
                                </i>
                            </h4>
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
                                <div id="pie-3d-exploded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-12 pb-1">
                    <div class="card h-100">
                        <div class="card-header mb-0">
                            <h4 class="font-weight-bold font-medium-3">Map
                                <i class="la la-info-circle" data-toggle="popover"
                                   data-content="Jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan wilayah Kabupaten" data-trigger="hover"
                                   data-original-title="Total number of Used Beverage Cartons (UBC) collected based on Region (Regency)">
                                </i>
                            </h4>
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
                <div class="col-lg-6 col-12 pb-1">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="font-weight-bold font-medium-3">Total Collection by Categories
                                <i class="la la-info-circle" data-toggle="popover"
                                   data-content="Jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan kategori" data-trigger="hover"
                                   data-original-title="Total number of Used Beverage Cartons (UBC) collected based on category of participant">
                                </i>
                            </h4>
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
                                {{--								<p class="card-text">A bar chart is a horizontal bar chart rendered in the browser using SVG or VML, whichever is appropriate for the user's browser. Like all google charts, bar charts display tooltips when the user hovers over the data.</p>--}}
                                <div class="chart-container">
                                    <div id="bar-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bold font-medium-3">Collection Trend
                                <i class="la la-info-circle" data-toggle="popover"
                                   data-content="Dinamika jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan interval waktu" data-trigger="hover"
                                   data-original-title="The trend of the number of Used Beverage Cartons (UBC) collected based on time interval">
                                </i>
                            </h4>
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
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                <button onclick="getLineChartData('week');" type="button" class="btn btn-sm btn-secondary">Week</button>
                                <button onclick="getLineChartData('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                <button onclick="getLineChartData('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                <button onclick="getLineChartData('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                            </div>
                            <div class="card-body chartjs">
                                <canvas id="line-chart" height="500"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    <div id="customizer-filter" class="customizer border-left-blue-grey border-left-lighten-4 "><a class="customizer-close" href="#"><i class="ft-x font-medium-2"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
	<h5 class="text-uppercase mb-0">Data Filter Customizer</h5>
	<hr>

        <form id="filterForm" name="filterForm">
            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Participant</h6>
            <div class="form-group ">
                <select id="id_participant" name="id_participant[]" multiple="multiple" class="select2 form-control " data-placeholder="Select Participant">
                    @foreach($participants as $participant)
                        <option value="{{$participant->id}}">{{$participant->participant_name}}</option>
                    @endforeach
                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Category</h6>
            <div class="form-group ">
                <select id="id_category" name="id_category[]" multiple="multiple" class="select2 form-control" data-placeholder="Select Category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">District</h6>
            <div class="form-group ">
                <select id="id_district" name="id_district[]" multiple="multiple" class="select2 form-control" data-placeholder="Select District">
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->district_name}}</option>
                    @endforeach

                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Regency</h6>
            <div class="form-group ">
                <div class="input-group">
                    <select class="select2 form-control" id="id_regency" name="id_regency[]" multiple="multiple" data-placeholder="Select Regency">
                        @foreach($regencies as $regency)
                            <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Date Range Options</h6>
            <div class="form-group">
                <div class="form-group " >
                    <div class="input-group">
                        <input type="text" id="daterange" name="daterange" class = "form-control" value="" />
                        <div class="input-group-append" id="icon-calendar">
                            <span class="input-group-text">
                                <span class="la la-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <button id='backBtn' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="filterBtn" value="create" type="button" class="btn btn-success">
                    <i class="la la-check-square-o"></i> Filter
                </button>
            </div>

        </form>

</div>
    </div>
    <!-- End: Customizer-->
        <!-- END: Content -->
        @endsection

@push('ajax_crud')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://www.google.com/jsapi"></script>
{{--<script src="{{asset('js/scripts/charts/google/pie/pie.min.js')}}"></script>--}}
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {


        $('#daterange').daterangepicker(
            {
                startDate: moment("01/01/2021","DD/MM/YYYY"),
                endDate: moment(),
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                separator: ' to ',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Submit',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                },
                drops: 'up',
            },
            function(start, end) {

            }
        );
        drawMap();
		getDefaultCollection();

        $('#icon-calendar').click(function() {
            $("#daterange").focus();
        });

      $('#backBtn').click(function() {

          $('#daterange').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
          $('#daterange').data('daterangepicker').setEndDate(moment());

            $('#id_category').val(null).trigger('change');
            $('#id_district').val(null).trigger('change');
            $('#id_participant').val(null).trigger('change');
            $('#id_regency').val(null).trigger('change');

            getDefaultCollection();
      });

		$('#filterBtn').click(function() {

			var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
			var idCategory = $('#id_category').val();
			var idDistrict = $('#id_district').val();
			var idParticipant = $('#id_participant').val();
            var idRegency = $('#id_regency').val();

			var params = {
				startDates: startDates,
				endDates: endDates,
				idCategory: idCategory,
				idDistrict: idDistrict,
				idParticipant: idParticipant,
                idRegency: idRegency,
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "GET",
				url: "getCollectionByFilters",
				data: params,
				success: function (data) {
					$('#district_coverage').html(data.data.districtsCoverage);
                    $('#regency_coverage').html(data.data.regenciesCoverage);
					$('#total_collection_ton').html((data.data.totalCollection/1000).toFixed(1) + ' T');
					$('#total_collection_kg').html('' + data.data.totalCollection.toFixed(1) + ' Kg');
					$('#total_participant').html(data.data.totalParticipants);

					getLineChartData('week');

					google.load("visualization", "1.0", { packages: ["corechart"] }),
					google.setOnLoadCallback(drawPie3dExploded),
					$(function () {
						function e() {
							drawPie3dExploded();
						}
						$(window).on("resize", e), $(".menu-toggle").on("click", e);
					});

					google.load("visualization", "1.0", { packages: ["corechart"] }),
					google.setOnLoadCallback(drawPie3d),
					$(function () {
						function e() {
							drawPie3d();
						}
						$(window).on("resize", e), $(".menu-toggle").on("click", e);
					});
                    drawMap();
                    drawBar();

				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
        });

    });

	function getDefaultCollection () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
		var data = {
				startDates: startDates,
				endDates: endDates
			}

		$.ajax({
			type: "GET",
			url: "getCollection",
			data:data,
			success: function (data) {
				$('#district_coverage').html(data.data.districtsCoverage);
                $('#regency_coverage').html(data.data.regenciesCoverage);
				$('#total_collection_ton').html((data.data.totalCollection/1000).toFixed(1) + ' T');
				$('#total_collection_kg').html('' +data.data.totalCollection.toFixed(1) + ' Kg');
				$('#total_participant').html(data.data.totalParticipants);

				getLineChartData('month');

				google.load("visualization", "1.0", { packages: ["corechart"] }),
				google.setOnLoadCallback(drawPie3dExploded),
				$(function () {
					function e() {
						drawPie3dExploded();
					}
					$(window).on("resize", e), $(".menu-toggle").on("click", e);
				});

				google.load("visualization", "1.0", { packages: ["corechart"] }),
				google.setOnLoadCallback(drawPie3d),
				$(function () {
					function e() {
						drawPie3d();
					}
					$(window).on("resize", e), $(".menu-toggle").on("click", e);
				});

				google.load("visualization", "1.0", { packages: ["corechart"] }),
				google.setOnLoadCallback(drawBar),
				$(function () {
					function e() {
						drawBar();
					}
					$(window).on("resize", e), $(".menu-toggle").on("click", e);
				});
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	}

</script>

<script src="{{asset('dashboardjs/dashboardCollection/line.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardCollection/3d-pie.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardCollection/3d-pie-exploded.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardCollection/bar.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardCollection/map.js')}}"></script>
@endpush
