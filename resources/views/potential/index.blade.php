@extends('template', ['user'=>$user])

@section('potentials','active')
@push('css_extend')
    <style type="text/css">
        label.error {
            color: red !important;
            text-transform: none !important;
            font-weight: normal !important;
        }
    </style>
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Category Potential</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('potentials')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">Category Potential
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
                                    <h4 class="card-title">Category Potential Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewPotential">Add New Potential</button>
                                        @include('potential.modal')

                                        <div class="table-responsive">
                                            <table id="potentialTable" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th width="30px">No</th>
                                                    <th>Category</th>
                                                    <th>Low</th>
                                                    <th>Medium</th>
                                                    <th>High</th>
                                                    <th width="250px">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th width="30px">No</th>
                                                    <th>Category</th>
                                                    <th>Low</th>
                                                    <th>Medium</th>
                                                    <th>High</th>
                                                    <th width="250px">Action</th>
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
        $(document).ready(function(e) {
            var form = $("#potentialForm");
            form.validate();
        });

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#potentialTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('potentials.index') }}",
                columns: [
                    {data: null},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'potential_low', name: 'potential_low'},
                    {data: 'potential_medium', name: 'potential_medium'},
                    {data: 'potential_high', name: 'potential_high'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            table.on('draw.dt', function () {
                var info = table.page.info();
                table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });

            $('#createNewPotential').click(function () {
                $('#saveBtn').val("create");
                $('#potential_id').val('');
                $('#potentialForm').trigger("reset");
                $('#modalHeading').html("Create New Potential");
                $('#potentialModal').modal('show');
            });

            $('body').on('click', '.editPotential', function () {
                var potential_id = $(this).data('id');
                $.get("{{ route('potentials.index') }}" +'/' + potential_id +'/edit', function (data) {
                    $('#modalHeading').html("Edit Potential");
                    $('#saveBtn').val("edit");
                    $('#potentialModal').modal('show');
                    $('#potential_id').val(data.id);
                    $('#id_category').val(data.id_category);
                    $('#potential_low').val(data.potential_low);
                    $('#potential_medium').val(data.potential_medium);
                    $('#potential_high').val(data.potential_high);
                    $('#created_by').val(data.created_by);
                    $('#created_datetime').val(data.created_datetime);
                    $('#last_modified_by').val(data.last_modified_by);
                    $('#last_modified_datetime').val(data.last_modified_datetime);
                })
            });

            $('#saveBtn').click(function (e) {
                if ($('#potentialForm').valid()) {
                    e.preventDefault();
                    if ($('#saveBtn').val() == "create")  {
                        $('#created_by').val("Deva Dwi A");
                        $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                        $('#last_modified_by').val(null);
                        $('#last_modified_datetime').val(null);
                        var alertMessage = 'Potential berhasil ditambahkan.';
                    } else {
                        $('#last_modified_by').val("Deva Dwi A Edit");
                        $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                        var alertMessage = 'Potential berhasil di edit.';
                    }
                    $(this).html('Save');

                    $.ajax({
                        data: $('#potentialForm').serialize(),
                        url: "{{ route('potentials.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#potentialForm').trigger("reset");
                            $('#potentialModal').modal('hide');
                            toastr.options = {
                                "positionClass": "toast-bottom-right"
                            };
                            toastr.success(alertMessage);
                            table.draw();

                        },
                        error: function (data) {
                            console.log('Error:', data);
                            toastr.error('Gagal menambahkan data.');
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }

            });


            $('body').on('click', '.deletePotential', function () {
                var potential_id = $(this).data("id");
                swal({
                    title: "Are you sure?",
                    text: "Apakah anda yakin untuk menghapus data ini ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route('potentials.store') }}"+'/'+potential_id,
                                success: function (data) {
                                    toastr.options = {
                                        "positionClass": "toast-bottom-right"
                                    }
                                    toastr.success('Potential berhasil dihapus.');
                                    table.draw();
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });
                        } else {}
                    });

            });

        });
    </script>

@endpush
