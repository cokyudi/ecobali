@extends('template', ['user'=>$user])
@section('sales','active')
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Sales</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data Master</a>
                                </li>
                                <li class="breadcrumb-item active">Sales
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <a class="btn btn-info btn-min-width mr-1 mb-1 white" hidden href="{{ url('downloadSales') }}">Download</a>
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
                                                        <th>Total MCC <br>(Kg)</th>
                                                        <th>Total MCC <br>(%)</th>
                                                        <th>Received at <br>Papermill <br>(Kg)</th>
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
                                                        <th>Total MCC <br>(Kg)</th>
                                                        <th>Total MCC <br>(%)</th>
                                                        <th>Received at <br>Papermill <br>(Kg)</th>
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
        @endsection

@push('ajax_crud')
<script type="text/javascript">
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
                {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                {data: 'received_at_papermill', name: 'received_at_papermill'},
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
                {data: 'moisture_content_and_contaminant', name: 'moisture_content_and_contaminant'},
                {data: 'moisture_content_and_contaminant_percent', name: 'moisture_content_and_contaminant_percent'},
                {data: 'received_at_papermill', name: 'received_at_papermill'},
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

});
</script>

@endpush
