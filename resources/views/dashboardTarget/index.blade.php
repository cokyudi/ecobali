@extends('template', ['user'=>$user])
@section('dashboard-target','active')

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

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
    </div>
    <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
    <!--/ Revenue, Hit Rate & Deals -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actual vs Target by Categories</h4>
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
                        <div class="card-body">
                            <canvas id="actual-target" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dinamics of Actual vs Target by Month</h4>
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
                        <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                            <button onclick="drawActualTargetBarByMonth('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                            <button onclick="drawActualTargetBarByMonth('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                        </div>
                        <div class="card-body mt-2">

                            <div id="combo-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Monthly Target Achievement</h4>
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
{{--                            <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>--}}
                            <div id="pie-3d"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Annual Target Achievement (ecoBali)</h4>
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
{{--                            <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>--}}
                            <div id="pie-3d-exploded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Donut Chart</h4>
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
                            <p class="card-text">A donut chart is a pie chart with a hole in the center. You can create donut charts with the pieHole option.</p>
                            <p class="card-text">The pieHole option should be set to a number between 0 and 1, corresponding to the ratio of radii between the hole and the chart. Numbers between 0.4 and 0.6 will look best on most charts. Values equal to or greater than 1 will be ignored, and a value of 0 will completely shut your piehole.</p>
                            <div id="donut-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Donut Chart</h4>
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
                            <p class="card-text">A donut chart is a pie chart with a hole in the center. You can create donut charts with the pieHole option.</p>
                            <p class="card-text">The pieHole option should be set to a number between 0 and 1, corresponding to the ratio of radii between the hole and the chart. Numbers between 0.4 and 0.6 will look best on most charts. Values equal to or greater than 1 will be ignored, and a value of 0 will completely shut your piehole.</p>
                            <div id="donut-chart1"></div>
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
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-danger box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
        <h4 class="text-uppercase mb-0">Collection Filter Customizer</h4>
        <hr>

        <form id="filterFormCollection" name="filterFormCollection">
            <h5 class="mt-1 mb-1 text-bold-500">Collection Date Range Options</h5>
            <div class="form-group">
                <div class="form-group">
                    <div class='input-group'>
                        <input type="text" id="dateRangeCollection" name="dateRangeCollection" class = "form-control" value="" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="la la-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <button id='resetFilterCollection' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="filterCollection"  type="button" class="btn btn-success">
                    <i class="la la-check-square-o"></i> Filter
                </button>
            </div>

        </form>

        <h4 class="text-uppercase mb-0 pt-5">Sales Filter Customizer</h4>
        <hr>

        <form id="filterFormSales" name="filterFormSales">
            <h5 class="mt-1 mb-1 text-bold-500">Sales Date Range Options</h5>
            <div class="form-group">
                <div class="form-group">
                    <div class='input-group'>
                        <input type="text" id="dateRangeSales" name="dateRangeSales" class = "form-control" value="" />
                        <div class="input-group-append">
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
                <button id="filterSales"  value="create" type="submit" class="btn btn-success">
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
<script src="{{asset('js/scripts/charts/chartjs/line/line.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>

<script src="{{asset('dashboardjs/dashboardTarget/actualTargetBar.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardTarget/combo.js')}}"></script>
{{--<script src="{{asset('js/scripts/charts/chartjs/bar/column-stacked.min.js')}}"></script>--}}
{{--<script src="{{asset('js/scripts/charts/google/bar/combo.min.js')}}"></script>--}}

{{--<script src="{{asset('js/scripts/charts/google/pie/3d-pie.min.js')}}"></script>--}}
{{--<script src="{{asset('js/scripts/charts/google/pie/3d-pie-exploded.min.js')}}"></script>--}}

<script src="{{asset('js/scripts/charts/google/pie/donut.min.js')}}"></script>



<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">

    $(document).ready(function() {
        $('#dateRangeCollection').daterangepicker(
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
                }
            },
            function(start, end) {

            }
        );

        $('#dateRangeSales').daterangepicker(
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
                }
            },
            function(start, end) {

            }
        );

        drawActualTargetBar();
        drawActualTargetBarByMonth('month');


        $('#resetFilterCollection').click(function() {
            $('#dateRangeCollection').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
            $('#dateRangeCollection').data('daterangepicker').setEndDate(moment());

            drawActualTargetBar();
        });

        $('#filterCollection').click(function() {

            drawActualTargetBar();
            drawActualTargetBarByMonth('month');
        });
        
    });
</script>
@endpush
