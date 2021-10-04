@extends('template', ['user'=>$user])

@section('participants','active')

@section('content')
<?php use App\Http\Controllers\ParticipantController;?>
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Participant</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">Participant
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
                                    <h4 class="card-title">Participant Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewParticipant">Add New Participant</button>
{{--                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="importParticipant">Import Participant</button>--}}
                                        <a class="btn btn-info btn-min-width mr-1 mb-1 white" href="{{ url('downloadParticipants') }}">Download</a>
                                        @include('participant.modalImport')
                                        <div class="table-responsive">
                                            <table id="participantTable" class="table table-striped table-bordered zero-configuration" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant Name</th>
                                                        <th>Category</th>
                                                        <th>District</th>
                                                        <th>Transport Intensity</th>
                                                        <th>Joined Date</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant Name</th>
                                                        <th>Category</th>
                                                        <th>District</th>
                                                        <th>Transport Intensity</th>
                                                        <th>Joined Date</th>
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

      var table = $('#participantTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('participants.index') }}",
          columns: [
              {data: null},
              {data: 'participant_name', name: 'participant_name'},
              {data: 'category_name', name: 'category_name'},
              {data: 'district_name', name: 'district_name'},
              {data: 'intensity', name: 'intensity'},
              {data: 'joined_date', name: 'joined_date'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

      $('#importParticipant').click(function () {
          $('#participantImportModal').modal('show');
      });

      $('#saveBtnFormImport').click(function (e) {
          e.preventDefault();

          $.ajax({
              data: new FormData($("#participantFormImport")[0]),
              url: "{{ route('participants.importParticipant') }}",
              type: "POST",
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function (data) {
                  $('#participantFormImport').trigger("reset");
                  $('#participantImportModal').modal('hide');
                  table.draw();
              },
              error: function(req, err){ console.log('my message' + err); }
          });

      });

      $('#createNewParticipant').click(function () {

        var category_id = $(this).data('id');
        window.location.href = "{{ route('participants.createParticipant') }}";
      });


      $('body').on('click', '.editParticipant', function () {
        var participant_id = $(this).data('id');
        window.location.href = "{{ route('participants.index') }}" +'/' + participant_id +'/edit';

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
            data: $('#participantForm').serialize(),
            url: "{{ route('participants.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#participantForm').trigger("reset");
                $('#participantModal').modal('hide');
                table.draw();

            },
            error: function (data) {
                toastr.error('Gagal menambahkan data.');
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

      $('body').on('click', '.deleteParticipant', function () {

          var participant_id = $(this).data("id");
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
                        url: "{{ route('participants.store') }}"+'/'+participant_id,
                        success: function (data) {
                            toastr.options = {
                            "positionClass": "toast-bottom-right"
                        }
                        toastr.success('Participant berhasil dihapus.');
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
