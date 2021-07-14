@extends('template', ['user'=>$user])
@section('categories','active')
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
                    
                        <div class="col-5">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Category Data</h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>This is the detail about the Category.</p>
                                        </div>
                                        
                                        <form class="form" id="categoryEditForm">
                                            <div class="form-body">
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <input type="hidden" id="category_id" name="category_id" value="{{ $category->id }}">
                                                        <input type="hidden" id="created_by" name="created_by" value="{{ $category->created_by }}">
                                                        <input type="hidden" id="created_datetime" name="created_datetime" value="{{ $category->created_datetime }}">
                                                        <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                                                        <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                                                        <div class="form-group">
                                                            <label for="category_name">Category Name</label>
                                                            <input type="text" id="category_name" class="form-control" placeholder="Category Name" name="category_name" maxlength="50" value="{{ $category->category_name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Category Description</label>
                                                            <input type="text" id="description" class="form-control" placeholder="Category Description" rows="3" name="description"  maxlength="200" value="{{ $category->description }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-outline-primary" id="saveBtn">Save Changes</button>
                                                        <button type="button" class="btn btn-primary ml-2" href="javascript:void(0)" id="backButton">Go Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card h-100" >
                                <div class="card-header pb-0">
                                    <h4 class="card-title" id="categoryTitle">Categories Data</h4>
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
                                    <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewTarget">Add New Target</button>
                                        @include('category.target')
                                        <div class="table-responsive">
                                            <table id="targetYear" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Year</th>
                                                        <th>Target</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th width="30px">No</th>
                                                        <th>Year</th>
                                                        <th>Target</th>
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
  
    var links = "{{ route('categoryDetails.index') }}"+'/'+$('#category_id').val();
    var table = $('#targetYear').DataTable({
          processing: true,
          serverSide: true,
          ajax: links,
          columns: [
              {data: null},
              {data: 'year', name: 'year'},
              {data: 'target', name: 'target'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
  
      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
  

      $('#backButton').click(function () {
            window.location.href = "{{ route('categories.index') }}";
      });
  
     $('#saveBtn').click(function (e) {
        e.preventDefault();
       
        $('#last_modified_by').val("Deva Dwi A Edit");
        $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
    
        $.ajax({
            data: $('#categoryEditForm').serialize(),
            url: "{{ route('categories.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
        
                // $('#categoryForm').trigger("reset");
                // $('#categoryModal').modal('hide');
                table.draw();
            
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    $('#createNewTarget').click(function () {
          $('#saveTargetBtn').val("create");
          $('#category_detail_id').val('');
          $('#categoryTargetForm').trigger("reset");
          $('#modalHeadingTarget').html("Create New Target");
          $('#categoryTargetModal').modal('show');
    });

    $('#saveTargetBtn').click(function (e) {
          e.preventDefault();
          if ($('#saveTargetBtn').val() == "create")  {
              $('#created_by_target').val("Deva Dwi A");
              $('#created_datetime_target').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
              $('#last_modified_by_target').val(null);
              $('#last_modified_datetime_target').val(null);
          } else {
              $('#last_modified_by_target').val("Deva Dwi A Edit");
              $('#last_modified_datetime_target').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
          }
          $(this).html('Save');
      
          $.ajax({
            data: $('#categoryTargetForm').serialize(),
            url: "{{ route('categoryDetails.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#categoryTargetForm').trigger("reset");
                $('#categoryTargetModal').modal('hide');
                table.draw();
           
            },
            // error: function (data) {
            //     console.log('Error:', data.responseJSON.errors.category_id);
            //     $('#saveBtn').html('Save Changes');
            // }
            error: function ( jqXhr, json, errorThrown ) {
                var errors = jqXhr.responseJSON;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>'; 
                });
                console.log('Error:', errors.message);
            }
            
        });
       
      });

      $('body').on('click', '.editCategoryDetail', function () {
        var categoryDetail_id = $(this).data('id');
        $.get("{{ route('categoryDetails.index') }}" +'/' + categoryDetail_id +'/edit', function (data) {
            $('#modalHeadingTarget').html("Edit Target");
            $('#saveTargetBtn').val("edit");
            $('#categoryTargetModal').modal('show');
            $('#category_detail_id').val(data.id);
            $('#year').val(data.year);
            $('#target').val(data.target);
            $('#created_by_target').val(data.created_by);
            $('#created_datetime_target').val(data.created_datetime);
            $('#last_modified_by_target').val(data.last_modified_by);
            $('#last_modified_datetime_target').val(data.last_modified_datetime);
        })
     });
      
      $('body').on('click', '.deleteCategoryDetail', function () {
       
          var categoryDetail_id = $(this).data("id");
          confirm("Are You sure want to delete !");
        
          $.ajax({
              type: "DELETE",
              url: "{{ route('categoryDetails.store') }}"+'/'+categoryDetail_id,
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