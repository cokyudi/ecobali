@extends('template', ['user'=>$user])

@section('collections','active')
@push('css_extend')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush
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
                                    <h4 class="card-title">Collection Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewCollection">Add New Collection</button>
                                        @endif
                                        <a class="btn btn-info btn-min-width mr-1 mb-1 white" hidden href="{{ url('downloadCollections') }}">Download</a>
                                        @include('collection.modal')
                                        @include('collection.modalImport')
                                        <div class="table-responsive">
                                            <table id="collectionTable" class="table table-striped table-bordered zero-configuration" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant Name</th>
                                                        <th>Category</th>
                                                        <th>Regency</th>
                                                        <th>KMK</th>
                                                        <th>Collect Date</th>
                                                        @if ($user['role'] == 'Admin')
                                                            <th width="180px">Action</th>
                                                        @endif

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant Name</th>
                                                        <th>Category</th>
                                                        <th>Regency</th>
                                                        <th>KMK</th>
                                                        <th>Collect Date</th>
                                                        @if ($user['role'] == 'Admin')
                                                        <th width="180px">Action</th>
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
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
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
          table = $('#collectionTable').DataTable({
              processing: true,
              serverSide: true,
              order: [[5, "desc"]],
              ajax: "{{ route('collections.index') }}",
              columns: [
                  {data: null},
                  {data: 'participant_name', name: 'participant_name'},
                  {data: 'category_name', name: 'category_name'},
                  {data: 'regency_name', name: 'regency_name'},
                  {data: 'quantity', name: 'quantity'},
                  {
                      name: 'collect_date.timestamp',
                      data: {
                          _: 'collect_date.display',
                          sort: 'collect_date.timestamp'
                      }
                  },
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
      } else {
          table = $('#collectionTable').DataTable({
              processing: true,
              serverSide: true,
              order: [[5, "desc"]],
              ajax: "{{ route('collections.index') }}",
              columns: [
                  {data: null},
                  {data: 'participant_name', name: 'participant_name'},
                  {data: 'category_name', name: 'category_name'},
                  {data: 'regency_name', name: 'regency_name'},
                  {data: 'quantity', name: 'quantity'},
                  {
                      name: 'collect_date.timestamp',
                      data: {
                          _: 'collect_date.display',
                          sort: 'collect_date.timestamp'
                      }
                  },
              ]
          });
      }


      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

      $('#createNewCollection').click(function () {
          $('#saveBtn').val("create");
          $('#collection_id').val('');
          $('#collectionForm').trigger("reset");
          $('#modalHeading').html("Create New Collection");
          $('#collectionModal').modal('show');
      });

      $('#importCollection').click(function () {
          $('#collectionImportModal').modal('show');
      });

      $('#saveBtnFormImport').click(function (e) {
          e.preventDefault();

          $.ajax({
              data: new FormData($("#collectionFormImport")[0]),
              url: "{{ route('collections.importCollection') }}",
              type: "POST",
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function (data) {
                  $('#collectionFormImport').trigger("reset");
                  $('#collectionImportModal').modal('hide');
                  table.draw();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });

      });


      $('body').on('click', '.editCollection', function () {
        var collection_id = $(this).data('id');
        $.get("{{ route('collections.index') }}" +'/' + collection_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Collection");
            $('#saveBtn').val("edit");
            $('#collectionModal').modal('show');
            $('#collection_id').val(data.id);
            $("#participant_id").val(data.id_participant).trigger("change");
            $('#quantity').val(data.quantity);
            $('#collect_date').val(data.collect_date);
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
              $('#last_modified_by').val("Deva Dwi A Edit");
              $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
          }
          $(this).html('Save');

          $.ajax({
            data: $('#collectionForm').serialize(),
            url: "{{ route('collections.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#collectionForm').trigger("reset");
                $('#collectionModal').modal('hide');
                table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

      $('body').on('click', '.deleteCollection', function () {

          var collection_id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
              type: "DELETE",
              url: "{{ route('collections.store') }}"+'/'+collection_id,
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
