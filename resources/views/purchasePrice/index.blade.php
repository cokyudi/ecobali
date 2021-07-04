@extends('template')
@section('purchasePrices','active')
@push('ajax_crud')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}"> -->
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
                                    <h4 class="card-title">Purchase Price Data Master</h4>
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
                                    <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewPurchasePrice">Add New Purchase Price</button>
										
                                        @include('purchasePrice.modal')
                                        <div class="table-responsive">
                                            <table id="purchasePriceTable" class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Purchase Price</th>
                                                        <th>Description</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Purchase Price</th>
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
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/scripts/forms/validation/form-validation.js')}}"></script>
<script type="text/javascript">
  $(function () {
      
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
  
      var table = $('#purchasePriceTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('purchasePrices.index') }}",
          columns: [
              {data: null},
              {data: 'price', render: $.fn.dataTable.render.number(',','.',0,'Rp. ')},
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
  
      $('#createNewPurchasePrice').click(function () {
          $('#saveBtn').val("create");
          $('#purchasePrice_id').val('');
          $('#purchasePriceForm').trigger("reset");
          $('#modalHeading').html("Create New Purchase Price");
          $('#purchasePriceModal').modal('show');
      });
  
      $('body').on('click', '.editPurchasePrice', function () {
        var purchasePrice_id = $(this).data('id');
        $.get("{{ route('purchasePrices.index') }}" +'/' + purchasePrice_id +'/edit', function (data) {
            $('#modalHeading').html("Edit Purchase Price");
            $('#saveBtn').val("edit");
            $('#purchasePriceModal').modal('show');
            $('#purchasePrice_id').val(data.id);
            $('#price').val(data.price);
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
            data: $('#purchasePriceForm').serialize(),
            url: "{{ route('purchasePrices.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
       
                $('#purchasePriceForm').trigger("reset");
                $('#purchasePriceModal').modal('hide');
                table.draw();
           
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });
      
      $('body').on('click', '.deletePurchasePrice', function () {
       
          var purchasePrice_id = $(this).data("id");
          confirm("Are You sure want to delete !");
        
          $.ajax({
              type: "DELETE",
              url: "{{ route('purchasePrices.store') }}"+'/'+purchasePrice_id,
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