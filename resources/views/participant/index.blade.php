@extends('template')

@section('participants','active')

@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Participant</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
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
										
                                        @include('participant.modal')
                                        <div class="table-responsive">
                                            <table id="participantTable" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant</th>
                                                        <th>Category</th>
                                                        <th>Joined Date</th>
                                                        <th>District</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Participant</th>
                                                        <th>Category</th>
                                                        <th>Joined Date</th>
                                                        <th>District</th>
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
              {data: 'id_category', name: 'id_category'},
              {data: 'joined_date', name: 'joined_date'},
              {data: 'id_district', name: 'id_district'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  
      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
  
      $('#createNewParticipant').click(function () {
          $('#saveBtn').val("create");
          $('#participant_id').val('');
          $('#participantForm').trigger("reset");
          $('#modalHeading').html("Create New Participant");
          $('#participantModal').modal('show');
      });
  
      $('body').on('click', '.editParticipant', function () {
        var participant_id = $(this).data('id');
        $.get("{{ route('participants.index') }}" +'/' + participant_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Participant");
            $('#saveBtn').val("edit");
            $('#participantModal').modal('show');
            $('#participant_id').val(data.id);
            $('#participant_name').val(data.participant_name);
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
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });
      
      $('body').on('click', '.deleteParticipant', function () {
       
          var participant_id = $(this).data("id");
          confirm("Are You sure want to delete !");
        
          $.ajax({
              type: "DELETE",
              url: "{{ route('participants.store') }}"+'/'+participant_id,
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