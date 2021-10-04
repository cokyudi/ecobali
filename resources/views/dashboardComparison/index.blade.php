@extends('template', ['user'=>$user])
@section('dashboard-comparison','active')

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700 font-medium-3" href="{{url('dashboard-comparison')}}">Dashboard Comparison</a>
    </li>
@endpush

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
    </div>
    <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
    <!--/ Revenue, Hit Rate & Deals -->
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold font-medium-5">Participant Performance Comparison
                    <i class="la la-info-circle" data-toggle="popover" data-container="nav"
                       data-content="Perbadingan dinamika dan jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan oleh setiap partisipan" data-trigger="hover"
                       data-original-title="Comparison of total number trend of Used Beverage Cartons (UBC) collected by Participant">
                    </i>
                </h4>
                <p class="font-medium-1"> Select the participants you want to compare from the filter <i class="ft-filter"></i> </p>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-content collapse show">
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                <button onclick="getComparisonLineChartData('week');" type="button" class="btn btn-sm btn-secondary">Week</button>
                                <button onclick="getComparisonLineChartData('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                <button onclick="getComparisonLineChartData('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                <button onclick="getComparisonLineChartData('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                              </div>
                            <div class="card-body chartjs">
                                <canvas id="line-chart" height="450"></canvas>
                            </div>
                        </div>
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
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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

        getBlankLine();

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
            getBlankLine();
        });

        $('#filterBtn').click(function() {
            getComparisonLineChartData('week');
        });


    });
    function getBlankLine() {
        var o = $("#line-chart");
        myLineChart = new Chart(o, {
            type: "line",
            options: {
                responsive: !0,
                maintainAspectRatio: !1,
                legend: { position: "bottom" },
                hover: { mode: "label" },
                scales: {
                    xAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Interval", padding: 10, },ticks: {
                            padding: 10
                        } }],
                    yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "UBC (Kg)", padding: 10 },ticks: { padding: 10,beginAtZero: true}}],
                },
                title: { display: !0, text: "" },
            },
            data: {
                labels: [],
                datasets: []
            },
        });
    }
</script>
<script src="{{asset('dashboardjs/dashboardComparison/line.js')}}"></script>
@endpush
