@extends('template', ['user'=>$user])

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700 font-medium-3" href="{{url('sales')}}">Sales</a>
    </li>
@endpush
@push('css_extend')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush
@section('sales','active')
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h4 class="card-title">Sales Data Master</h4>
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
                                    <div class="card-body card-dashboard">
                                        @if ($user['role'] == 'Admin')
                                    <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewSales">Add New Sales</button>
                                        @endif
                                            <a class="btn btn-info btn-min-width mr-1 mb-1 white" href="{{ url('downloadSales') }}">Download</a>
                                            <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" href="javascript:void(0)" id="downloadSalesBtn">Download Sales</button>

                                            @include('sale.modal')

                                        <div class="table-responsive">
                                            <table id="test" class="table table-striped table-bordered zero-configuration" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Date</th>
                                                        <th>Papermill</th>
                                                        <th>Delivered to <br>Papermill <br>(Kg)</th>
                                                        <th>Weighing scale <br>Gap ecoBali <br>(Kg)</th>
                                                        <th>Weighing <br>scale Gap <br>ecoBali (%)</th>
                                                        <th>Received at <br>Papermill <br>(Kg)</th>
                                                        <th>Total MCC <br>(Kg)</th>
                                                        <th>Total MCC <br>(%)</th>
                                                        <th>Total <br>Weight <br>Accepted (Kg)</th>
                                                        @if ($user['role'] == 'Admin')
                                                            <th width="130px">Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Date</th>
                                                        <th>Papermill</th>
                                                        <th>Delivered to <br>Papermill <br>(Kg)</th>
                                                        <th>Weighing scale <br>Gap ecoBali <br>(Kg)</th>
                                                        <th>Weighing <br>scale Gap <br>ecoBali (%)</th>
                                                        <th>Received at <br>Papermill <br>(Kg)</th>
                                                        <th>Total MCC <br>(Kg)</th>
                                                        <th>Total MCC <br>(%)</th>
                                                        <th>Total <br>Weight <br>Accepted (Kg)</th>
                                                        @if ($user['role'] == 'Admin')
                                                            <th width="130px">Action</th>
                                                        @endif
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
        <!-- END: Content -->
        <!-- BEGIN: Customizer-->
        <div id="customizer-filter" class="customizer border-left-blue-grey border-left-lighten-4 "><a class="customizer-close" href="#"><i class="ft-x font-medium-2"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
                <h5 class="text-uppercase mb-0">Data Filter Customizer</h5>
                <hr>

                <form id="filterForm" name="filterForm">

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
                        <button id="filterBtn" value="create" type="button" class="btn btn-success">
                            <i class="la la-check-square-o"></i> Filter
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <!-- End: Customizer-->
        @endsection

@push('ajax_crud')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                drops: 'down',
            },
            function(start, end) {

            }
        );

        $('#icon-calendar').click(function() {
            $("#daterange").focus();
        });

        $('#backBtn').click(function() {

            $('#daterange').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
            $('#daterange').data('daterangepicker').setEndDate(moment());

            $('#id_papermill').val(null).trigger('change');
            getSalesByFilter();

        });


        $('#filterBtn').click(function() {
            getSalesByFilter();
        });
    });

    function getSalesByFilter() {
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var id_papermill = $('#id_papermill').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            id_papermill: id_papermill,
        }

        var role = '{{$user['role']}}';
        var table;

        if(role == "Admin") {
            table = $('#test').DataTable({
                bDestroy: true,
                processing: true,
                serverSide: true,
                order: [[1, "desc"]],
                ajax: {
                    url: "{{ route('sales.index') }}",
                    data: function (d) {
                        d.param = params;
                    }
                },
                columns: [
                    {data: null},
                    {
                        name: 'sale_date.timestamp',
                        data: {
                            _: 'sale_date.display',
                            sort: 'sale_date.timestamp'
                        }
                    },
                    {data: 'papermill_name', name: 'papermill_name'},
                    {data: 'delivered_to_papermill', name: 'delivered_to_papermill'},
                    {data: 'weighing_scale_gap_eco', name: 'weighing_scale_gap_eco'},
                    {data: 'weighing_scale_gap_eco_percent', name: 'weighing_scale_gap_eco_percent'},
                    {data: 'received_at_papermill', name: 'received_at_papermill'},
                    {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                    {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                    {data: 'total_weight_accepted', name: 'total_weight_accepted'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        } else {
            table = $('#test').DataTable({
                bDestroy: true,
                processing: true,
                serverSide: true,
                order: [[1, "desc"]],
                ajax: {
                    url: "{{ route('sales.index') }}",
                    data: function (d) {
                        d.param = params;
                    }
                },
                columns: [
                    {data: null},
                    {
                        name: 'sale_date.timestamp',
                        data: {
                            _: 'sale_date.display',
                            sort: 'sale_date.timestamp'
                        }
                    },
                    {data: 'papermill_name', name: 'papermill_name'},
                    {data: 'delivered_to_papermill', name: 'delivered_to_papermill'},
                    {data: 'weighing_scale_gap_eco', name: 'weighing_scale_gap_eco'},
                    {data: 'weighing_scale_gap_eco_percent', name: 'weighing_scale_gap_eco_percent'},
                    {data: 'received_at_papermill', name: 'received_at_papermill'},
                    {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                    {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                    {data: 'total_weight_accepted', name: 'total_weight_accepted'},
                ]
            });
        }

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    }

    $(function () {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

    var role = '{{$user['role']}}';
    var table;
    if(role == "Admin") {
        table = $('#test').DataTable({
            processing: true,
            serverSide: true,
            order: [[1, "desc"]],
            ajax: "{{ route('sales.index') }}",
            columns: [
                {data: null},
                {
                    name: 'sale_date.timestamp',
                    data: {
                        _: 'sale_date.display',
                        sort: 'sale_date.timestamp'
                    }
                },
                {data: 'papermill_name', name: 'papermill_name'},
                {data: 'delivered_to_papermill', name: 'delivered_to_papermill'},
                {data: 'weighing_scale_gap_eco', name: 'weighing_scale_gap_eco'},
                {data: 'weighing_scale_gap_eco_percent', name: 'weighing_scale_gap_eco_percent'},
                {data: 'received_at_papermill', name: 'received_at_papermill'},
                {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                {data: 'total_weight_accepted', name: 'total_weight_accepted'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    } else {
        table = $('#test').DataTable({
            processing: true,
            serverSide: true,
            order: [[1, "desc"]],
            ajax: "{{ route('sales.index') }}",
            columns: [
                {data: null},
                {
                    name: 'sale_date.timestamp',
                    data: {
                        _: 'sale_date.display',
                        sort: 'sale_date.timestamp'
                    }
                },
                {data: 'papermill_name', name: 'papermill_name'},
                {data: 'delivered_to_papermill', name: 'delivered_to_papermill'},
                {data: 'weighing_scale_gap_eco', name: 'weighing_scale_gap_eco'},
                {data: 'weighing_scale_gap_eco_percent', name: 'weighing_scale_gap_eco_percent'},
                {data: 'received_at_papermill', name: 'received_at_papermill'},
                {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                {data: 'total_weight_accepted', name: 'total_weight_accepted'},
            ]
        });
    }

    table.on('draw.dt', function () {
        var info = table.page.info();
        table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + info.start;
        });
    });

    $('body').on('click', '.editSale', function () {
        var sales_id = $(this).data('id');
        $.get("{{ route('sales.index') }}" +'/' + sales_id +'/edit', function (data) {
            $('.salesDetail').show();
            $('#modalHeading').html("Edit Sales");
            $('#saveBtn').val("edit");
            $('#salesModal').modal('show');
            $('#sales_id').val(data.id);
            $('#sale_date').val(data.sale_date);
            $('#collected_d_min_1').val(data.collected_d_min_1);
            $('#delivered_to_papermill').val(data.delivered_to_papermill);
            $('#weighing_scale_gap_eco').val(data.weighing_scale_gap_eco);
            $('#weighing_scale_gap_eco_percent').val(data.weighing_scale_gap_eco_percent);
            $("#id_papermill").val(data.id_papermill).trigger("change");
            $('#received_at_papermill').val(data.received_at_papermill);
            $('#weighing_scale_gap_papermill').val(data.weighing_scale_gap_papermill);
            $('#weighing_scale_gap_papermill_percent').val(data.weighing_scale_gap_papermill_percent);
            $('#moisture_content_and_contaminant').val(data.moisture_content_and_contaminant);
            $('#moisture_content_and_contaminant_percent').val(data.moisture_content_and_contaminant_percent);
            $('#deduction').val(data.deduction);
            $('#deduction_percent').val(data.deduction_percent);
            $('#total_weight_accepted').val(data.total_weight_accepted);
            $('#created_by').val(data.created_by);
            $('#created_datetime').val(data.created_datetime);
            $('#last_modified_by').val(data.last_modified_by);
            $('#last_modified_datetime').val(data.last_modified_datetime);
        })
    });

    $('#createNewSales').click(function () {
        $('#saveBtn').val("create");
        $('#sales_id').val('');
        $('#salesForm').trigger("reset");
        $('#modalHeading').html("Create New Sales");
        $('#salesModal').modal('show');
        $('.salesDetail').hide();

    });

    $('body').on('click', '.deleteSale', function () {
        var sales_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('sales.store') }}"+'/'+sales_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#saveBtn').click(function (e) {
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
            data: $('#salesForm').serialize(),
            url: "{{ route('sales.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#salesForm').trigger("reset");
                $('#salesModal').modal('hide');
                table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    $('#downloadSalesBtn').click(function (e) {
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idPapermill = $('#id_papermill').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            id_papermills : idPapermill,
        }

        var url = "{{URL::to('downloadSales')}}?" + $.param(params)

        window.location = url;
    });

});

</script>

@endpush
