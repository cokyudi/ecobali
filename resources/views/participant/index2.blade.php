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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Participant Information Detail</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs nav-left nav-border-left">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baseVerticalLeft1-tab1" data-toggle="tab" aria-controls="tabVerticalLeft11" href="#tabVerticalLeft11" aria-expanded="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft1-tab2" data-toggle="tab" aria-controls="tabVerticalLeft12" href="#tabVerticalLeft12" aria-expanded="false">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft1-tab3" data-toggle="tab" aria-controls="tabVerticalLeft13" href="#tabVerticalLeft13" aria-expanded="false">About</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-1">
                                    <div role="tabpanel" class="tab-pane active" id="tabVerticalLeft11" aria-expanded="true" aria-labelledby="baseVerticalLeft1-tab1">
                                        <p>Oat cake marzipan cake lollipop caramels wafer pie jelly beans. Icing halvah chocolate cake carrot cake. Jelly beans carrot cake marshmallow gingerbread chocolate cake. Gummies cupcake croissant.</p>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft12" aria-labelledby="baseVerticalLeft1-tab2">
                                        <p>Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy oat cake fruitcake jelly chupa chups. Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.</p>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft13" aria-labelledby="baseVerticalLeft1-tab3">
                                        <p>Biscuit ice cream halvah candy canes bear claw ice cream cake chocolate bar donut. Toffee cotton candy liquorice. Oat cake lemon drops gingerbread dessert caramels. Sweet dessert jujubes powder sweet sesame snaps.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
  
      var table = $('#areaTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('areas.index') }}",
          columns: [
              {data: null},
              {data: 'area_name', name: 'area_name'},
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
  
      $('#createNewArea').click(function () {
          $('#saveBtn').val("create");
          $('#area_id').val('');
          $('#areaForm').trigger("reset");
          $('#modalHeading').html("Create New Area");
          $('#areaModal').modal('show');
      });
  
      $('body').on('click', '.editArea', function () {
        var area_id = $(this).data('id');
        $.get("{{ route('areas.index') }}" +'/' + area_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Area");
            $('#saveBtn').val("edit");
            $('#areaModal').modal('show');
            $('#area_id').val(data.id);
            $('#area_name').val(data.area_name);
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
            data: $('#areaForm').serialize(),
            url: "{{ route('areas.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
       
                $('#areaForm').trigger("reset");
                $('#areaModal').modal('hide');
                table.draw();
           
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });
      
      $('body').on('click', '.deleteArea', function () {
       
          var area_id = $(this).data("id");
          confirm("Are You sure want to delete !");
        
          $.ajax({
              type: "DELETE",
              url: "{{ route('areas.store') }}"+'/'+area_id,
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