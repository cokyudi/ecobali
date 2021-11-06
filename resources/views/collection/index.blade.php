@extends('template', ['user'=>$user])

@section('collections','active')

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700 font-medium-4" href="{{url('collections')}}">Collection</a>
    </li>
@endpush
@push('css_extend')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">

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
{{--                                            <button type="button" class="btn btn-success btn-min-width mr-1 mb-1" href="javascript:void(0)" id="importCollection">Import Participant</button>--}}
                                        @endif
                                        <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" href="javascript:void(0)" id="downloadCollectionBtn">Download</button>

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

        <!-- BEGIN: Customizer-->
        <div id="customizer-filter" class="customizer border-left-blue-grey border-left-lighten-4 "><a class="customizer-close" href="#"><i class="ft-x font-medium-2"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
                <h5 class="text-uppercase mb-0">Data Filter Customizer</h5>
                <hr>

                <form id="filterForm" name="filterForm">
                    <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Participant</h6>
                    <div class="form-group ">
                        <select id="id_participant" name="id_participant[]" multiple="multiple" class="select2 form-control " data-placeholder="Select Participant">
                            @foreach($participants as $participant)
                                <option value="{{$participant->id}}">{{$participant->participant_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Category</h6>
                    <div class="form-group ">
                        <select id="id_category" name="id_category[]" multiple="multiple" class="select2 form-control" data-placeholder="Select Category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <h6 class="mt-1 mb-1 text-bold-500 font-small-3">District</h6>
                    <div class="form-group ">
                        <select id="id_district" name="id_district[]" multiple="multiple" class="select2 form-control" data-placeholder="Select District">
                            @foreach($districts as $district)
                                <option value="{{$district->id}}">{{$district->district_name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Regency</h6>
                    <div class="form-group ">
                        <div class="input-group">
                            <select class="select2 form-control" id="id_regency" name="id_regency[]" multiple="multiple" data-placeholder="Select Regency">
                                @foreach($regencies as $regency)
                                    <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Date Range Options</h6>
                    <div class="form-group">
                        <div class="form-group " >
                            <div class="input-group">
                                <input type="text" id="daterange" name="daterange" class = "form-control" value="" />
                                <div class="input-group-append" id="icon-calendar">
                            <span class="input-group-text">
                                <span class="la la-calendar"></span>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <button id='backBtn' type="button" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> Reset
                        </button>
                        <button id="filterBtn" value="create" type="button" class="btn btn-success">
                            <i class="la la-check-square-o"></i> Filter
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <!-- End: Customizer-->
        <!-- END: Content -->
        @endsection

@push('ajax_crud')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#daterange').daterangepicker(
            {
                startDate: moment("01/01/2021","DD/MM/YYYY"),
                endDate: moment(),
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                separator: ' to ',
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Submit',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                },
                drops: 'up',
            },
            function(start, end) {

            }
        );

        $('#icon-calendar').click(function() {
            $("#daterange").focus();
        });

        $('#backBtn').click(function() {

            $('#daterange').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
            $('#daterange').data('daterangepicker').setEndDate(moment());

            $('#id_category').val(null).trigger('change');
            $('#id_district').val(null).trigger('change');
            $('#id_participant').val(null).trigger('change');
            $('#id_regency').val(null).trigger('change');

            getCollectionByFilter();

        });


        $('#filterBtn').click(function() {
            getCollectionByFilter();
        });
    });

    function getCollectionByFilter() {
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idCategory = $('#id_category').val();
        var idDistrict = $('#id_district').val();
        var idParticipant = $('#id_participant').val();
        var idRegency = $('#id_regency').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            idCategory: idCategory,
            idDistrict: idDistrict,
            idParticipant: idParticipant,
            idRegency: idRegency,
        }

        var role = '{{$user['role']}}';
        var table;

        if(role == "Admin") {
            table = $('#collectionTable').DataTable({
                bDestroy: true,
                processing: true,
                serverSide: true,
                order: [[5, "desc"]],
                ajax: {
                    url: "{{ route('collections.index') }}",
                    data: function (d) {
                        d.param = params;
                    }
                },
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
                bDestroy: true,
                processing: true,
                serverSide: true,
                order: [[5, "desc"]],
                ajax: {
                    url: "{{ route('collections.index') }}",
                    data: function (d) {
                        d.param = params;
                    }
                },
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
    }

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

      $('#downloadCollectionBtn').click(function (e) {
          var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
          var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
          var idCategory = $('#id_category').val();
          var idDistrict = $('#id_district').val();
          var idParticipant = $('#id_participant').val();
          var idRegency = $('#id_regency').val();

          var params = {
              startDates: startDates,
              endDates: endDates,
              idCategory: idCategory,
              idDistrict: idDistrict,
              idParticipant: idParticipant,
              idRegency: idRegency,
          }

          var url = "{{URL::to('downloadCollections')}}?" + $.param(params)

          window.location = url;
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
