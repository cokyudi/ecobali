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
            <div class="col-lg-4 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-5">Sent to Papermill</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <img src="{{asset('images/icons/sent_to_papermill.png')}}" alt="" width="85px">
{{--                                            <i class="la la-database success font-large-4"></i>--}}
                                        </div>
                                        <div class="col-5 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2 " id="delivered_to_papermill_ton"></span>
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
                                                    <span class="font-large-1" id="delivered_to_papermill_kg"></span>
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
            <div class="col-lg-4 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-5">Received at Papermill</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <img src="{{asset('images/icons/recieved_at_papermill.png')}}" alt="" width="85px">

                                        </div>
                                        <div class="col-4 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2" id="received_at_papermill_ton"></span>
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
                                                    <span class="font-medium-5" id="received_at_papermill_kg"></span>
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
                                                    <strong class="font-medium-2 " id="weighing_scale_gap_papermill"></strong>
                                                </div>
                                            </div>
                                            <div class="row">

{{--                                                    <strong class="font-medium-5 danger" id="weighing_scale_gap_papermill_percent"><i class="la la-sort-down font-medium-2"></i>&ensp;- 0,1%</strong>--}}
                                                <i id="indikator_panah" class=" "></i><strong class="font-medium-1 danger" id="weighing_scale_gap_papermill_percent"></strong>
                                            </div>
                                        </div>
                                    </div>

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
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-5">Accepted to Recycle</h6>
                            </div>
                            <div class="media d-flex">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <img src="{{asset('images/icons/shipment-accepted.png')}}" alt="" width="85px">
                                        </div>
                                        <div class="col-5 border-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-large-2 " id="total_weight_accepted_ton"></span>
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
                                                    <span class="font-large-1 " id="total_weight_accepted_kg"></span>
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
                        <h4 class="font-weight-bold font-medium-5">Weight Reduction at ecoBali</h4>
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
                            <h3>Total Penyusutan <strong id="weight_reduction_susut"></strong> Kg dan Total Tidak Susut <strong id="weight_reduction_tidak_susut"></strong> Kg.</h3>
{{--                            <p class="card-text">A pie chart that is rendered within the browser using SVG or VML. Displays tooltips when hovering over slices.</p>--}}
                            <div id="pie_weight_reduction"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Moiisture Content, Contaminant</h4>
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
                            <h3>Total MCC :  <strong id="text_mcc"></strong> Kg dan Total UBC : <strong id="text_ubc"></strong> Kg.</h3>
                            <div id="donut_mcc"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Sent vs Received</h4>
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
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                <button onclick="drawSentVsReceivedCustom('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                <button onclick="drawSentVsReceivedCustom('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                            </div>
                            <div id="sentVsReceivedBar" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Dinamics of KMK Sent</h4>
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
                            <canvas id="kmkSent" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Dinamics of KMK Received</h4>
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
                            <canvas id="kmkReceived" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Dinamics of KMK Accepted</h4>
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
                            <canvas id="kmkAccepted" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 py-2">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-5">Dinamics of MCC</h4>
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
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                <button onclick="drawMCCCustom('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                <button onclick="drawMCCCustom('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                            </div>
                            <div id="dynamicMcc" class="mt-4"></div>
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
                    <select id="id_papermill" name="id_papermill[]" multiple="multiple" class="select2 form-control">
                        @foreach($papermills as $papermill)
                            <option value="{{$papermill->id}}">{{$papermill->papermill_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-actions text-right">
                <button id='backBtn' type="button" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Reset
                </button>
                <button id="filterBtn" type="button" class="btn btn-success">
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

{{--<script src="{{asset('js/scripts/charts/google/pie/3d-pie.min.js')}}"></script>--}}
{{--<script src="{{asset('js/scripts/charts/google/pie/3d-pie-exploded.min.js')}}"></script>--}}
<script src="{{asset('js/scripts/charts/google/bar/column.js')}}"></script>
{{--<script src="{{asset('js/scripts/charts/google/pie/donut.min.js')}}"></script>--}}

<script src="{{asset('dashboardjs/dashboardShipment/donut.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardShipment/columnChart.js')}}"></script>
<script src="{{asset('dashboardjs/dashboardShipment/KMKLine.js')}}"></script>

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
                }
            },
            function(start, end) {

            }
        );

        $('#backBtn').click(function() {
            $('#dateRangeCollection').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
            $('#dateRangeCollection').data('daterangepicker').setEndDate(moment());

            getSales();
        });

        getSales();

        function getSales() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
            var idPapermill = $('#id_papermill').val();

            var data = {
                startDates: startDates,
                endDates: endDates,
                id_papermills : idPapermill,
            }

            $.ajax({
                type: "GET",
                url: "getSales",
                data:data,
                success: function (data) {
                    removeIndicator();
                    $('#delivered_to_papermill_ton').html((data.data.delivered_to_papermill/1000).toFixed(1));
                    $('#delivered_to_papermill_kg').html(data.data.delivered_to_papermill.toFixed(1));
                    $('#received_at_papermill_ton').html((data.data.received_at_papermill/1000).toFixed(1));
                    $('#received_at_papermill_kg').html(data.data.received_at_papermill.toFixed(1));

                    $('#weighing_scale_gap_papermill').html(data.data.weighing_scale_gap_papermill);
                    if (data.data.weighing_scale_gap_papermill >= 0) {
                        $('#weighing_scale_gap_papermill').addClass("success")
                    } else {
                        $('#weighing_scale_gap_papermill').addClass("danger")
                    }

                    $('#weighing_scale_gap_papermill_percent').html(data.data.weighing_scale_gap_papermill_percent+' %');
                    if (data.data.weighing_scale_gap_papermill_percent >= 0) {
                        $('#weighing_scale_gap_papermill_percent').addClass("success");
                        $('#indikator_panah').addClass("la la-sort-up font-medium-2 success");
                    } else {
                        $('#weighing_scale_gap_papermill_percent').addClass("danger");
                        $('#indikator_panah').addClass("la la-sort-down font-medium-2 danger");
                    }
                    $('#total_weight_accepted_ton').html((data.data.total_weight_accepted/1000).toFixed(1));
                    $('#total_weight_accepted_kg').html(data.data.total_weight_accepted.toFixed(1));

                    drawDonutPie(data);
                    drawSentVsReceived(data);
                    drawKMKLine(data);

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        }

        $('#filterBtn').click(function() {
            getSales();
        });

        function removeIndicator() {
            $('#weighing_scale_gap_papermill').removeClass("success")
            $('#weighing_scale_gap_papermill').removeClass("danger")
            $('#weighing_scale_gap_papermill_percent').removeClass("success")
            $('#indikator_panah').removeClass("la la-sort-down")
            $('#indikator_panah').removeClass("success")
            $('#weighing_scale_gap_papermill_percent').removeClass("danger")
            $('#indikator_panah').removeClass("la la-sort-up")
            $('#indikator_panah').removeClass("danger")
        }

    });
</script>
@endpush
