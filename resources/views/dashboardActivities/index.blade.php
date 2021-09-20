@extends('template', ['user'=>$user])
@section('dashboard-activities','active')
@push('css_extend')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <style type="text/css">
        #mapActivity { height: 100%; width:100%;}
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
    </div>
    <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
    <!--/ Revenue, Hit Rate & Deals -->
        <div class="row">
            <div class="col-lg-3 col-12 pb-1">
                <div class="card h-75 ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="font-weight-bold font-medium-3">District Coverage
                                        <i class="la la-info-circle" data-toggle="popover"
                                           data-content="Jumlah kecamatan yang menjadi lokasi sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM)" data-trigger="hover" data-html="true"
                                           data-original-title="Number of district received socialization / education about Used Beverage Cartons (UBC) recycling">
                                        </i>
                                    </h6>
                                    <h3 class="font-large-2" id="district_coverage"></h3>
                                </div>
                                <div class="align-self-center">
                                    <img src="{{asset('images/icons/district.png')}}" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12 pb-1">
                <div class="card h-75 ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="font-weight-bold font-medium-3">Regency Coverage
                                        <i class="la la-info-circle" data-toggle="popover"
                                           data-content="Jumlah kabupaten yang menjadi lokasi sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM)" data-trigger="hover" data-html="true"
                                           data-original-title="Number of regency received socialization / education about Used Beverage Cartons (UBC) recyling">
                                        </i>
                                    </h6>
                                    <h3 class="font-large-2" id="regency_coverage"></h3>
                                </div>
                                <div class="align-self-center">
                                    <img src="{{asset('images/icons/regency.png')}}" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12 pb-1">
                <div class="card h-75">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="font-weight-bold font-medium-3">Location Coverage
                                        <i class="la la-info-circle" data-toggle="popover"
                                           data-content="Jumlah lokasi / organisasi yang mendapat sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM)" data-trigger="hover" data-html="true"
                                           data-original-title="Number of organization / location received socialization / education about Used Beverage Cartons (UBC) recycling">
                                        </i>
                                    </h6>
                                    <h3 class="font-large-2" id="location_coverage"></h3>
                                </div>
                                <div class="align-self-center">
                                    <img src="{{asset('images/icons/location.png')}}" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12 pb-1">
                <div class="card h-75">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h6 class="font-weight-bold font-medium-3">Total Participant
                                        <i class="la la-info-circle" data-toggle="popover"
                                           data-content="Jumlah orang yang mengikuti dan mendapat sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM)" data-trigger="hover" data-html="true"
                                           data-original-title="Number of people who participated and received socialization / education about Used Beverage Cartons (UBC) recycling">
                                        </i>
                                    </h6>
                                    <h3 class="font-large-2" id="total_participant"></h3>
                                </div>
                                <div class="align-self-center">
                                    <img src="{{asset('images/icons/participant.png')}}" alt="" width="50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Number of Participant
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Jumlah orang yang mengikuti dan mendapat sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM) berdasarkan program" data-trigger="hover" data-html="true"
                               data-original-title="Number of people who participated and received socialization / education about Used Beverage Cartons (UBC) recycling, based on program">
                            </i>
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
{{--                            <p class="card-text">A column chart is a vertical bar chart rendered in the browser using SVG or VML, whichever is appropriate for the user's browser. Like all google charts, column charts display tooltips when the user hovers over the data.</p>--}}
                            <div id="numberOfParticipantBar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Number of Location
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Jumlah lokasi / organisasi yang mendapat sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM) berdasarkan kategori lokasi / organisasi" data-trigger="hover" data-html="true"
                               data-original-title="Number of organizations / locations that received socialization / education about Used Beverage Cartons (UBC) recycling, based on organization/location category">
                            </i>
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="bar-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header mb-0">
                        <h4 class="font-weight-bold font-medium-3">Map
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Jumlah orang yang mengikuti dan mendapat sosialisasi / edukasi tentang daur ulang Kemasan Bekas Minuman (KBM) berdasarkan wilayah Kabupaten" data-trigger="hover" data-html="true"
                               data-original-title="Number of people who participated and received socialization / education about Used Beverage Cartons (UBC) recycling, based on region (regency)">
                            </i>
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body height-500">
                            <div id="mapActivity" ></div>
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
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
        <h4 class="text-uppercase mb-0">Data Filter Customizer</h4>
        <hr>

        <form id="filterForm" name="filterForm">

            <h5 class="mt-1 mb-1 text-bold-500">District</h5>
            <div class="form-group ">
                <select id="id_district" name="id_district[]" multiple="multiple" class="select2 form-control">
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->district_name}}</option>
                    @endforeach

                </select>
            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">Regency</h5>
            <div class="form-group ">
                <select class="select2 form-control" id="id_regency" name="id_regency[]" multiple="multiple">
                    @foreach($regencies as $regency)
                        <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                    @endforeach
                </select>

            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">Category</h5>
            <div class="form-group ">
                <select id="id_category" name="id_category[]" multiple="multiple" class="select2 form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                </select>
            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">Program</h5>
            <div class="form-group ">
                <select class="select2 form-control" id="id_program" name="id_program[]" multiple="multiple">
                    @foreach($programs as $program)
                        <option value="{{$program->id}}">{{$program->activity_program_name}}</option>
                    @endforeach
                </select>

            </div>
            <hr>

            <h5 class="mt-1 mb-1 text-bold-500">Date Range Options</h5>
            <div class="form-group">
                <div class="form-group">
                    <div class='input-group'>
                        <input type="text" id="daterange" name="daterange" class = "form-control" value="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="la la-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <button id='resetFilter' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="filterBtn"  value="create" type="button" class="btn btn-success">
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
    <script src="https://www.google.com/jsapi"></script>
{{--    <script src="{{asset('js/scripts/charts/google/bar/column.js')}}"></script>--}}
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
{{--    <script src="{{asset('js/scripts/charts/google/bar/bar.min.js')}}"></script>--}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    $(document).ready(function() {

        $('#daterange').daterangepicker(
            {
                startDate: moment("01/01/2019","DD/MM/YYYY"),
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
                }
            },
            function(start, end) {

            }
        );

        getAllData();

        $('#resetFilter').click(function() {
            $('#dateRange').data('daterangepicker').setStartDate(moment("01/01/2019","DD/MM/YYYY"));
            $('#dateRange').data('daterangepicker').setEndDate(moment());
            getAllData();
        });

        $('#filterBtn').click(function() {
            getAllData();
        });


    });
</script>
    <script src="{{asset('dashboardjs/dashboardActivities/map.js')}}"></script>
@endpush
