@extends('template', ['user'=>$user])
@section('participants','active')

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Create Participant</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">View Participant
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">

                            <form class="form" id="participantForm" name="participantForm" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <input type="hidden" id="participant_id" name="participant_id" value="{{$participant->id}}">
                                    <input type="hidden" id="created_by" name="created_by" value="">
                                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                                <div class="nav-vertical">
                                    <ul class="nav nav-tabs nav-left nav-border-left">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabCollection" aria-expanded="false">Collection</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div class="tab-pane active" id="tabCollection" >
                                            <div class="d-flex">

                                                <div class="p-2">
                                                    <button type="button" class="btn round btn-min-width " id="btnContinuity" style="width: 180px">Continuity : <b id="continuity">None</b></button>
                                                </div>
                                                <div class="mr-auto p-2">
                                                    <button type="button" class="btn round btn-min-width " id="btnPotential" style="width: 180px">Potential : <b id="potential">Low</b></button>
                                                </div>

                                                <div class="p-2">
                                                    <input type="text" id="daterange" name="daterange" class = "form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="pr-2 pl-2 pt-0">
                                                    <button type="button" class="btn btn-primary round  btn-min-width" style="width: 180px">Total : <b id="totalubc"> Kg</b></button>
                                                </div>
                                                <div class="mr-auto pr-2 pl-2 pt-0">
                                                    <button type="button" class="btn btn-secondary round btn-min-width " style="width: 180px">Average : <b id="average"> Kg</b></button>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                                    <button onclick="getLineChartDataCollection('week');" type="button" class="btn btn-sm btn-secondary">Week</button>
                                                    <button onclick="getLineChartDataCollection('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                                    <button onclick="getLineChartDataCollection('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                                    <button onclick="getLineChartDataCollection('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                                                </div>
                                                <div class="card-body chartjs">
                                                    <canvas id="line-chart" height="500"></canvas>
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="collectionTable" class="table table-striped table-bordered zero-configuration nowrap ml-1" width="95%">
                                                            <thead>
                                                            <tr>
                                                                <th width="20px">No</th>
                                                                <th hidden>ID</th>
                                                                <th width="300px">Collect Date</th>
                                                                <th width="300px">Quantity</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th width="20px">No</th>
                                                                <th hidden>ID</th>
                                                                <th width="300px">Collect Date</th>
                                                                <th width="300px">Quantity</th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('ajax_crud')
    <script src="{{asset('vendors/js/charts/chart.min.js')}}"></script>
{{--    <script src="{{asset('js/scripts/charts/chartjs/line/line.min.js')}}"></script>--}}
    <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    $(document).ready(function(e) {
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
                fetchDatatable();
                getLineChartDataCollection("week");
            }
        );

        $('#url_photo_1').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image1-before-upload').attr('src', e.target.result);
                $('#imageModal1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            var filename = $('#url_photo_1')[0].files[0];
            $('#url_photo_1_label').html(filename.name);

        });

        $('#url_photo_2').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image2-before-upload').attr('src', e.target.result);
                $('#imageModal2').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            var filename = $('#url_photo_2')[0].files[0];
            $('#url_photo_2_label').html(filename.name);

        });
        fetchDatatable();
        getLineChartDataCollection("week");

    });
</script>
<script type="text/javascript">
    $(function() {
        $('#id_category').val("{{$participant->id_category}}");
        $('#joined_date').val("{{$participant->joined_date}}");
        $('#id_transport_intensity').val("{{$participant->id_transport_intensity}}");
        $("#id_area").val("{{$participant->id_area}}").trigger("change");
        $('#id_district').val("{{$participant->id_district}}");
        $('#id_regency').val("{{$participant->id_regency}}");
        $('#id_box_resource').val([{{$participant->id_box_resource}}]).change();
        $('#id_purchase_price').val("{{$participant->id_purchase_price}}");
        $('#id_payment_method').val("{{$participant->id_payment_method}}");
        $('#id_bank').val("{{$participant->id_bank}}");
        $('#notes').val("{{$participant->notes}}");

        if ('{{$participant->url_photo_1}}' !== '' ) {
            $('#preview-image1-before-upload').attr('src', "{{ asset('images/participants/'.$participant->url_photo_1)}}");
            $('#imageModal1').attr('src', "{{ asset('images/participants/'.$participant->url_photo_1)}}");
            $('#fileNamePhoto1').val("{{$participant->url_photo_1}}");

        }

        if ('{{$participant->url_photo_2}}' !== '') {
            $('#preview-image2-before-upload').attr('src', "{{ asset('images/participants/'.$participant->url_photo_2)}}");
            $('#imageModal2').attr('src', "{{ asset('images/participants/'.$participant->url_photo_2)}}");
            $('#fileNamePhoto2').val("{{$participant->url_photo_2}}");
        }

        $('#created_by').val("{{$participant->created_by}}");
        $('#created_datetime').val("{{$participant->created_datetime}}");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#backBtn').click(function() {
            console.log(new FormData($("#participantForm")[0]));
            {{--window.location.href = "{{ route('participants.index') }}";--}}
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            if ($('#saveBtn').val() == "create")  {
                $('#created_by').val("Deva Dwi A");
                $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                $('#last_modified_by').val(null);
                $('#last_modified_datetime').val(null);
            } else {
                $('#last_modified_by').val("Deva Dwi A Edit");
                $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
            }
            $(this).html('Save');

            $.ajax({
                data: new FormData($("#participantForm")[0]),
                url: "{{ route('participants.store') }}",
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('#saveBtn').val("modify");
                    $('#saveBtn').html('Save Changes');
                    $('#participant_id').val(dataResult.data.id);
                    $('#created_by').val(dataResult.data.created_by);
                    $('#created_datetime').val(dataResult.data.created_datetime);

                    // $('#paymentMethodForm').trigger("reset");
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });

        });
    });

    function fetchDatatable(){
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idParticipant = $('#participant_id').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            idParticipant: idParticipant,
        }

        var table = $('#collectionTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            searching: false,
            order: [[2, "desc"]],
            ajax: {
                url:"{{ route('participants.getDatatableCollection') }}",
                data: params
            },
            columns: [
                {data: null},
                {data: 'id', name: 'id', visible: false},
                {
                    name: 'collect_date.timestamp',
                    data: {
                        _: 'collect_date.display',
                        sort: 'collect_date.timestamp'
                    }
                },
                {data: 'quantity', name: 'quantity'},
            ],
        });

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    }

    function getLineChartDataCollection(type) {
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idParticipant = $('#participant_id').val();
        var type = type;

        var myLineChart;
        var params = {
            startDates: startDates,
            endDates: endDates,
            idParticipant: idParticipant,
            type:type,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "../../getLineChartDataCollection",
            data: params,
            success: function (data) {
                $('#btnContinuity').removeClass("btn-danger").removeClass("btn-warning").removeClass("btn-info").removeClass("btn-success");
                $('#btnPotential').removeClass("btn-danger").removeClass("btn-warning").removeClass("btn-info").removeClass("btn-success");
                $('#continuity').html(data.data.continuity);
                $('#potential').html(data.data.potential);
                $('#btnContinuity').addClass(data.data.continuityColor);
                $('#btnPotential').addClass(data.data.potentialColor);

                $('#totalubc').html(data.data.totalUbc + " Kg");
                $('#average').html(data.data.average + " Kg");

                if (myLineChart) {
                    myLineChart.destroy();
                }
                var o = $("#line-chart");
                myLineChart = new Chart(o, {
                    type: "line",
                    options: {
                        responsive: !0,
                        maintainAspectRatio: !1,
                        legend: { position: "none" },
                        hover: { mode: "label" },
                        scales: {
                            xAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Interval", padding: 10, },ticks: {
                                    padding: 10
                                } }],
                            yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "UBC (Kg)", padding: 10 },ticks: { padding: 10, beginAtZero: true}}],
                        },
                        title: { display: !0, text: "" },
                    },
                    data: {
                        labels: data.data.dataLine.label,
                        datasets: [
                            {
                                label: "Collection",
                                data: data.data.dataLine.qty,
                                lineTension: 0,
                                fill: !1,
                                lineTension: 0,
                                borderColor: "#00A5A8",
                                pointBorderColor: "#00A5A8",
                                pointBackgroundColor: "#FFF",
                                pointBorderWidth: 2,
                                pointHoverBorderWidth: 2,
                                pointRadius: 4,
                            },
                        ],
                    },
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>

@endpush
