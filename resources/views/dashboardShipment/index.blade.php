@extends('template', ['user'=>$user])
@section('dashboard-shipment','active')

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700" href="{{url('dashboard-shipment')}}">Dashboard Shipment</a>
    </li>
@endpush

@push('css_extend')
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
            <div class="col-md-4 col-12 ">
                <div class="card pull-up" style="height: 300px;">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-1">Sent to Papermill
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Total Kemasan Bekas Minuman (KBM) yang dikumpulkan oleh ecoBali dan dikirim menuju pabrik" data-trigger="hover" data-html="true"
                                       data-original-title="Total number of Used Beverage Cartons (UBC) collected at ecoBali and sent to papermill">
                                    </i>
                                </h6> <img src="{{asset('images/icons/sent_to_papermill.png')}}" alt="" width="75px">
                            </div>
                            <div class="media d-flex mt-2">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-6 border-right">
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
                                        <div class="col-6 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-medium-4" id="delivered_to_papermill_kg"></span>
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
            <div class="col-md-4 col-12 ">
                <div class="card pull-up " style="height: 300px;">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-1">Received at Papermill
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Total Kemasan Bekas Minuman (KBM) yang diterima dipabrik sebelum dikurangi bahan cair dan kontaminan " data-trigger="hover" data-html="true"
                                       data-original-title="Total number of Used Beverage Cartons (UBC) received at papermill before moisture content and contaminant reduction">
                                    </i>
                                </h6>
                                <img src="{{asset('images/icons/recieved_at_papermill.png')}}" alt="" width="75px">
                            </div>
                            <div class="media d-flex mt-2">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">
                                        <div class="col-6 border-right">
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
                                        <div class="col-6 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-medium-4" id="received_at_papermill_kg"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">KG</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12 mt-2">
                                            <span class="font-medium-2" >Differences : </span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <strong class="font-medium-2" id="weighing_scale_gap_papermill"></strong><span> Kg / </span> <i id="indikator_panah" ></i><span> ( </span><strong class="font-medium-2 danger" id="weighing_scale_gap_papermill_percent"></strong><span>)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 ">
                <div class="card pull-up " style="height: 300px;">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media-body col-12 text-center">
                                <h6 class="font-weight-bold font-medium-1">Final Weight at Papermill
                                    <i class="la la-info-circle" data-toggle="popover"
                                       data-content="Total Kemasan Bekas Minuman (KBM) yang diterima dipabrik setelah dikurangi bahan cair dan kontaminan <br>
(Rumus: total KBM di terima di pabrik - total bahan cair dan kontaminan)" data-trigger="hover" data-html="true"
                                       data-original-title="Total of Used Beverage Cartons (UBC) received at papermill after moisture content and contaminant reduction <br>
(Formula: total UBC received at papermill - total moisture content and contaminant)">
                                    </i>
                                </h6>
                                <img src="{{asset('images/icons/shipment-accepted.png')}}" alt="" width="75px">
                            </div>
                            <div class="media d-flex mt-2">
                                <div class="media-body text-center ">
                                    <div class="row align-items-center">

                                        <div class="col-6 border-right">
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
                                        <div class="col-6 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-medium-4 " id="total_weight_accepted_kg"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="">KG</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-12 ">
                                            <div class="row align-items-center">
                                                <div class="col-12 mt-2">
                                                    <span class="font-medium-2" >Differences : </span>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <strong class="font-medium-2" id="diff_mcc"></strong><span> Kg / </span> <i id="indikator_panah_mcc" ></i><span> ( </span><strong class="font-medium-2 danger" id="mcc_percent"></strong><span>)</span>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Sent vs Received
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Perbandingan jumlah Kemasan Bekas Minuman (KBM) yang sudah dikumpulkan oleh ecoBali dengan Total Kemasan Bekas Minuman (KBM) yang diterima dipabrik untuk memonitoring perjalanan barang menuju pabrik" data-trigger="hover" data-html="true"
                               data-original-title="Comparison between the total number of Used Beverage Cartons (UBC) collected and sent by ecoBali to papermill by ecoBali and the total number of used beverage Cartons (UBC) received at the papermill">
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
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                <button onclick="getSales('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                <button onclick="getSales('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                <button onclick="getSales('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                            </div>
                            <div id="sentVsReceivedBar" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Weight Reduction at ecoBali
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Jumlah susut Kemasan Bekas Minuman (KBM) yang dikumpulkan oleh ecoBali dari partisipannya ecoBali <br>
(Rumus: jumlah KBM dikirim ke pabrik - Jumlah KBM yang dikumpulkan di ecoBali H-1 penjualan)" data-trigger="hover" data-html="true"
                               data-original-title="Total number of depreciation of Used Beverage Cartons (UBC) collected by ecoBali from ecoBali partners <br>
(Formula: Total UBC sent to papermill - Total UBC Collected D-1)">
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
                            <h3>Total Penyusutan : <strong id="weight_reduction_susut"></strong> Kg dari Total UBC Terkumpul : <strong id="weight_reduction_tidak_susut"></strong> Kg.</h3>
                            <div id="pie_weight_reduction"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-12 ">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Moisture Content, Contaminant (MCC)
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Jumlah dan persentase bahan cair dan kontaminan dari Kemasan Bekas Minuman (KBM) yang diterima dipabrik <br>
(Rumus: jumlah bahan cair dan kontaminan / jumlah KBM yang diterima di pabrik)" data-trigger="hover" data-html="true"
                               data-original-title="Total number and percentage of moisture content and contaminant in Used Beverage Cartons (UBC) received at papermill. <br>
(Formula: total moisture content and contaminant / total UBC received at papermill)">
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
                            <h3>Total MCC :  <strong id="text_mcc"></strong> Kg dari Total UBC Diterima di Pabrik : <strong id="text_ubc"></strong> Kg.</h3>
                            <div id="donut_mcc"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Trend of UBC Sent
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Dinamika jumlah Kemasan Bekas Minuman (KBM) yang sudah dikumpulkan oleh ecoBali dan dikirim menuju pabrik" data-trigger="hover" data-html="true"
                               data-original-title="The trend of total number of Used Beverage Cartons (UBC) collected at ecoBali and sent to papermill">
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
                        <div class="card-body chartjs">
                            <canvas id="kmkSent" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Trend of UBC Received
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Dinamika jumlah Kemasan Bekas Minuman (KBM) yang diterima dipabrik sebelum dikurangi bahan cair dan kontaminan " data-trigger="hover" data-html="true"
                               data-original-title="The trend of total number of Used Beverage Cartons (UBC) received at papermill before moisture content and contaminant reduction">
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
                        <div class="card-body chartjs">
                            <canvas id="kmkReceived" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Trend of UBC Final Weight
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Dinamika jumlah Kemasan Bekas Minuman (KBM) yang diterima dipabrik setelah dikurangi bahan cair dan kontaminan" data-trigger="hover" data-html="true"
                               data-original-title="The trend of total number of Used Beverage Cartons (UBC) received at papermill after moisture content and contaminant reduction">
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
                        <div class="card-body chartjs">
                            <canvas id="kmkAccepted" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="font-weight-bold font-medium-3">Trend of MCC
                            <i class="la la-info-circle" data-toggle="popover"
                               data-content="Dinamika Jumlah bahan cair dan kontaminan dari Kemasan Bekas Minuman (KBM) yang diterima dipabrik " data-trigger="hover" data-html="true"
                               data-original-title="The trend of total number of moisture content and contaminant in Used Beverage Cartons (UBC) received at papermill">
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
                            <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
{{--                                <button onclick="drawMCCCustom('month');" type="button" class="btn btn-sm btn-secondary">Month</button>--}}
{{--                                <button onclick="drawMCCCustom('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>--}}
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
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
        <h5 class="text-uppercase mb-0">Data Filter Customizer</h5>
        <hr>

        <form id="filterForm" name="filterForm">
            <h6 class="mt-1 mb-1 text-bold-500">Date Range Options</h6>
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

            <h6 class="mt-1 mb-1 text-bold-500">Papermill</h6>
            <div class="form-group">
                <div class="form-group">
                    <select id="id_papermill" name="id_papermill[]" multiple="multiple" class="select2 form-control" data-placeholder="Select Papermill">
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
            $('#daterange').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
            $('#daterange').data('daterangepicker').setEndDate(moment());

            getSales("month");
        });

        getSales("month");

        $('#filterBtn').click(function() {
            getSales("month");
        });


    });
</script>
<script type="text/javascript">
    function getSales(type) {
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
            type:type,
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

                var diffMcc = data.data.total_weight_accepted.toFixed(1)-data.data.received_at_papermill.toFixed(1);
                $('#diff_mcc').html(diffMcc);
                if (diffMcc >= 0) {
                    $('#diff_mcc').addClass("success")
                } else {
                    $('#diff_mcc').addClass("danger")
                }

                var mccPercent = (diffMcc / data.data.received_at_papermill.toFixed(1))*100;
                $('#mcc_percent').html(mccPercent.toFixed(1)+' %');
                if (data.data.weighing_scale_gap_papermill_percent >= 0) {
                    $('#mcc_percent').addClass("success");
                    $('#indikator_panah_mcc').addClass("la la-sort-up font-medium-2 success");
                } else {
                    $('#mcc_percent').addClass("danger");
                    $('#indikator_panah_mcc').addClass("la la-sort-down font-medium-2 danger");
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

        function removeIndicator() {
            $('#weighing_scale_gap_papermill').removeClass("success")
            $('#weighing_scale_gap_papermill').removeClass("danger")
            $('#weighing_scale_gap_papermill_percent').removeClass("success")
            $('#indikator_panah').removeClass("la la-sort-down")
            $('#indikator_panah').removeClass("success")
            $('#weighing_scale_gap_papermill_percent').removeClass("danger")
            $('#indikator_panah').removeClass("la la-sort-up")
            $('#indikator_panah').removeClass("danger")

            $('#diff_mcc').removeClass("success")
            $('#diff_mcc').removeClass("danger")
            $('#mcc_percent').removeClass("success")
            $('#indikator_panah_mcc').removeClass("la la-sort-down")
            $('#indikator_panah_mcc').removeClass("success")
            $('#mcc_percent').removeClass("danger")
            $('#indikator_panah_mcc').removeClass("la la-sort-up")
            $('#indikator_panah_mcc').removeClass("danger")
        }

    }
</script>

@endpush
