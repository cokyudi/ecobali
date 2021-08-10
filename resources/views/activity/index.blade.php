@extends('template', ['user'=>$user])
@section('activities','active')
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Activities</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Data Master</a>
                                </li>
                                <li class="breadcrumb-item active">Activities
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
                                    <h4 class="card-title">Activities Data Master</h4>
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
                                    <!-- <a class="btn btn-success" href="javascript:void(0)" id="createNewDistrict"> Create New Book</a> -->
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewActivity">Add New Activity</button>
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="importActivity">Import Activity</button>
                                        @include('activity.modal')
                                        @include('activity.modalImport')
                                        <div class="table-responsive">
                                            <table id="tableActivity" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Date</th>
                                                        <th>Program Name</th>
                                                        <th>Activity</th>
                                                        <th>Location</th>
                                                        <th>Number of Participant </th>
                                                        <th width="150px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Date</th>
                                                        <th>Program Name</th>
                                                        <th>Activity</th>
                                                        <th>Location</th>
                                                        <th>Number of Participant </th>
                                                        <th width="150px">Action</th>
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

    var table = $('#tableActivity').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('activities.index') }}",
        columns: [
            {data: null},
            {data: 'activity_date', name: 'activity_date'},
            {data: 'activity_program_name', name: 'activity_program_name'},
            {data: 'activity', name: 'activity'},
            {data: 'location', name: 'location'},
            {data: 'participant_number', name: 'participant_number'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    table.on('draw.dt', function () {
        var info = table.page.info();
        table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + info.start;
        });
    });

    $('#importActivity').click(function () {
        $('#activtyImportModal').modal('show');
    });

    $('#saveBtnFormImport').click(function (e) {
        e.preventDefault();

        $.ajax({
            data: new FormData($("#activityFormImport")[0]),
            url: "{{ route('activities.importActivity') }}",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                $('#activityFormImport').trigger("reset");
                $('#activtyImportModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });


    $('body').on('click', '.editActivity', function () {
        var activity_id = $(this).data('id');
        $.get("{{ route('activities.index') }}" +'/' + activity_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Activity");
            $('#saveBtn').val("edit");
            $('#activityModal').modal('show');
            $('#activity_id').val(data.id);
            $('#activity_date').val(data.activity_date);
            $('#activity').val(data.activity);
            $("#id_program_activity").val(data.id_program_activity).trigger("change");
            $('#location').val(data.location);
            $("#id_category").val(data.id_category).trigger("change");
            $("#id_district").val(data.id_district).trigger("change");
            $("#id_regency").val(data.id_regency).trigger("change");
            $('#participant_number').val(data.participant_number);
            $('#created_by').val(data.created_by);
            $('#created_datetime').val(data.created_datetime);
            $('#last_modified_by').val(data.last_modified_by);
            $('#last_modified_datetime').val(data.last_modified_datetime);
        })
    });

    $('#createNewActivity').click(function () {
        $('#saveBtn').val("create");
        $('#activity_id').val('');
        $('#activityForm').trigger("reset");
        $('#modalHeading').html("Create New Activity");
        $('#activityModal').modal('show');

    });

    $('body').on('click', '.deleteActivity', function () {
        var activity_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('activities.store') }}"+'/'+activity_id,
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
            data: $('#activityForm').serialize(),
            url: "{{ route('activities.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#activityForm').trigger("reset");
                $('#activityModal').modal('hide');
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
