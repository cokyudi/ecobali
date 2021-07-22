@extends('template', ['user'=>$user])
@section('dashboard-shipment','active')

@push('css_extend')
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
            <div class="col-lg-3 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="text-muted font-medium-3">Sent to Papermill</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <i class="la la-database success font-large-4"></i>
                                        </div>
                                        <div class="col-5 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2 ">222</span>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">TON</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-1 ">222000</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">KG</span>
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
            <div class="col-lg-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="text-muted font-medium-3">Received at Papermill</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <i class="la la-database success font-large-4"></i>
                                        </div>
                                        <div class="col-4 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2 ">222</span>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">TON</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-1 ">222000</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">KG</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 pr-3 pl-3">
                                            <div class="row border-bottom-black-ship">
                                                <div class="col-12">
                                                    <strong class="font-medium-5 danger ">- 44</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong class="font-medium-5 danger"><i class="la la-sort-down font-medium-2"></i>&ensp;- 0,1%</strong>
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
            <div class="col-lg-3 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="text-muted font-medium-3">Accepted to Recycle</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <i class="la la-database success font-large-4"></i>
                                        </div>
                                        <div class="col-5 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2 ">222</span>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">TON</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-1 ">222000</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">KG</span>
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
        </div>

        <div class="row">
            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">Weight Reduction at ecoBali</h4>
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



            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">Moiisture Content, Contaminant</h4>
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

                            <div id="donut-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">Sent vs Received</h4>
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
                            <p class="card-text">A column chart is a vertical bar chart rendered in the browser using SVG or VML, whichever is appropriate for the user's browser. Like all google charts, column charts display tooltips when the user hovers over the data.</p>
                            <div id="column-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dinamics of KMK Sent</h4>
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
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dinamics of KMK Received</h4>
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

        <div class="row">
            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">Dinamics of KMK Accepted</h4>
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
            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title">Dinamics of MCC</h4>
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
                            <div id="column-chart"></div>
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
        <h4 class="text-uppercase mb-0">Data Filter Customizer</h4>
        <hr>

        <form id="filterForm" name="filterForm">
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

            <h5 class="mt-1 mb-1 text-bold-500">Papermill</h5>
            <div class="form-group">
                <div class="form-group">
                    <select id="id_district" name="id_district" class="select2 form-control">
                        <option value="0" selected="" disabled="">District</option>
                    </select>
                </div>
            </div>
            <div class="form-actions text-right">
                <button id='backBtn' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="saveBtn"  value="create" type="submit" class="btn btn-success">
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

<script src="{{asset('js/scripts/charts/google/pie/3d-pie.min.js')}}"></script>
<script src="{{asset('js/scripts/charts/google/pie/3d-pie-exploded.min.js')}}"></script>
<script src="{{asset('js/scripts/charts/google/bar/column.js')}}"></script>
<script src="{{asset('js/scripts/charts/google/pie/donut.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">

    $(document).ready(function() {
        $('#daterange').daterangepicker(
            {
                startDate: moment().subtract('days', 29),
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

        $('#backBtn').click(function() {
            var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
            console.log(endDates);
        });

    });
</script>
@endpush
