@extends('template', ['user'=>$user])
@section('dashboard-target','active')

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700" href="{{url('dashboard-target')}}">Dashboard Target</a>
    </li>
@endpush

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
            <div class="content-header row ">
            </div>
            <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
                <!--/ Revenue, Hit Rate & Deals -->

                <div class="row">
                    <div class="col text-center mb-1">
                        <button type="button" class="btn btn-success round" id="btn01"><b>JAN</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn02"><b>FEB</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn03"><b>MAR</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn04"><b>APR</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn05"><b>MAY</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn06"><b>JUN</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn07"><b>JUL</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn08"><b>AUG</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn09"><b>SEP</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn10"><b>OCT</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn11"><b>NOV</b></button>
                        <button type="button" class="btn btn-secondary round" id="btn12"><b>DEC</b></button>
                    </div>

                </div>
                {{--Monthly Target & Annual Target ecoBali--}}
                <div class="row ">
                    <div class="col-lg-4 col-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="height: 205px;">
                                    <div class="card-header">
                                        <h4 class="font-weight-bold font-medium-1">Annual Target (ecoBali)</h4>
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
                                            <h5>Total Annual Target</h5>
                                            <h1> <strong id="annualTon"></strong> T</h1>
                                            <h3> <strong id="annualKg"></strong> Kg</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="card" style="height: 205px;">
                                    <div class="card-header">
                                        <h4 class="font-weight-bold font-medium-1">Monthly Target (ecoBali)</h4>
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
                                            <h5>Total Monthly Target</h5>
                                            <h1> <strong id="monthlyTon"></strong> T</h1>
                                            <h3> <strong id="monthlyKg"></strong> Kg</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3 mr-2">Monthly Target Achievement (ecoBali)
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Pencapaian target bulanan pengumpulan Kemasan Bekas Minuman dari partisipannya ecoBali
(Rumus: jumlah KBM Terkumpul / target bulanan)" data-trigger="hover" data-html="true"
                                       data-original-title="Achievement of the monthly target of Used Beverage Cartons (UBC) collected by ecoBali <br>
(Formula: total UBC collected / monthly target)">
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
                                    <h4>Terkumpul <strong id="monthly_eco_terkumpul"></strong> Kg dari Target <strong id="monthly_eco_target"></strong> Kg.</h4>
                                    <div id="pie-3d"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3 mr-2">Annual Target Achievement (ecoBali)
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Pencapaian target tahunan pengumpulan Kemasan Bekas Minuman dari partisipannya ecoBali <br>
(Rumus: jumlah KBM Terkumpul / target tahunan)" data-trigger="hover" data-html="true"
                                       data-original-title="Achievement of the annual target of Used Beverage Cartons (UBC) collected by ecoBali <br>
(Formula: total UBC collected  / annual target)">
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
                                    <h4>Terkumpul <strong id="annual_eco_terkumpul"></strong> Kg dari Target <strong id="annual_eco_target"></strong> Kg.</h4>
                                    {{--                            <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>--}}
                                    <div id="pie-3d-exploded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Dynamic--}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3">Trend of Actual vs Target by Interval
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Dinamika perbandingan antara target dengan jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan interval waktu" data-trigger="hover"
                                       data-original-title="Comparison between the target and the number of Used Beverage Cartons (UBC) collected based on time interval">
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
                                <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                    <button onclick="drawActualTargetBarByMonth('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                    <button onclick="drawActualTargetBarByMonth('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                    <button onclick="drawActualTargetBarByMonth('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                                </div>
                                <div class="card-body mt-2">

                                    <div id="combo-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Actual vs Target--}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3">Actual vs Target by Categories
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Perbandingan antara target dengan jumlah Kemasan Bekas Minuman (KBM) yang dikumpulkan berdasarkan kategori" data-trigger="hover"
                                       data-original-title="Comparison between the target and the number of Used Beverage Cartons (UBC) collected based on category">
                                    </i>
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <canvas id="actual-target" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Monthly Target & Annual Target papermill--}}
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3 mr-2">Monthly Target Achievement (Sent to Papermill)
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Pencapaian target bulanan pengiriman Kemasan Bekas Minuman dari ecoBali menuju pabrik <br>
(Rumus: jumlah KBM Terkirim / target bulanan)" data-trigger="hover" data-html="true"
                                       data-original-title="Achievement of the monthly target of Used Beverage Cartons (UBC) sent to papermill by ecoBali <br>
(Formula: total UBC sent to papermill / monthly target)">
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
                                    <h4>Terkumpul <strong id="monthly_papermill_terkumpul"></strong> Kg dari Target <strong id="monthly_papermill_target"></strong> Kg.</h4>
                                    <div id="donut_monthly_papermill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold font-medium-3 mr-2">Annual Target Achievement (Sent to Papermill)
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Pencapaian target tahunan pengiriman Kemasan Bekas Minuman dari ecoBali menuju pabrik <br>
(Rumus: jumlah KBM Terkirim / target tahunan)" data-trigger="hover" data-html="true"
                                       data-original-title="Achievement of the annual target of sed Beverage Cartons (UBC) sent to papermill by ecoBali <br>
(Formula: total UBC sent to papermill / annual target)">
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
                                    <h4>Terkumpul <strong id="annual_papermill_terkumpul"></strong> Kg dari Target <strong id="annual_papermill_target"></strong> Kg.</h4>
                                    <div id="donut_annual_papermill"></div>
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
            <h5 class="text-uppercase mb-0">Collection Filter Customizer</h5>
            <hr>

            <form id="filterFormCollection" name="filterFormCollection">
                <h6 class="mt-1 mb-1 text-bold-500">Collection Date Range Options</h6>
                <div class="form-group">
                    <div class="form-group">
                        <div class='input-group'>
                            <input type="text" id="dateRangeCollection" name="dateRangeCollection" class = "form-control" value="" />
                            <div class="input-group-append" id="icon-calendar-1">
                            <span class="input-group-text">
                                <span class="la la-calendar" ></span>
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

            <h5 class="text-uppercase mb-0 pt-5">Sales Filter Customizer</h5>
            <hr>

            <form id="filterFormSales" name="filterFormSales">
                <h6 class="mt-1 mb-1 text-bold-500">Sales Date Range Options</h6>
                <div class="form-group">
                    <div class="form-group">
                        <div class='input-group'>
                            <input type="text" id="dateRangeSales" name="dateRangeSales" class = "form-control" value="" />
                            <div class="input-group-append" id="icon-calendar-2">
                            <span class="input-group-text">
                                <span class="la la-calendar" ></span>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-right">
                    <button id='resetFilterSales' type="button" class="btn btn-warning mr-1">
                        <i class="ft-x"></i> Reset
                    </button>
                    <button id="filterSales" type="button" class="btn btn-success">
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

    <script src="{{asset('dashboardjs/dashboardTarget/donut.js')}}"></script>



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
                    },
                    drops: 'up',
                },
                function(start, end) {

                }
            );

            drawActualTargetBar();
            drawActualTargetBarByMonth('month');
            drawTargetPapermillDonut();

            $('#icon-calendar-1').click(function() {
                $("#dateRangeCollection").focus();
            });

            $('#icon-calendar-2').click(function() {
                $("#dateRangeSales").focus();
            });


            $('#resetFilterCollection').click(function() {
                $('#dateRangeCollection').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
                $('#dateRangeCollection').data('daterangepicker').setEndDate(moment());

                drawActualTargetBar();
            });

            $('#filterCollection').click(function() {

                drawActualTargetBar();
                drawActualTargetBarByMonth('month');
            });

            $('#resetFilterSales').click(function() {
                $('#dateRangeSales').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
                $('#dateRangeSales').data('daterangepicker').setEndDate(moment());

                drawTargetPapermillDonut();
            });

            $('#filterSales').click(function() {
                drawTargetPapermillDonut();
            });



        });
    </script>
@endpush
