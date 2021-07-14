@extends('template', ['user'=>$user])
@section('districts','active')
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic DataTables</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">DataTables</a>
                                </li>
                                <li class="breadcrumb-item active">Basic DataTables
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
                                    <h4 class="card-title">District Location Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewDistrict">Add New District</button>
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="importDistrict">Import District</button>
                                        @include('district.modal')
                                        @include('district.modalImport')
                                        <div class="table-responsive">
                                            <table id="districtTable" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>District</th>
                                                        <th>Description</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>District</th>
                                                        <th>Description</th>
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
  $(function () {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var table = $('#districtTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('districts.index') }}",
          columns: [
              {data: null},
              {data: 'district_name', name: 'district_name'},
              {data: 'description', name: 'description'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

      $('#importDistrict').click(function () {
          $('#districtImportModal').modal('show');
      });

      $('#saveBtnFormImport').click(function (e) {
          e.preventDefault();

          $.ajax({
              data: new FormData($("#districtFormImport")[0]),
              url: "{{ route('districts.importDistrict') }}",
              type: "POST",
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function (data) {
                  $('#districtFormImport').trigger("reset");
                  $('#districtImportModal').modal('hide');
                  table.draw();
              },
              error: function(xhr, status, error) {
                  console.log('Error:', data);
              }
          });

      });

      $('#createNewDistrict').click(function () {
          $('#saveBtn').val("create");
          $('#district_id').val('');
          $('#districtForm').trigger("reset");
          $('#modalHeading').html("Create New District");
          $('#districtModal').modal('show');
      });

      $('body').on('click', '.editDistrict', function () {
        var district_id = $(this).data('id');
        $.get("{{ route('districts.index') }}" +'/' + district_id +'/edit', function (data) {
            $('#modalHeading').html("Edit District");
            $('#saveBtn').val("edit");
            $('#districtModal').modal('show');
            $('#district_id').val(data.id);
            $('#district_name').val(data.district_name);
            $('#description').val(data.description);
            $('#created_by').val(data.created_by);
            $('#created_datetime').val(data.created_datetime);
            $('#last_modified_by').val(data.last_modified_by);
            $('#last_modified_datetime').val(data.last_modified_datetime);
        })
     });

      $('#saveBtn').click(function (e) {
          e.preventDefault();
          if ($('#saveBtn').val() == "create")  {
              $('#created_by').val("Deva Dwi A");
              $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
              $('#last_modified_by').val(null);
              $('#last_modified_datetime').val(null);
          } else {
             $('#created_by').val("Deva Dwi A");
              $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
              $('#last_modified_by').val("Deva Dwi A Edit");
              $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
          }
          $(this).html('Save');

          $.ajax({
            data: $('#districtForm').serialize(),
            url: "{{ route('districts.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#districtForm').trigger("reset");
                $('#districtModal').modal('hide');
                table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

      $('body').on('click', '.deleteDistrict', function () {

          var district_id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
              type: "DELETE",
              url: "{{ route('districts.store') }}"+'/'+district_id,
              success: function (data) {
                  table.draw();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });

    });
</script>

@endpush
