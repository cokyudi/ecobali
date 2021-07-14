@extends('template', ['user'=>$user])
@section('regencies','active')
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
                                    <h4 class="card-title">Regency Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewRegency">Add New Regency</button>
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="importRegency">Import Regency</button>
                                        @include('regency.modal')
                                        @include('regency.modalImport')
                                        <div class="table-responsive">
                                            <table id="regencyTable" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Regency</th>
                                                        <th>Description</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Regency</th>
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

      var table = $('#regencyTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('regencies.index') }}",
          columns: [
              {data: null},
              {data: 'regency_name', name: 'regency_name'},
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

      $('#createNewRegency').click(function () {
          $('#saveBtn').val("create");
          $('#regency_id').val('');
          $('#regencyForm').trigger("reset");
          $('#modalHeading').html("Create New Regency");
          $('#regencyModal').modal('show');
      });

      $('#importRegency').click(function () {
          $('#regencyImportModal').modal('show');
      });

      $('#saveBtnFormImport').click(function (e) {
          e.preventDefault();

          $.ajax({
              data: new FormData($("#regencyFormImport")[0]),
              url: "{{ route('regencies.importRegency') }}",
              type: "POST",
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function (data) {
                  $('#regencyFormImport').trigger("reset");
                  $('#regencyImportModal').modal('hide');
                  table.draw();
              },
              error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
              }
          });

      });

      $('body').on('click', '.editRegency', function () {
        var regency_id = $(this).data('id');
        $.get("{{ route('regencies.index') }}" +'/' + regency_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Regency");
            $('#saveBtn').val("edit");
            $('#regencyModal').modal('show');
            $('#regency_id').val(data.id);
            $('#regency_name').val(data.regency_name);
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
            data: $('#regencyForm').serialize(),
            url: "{{ route('regencies.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#regencyForm').trigger("reset");
                $('#regencyModal').modal('hide');
                table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

      $('body').on('click', '.deleteRegency', function () {

          var regency_id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
              type: "DELETE",
              url: "{{ route('regencies.store') }}"+'/'+regency_id,
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
