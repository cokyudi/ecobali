@extends('template', ['user'=>$user])

@section('papermills','active')

@section('content')
<?php use App\Http\Controllers\PapermillController;?>
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Papermill</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('papermills')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">Papermill
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
                                    <h4 class="card-title">Papermill Data Master</h4>
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
                                        <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="createNewPapermill">Add New Papermill</button>
                                        <div class="table-responsive">
                                            <table id="papermillTable" class="table table-striped table-bordered zero-configuration" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Papermill Name</th>
                                                        <th>Category</th>
                                                        <th>District</th>
                                                        <th>Regency</th>
                                                        <th width="250px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="30px">No</th>
                                                        <th>Papermill Name</th>
                                                        <th>Category</th>
                                                        <th>District</th>
                                                        <th>Regency</th>
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

      var table = $('#papermillTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('papermills.index') }}",
          columns: [
              {data: null},
              {data: 'papermill_name', name: 'papermill_name'},
              {data: 'papermill_category_name', name: 'papermill_category_name'},
              {data: 'district_name', name: 'district_name'},
              {data: 'regency_name', name: 'regency_name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

      $('#createNewPapermill').click(function () {
        window.location.href = "{{ route('papermills.createPapermill') }}";
      });


      $('body').on('click', '.editPapermill', function () {
        var papermill_id = $(this).data('id');
        window.location.href = "{{ route('papermills.index') }}" +'/' + papermill_id +'/edit';
      });

      $('body').on('click', '.deletePapermill', function () {

          var papermill_id = $(this).data("id");
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
                        url: "{{ route('papermills.store') }}"+'/'+papermill_id,
                        success: function (data) {
                            toastr.options = {
                                "positionClass": "toast-bottom-right"
                            }
                            toastr.success('Papermill berhasil dihapus.');
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
