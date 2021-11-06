@extends('template', ['user'=>$user])
@section('participantList','active')

@push('menu_title')
    <li class="nav-item d-none d-lg-block">
        <a class="nav-link text-bold-700 font-medium-3" href="{{url('participantList')}}">Participant List</a>
    </li>
@endpush

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush

@section('dashboard1','active')
@section('content')
          <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Participant List</h4>
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
                                <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" href="javascript:void(0)" id="downloadParticipantBtn">Download</button>

                                <div class="table-responsive">
                                    <table id="participantTable" class="table table-striped table-bordered zero-configuration pr-1">
                                        <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>Participant Name</th>
                                            <th>Regency</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Total KBM (Kg)</th>
                                            <th>Average (Kg)</th>
                                            <th>Last Submit</th>
                                            <th>Joined Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>Participant Name</th>
                                            <th>Regency</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Total KBM (Kg)</th>
                                            <th>Average (Kg)</th>
                                            <th>Last Submit</th>
                                            <th>Joined Date</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block"><a class="customizer-close" href="#"><i class="ft-x font-medium-3"></i></a><a class="customizer-toggle bg-info box-shadow-3" href="#"><i class="ft-filter font-medium-3 white"></i></a><div class="customizer-content p-2">
	<h4 class="text-uppercase mb-0">Data Filter Customizer</h4>
	<hr>

        <form id="filterForm" name="filterForm">
            <h6 class="mt-1 mb-1 text-bold-500">Status</h6>
            <div class="form-group ">
                <select id="id_status" name="id_status" class="form-control">
                    <option value="0" disabled selected>Select Status</option>
                    <option value="1" >Active</option>
                    <option value="2" >Inactive</option>

                </select>
            </div>
            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Participant</h6>
            <div class="form-group ">
                <select id="id_participant_filter" name="id_participant_filter[]" multiple="multiple" class="select2 form-control " data-placeholder="Select Participant">
                    @foreach($participantList as $participant)
                        <option value="{{$participant->id}}">{{$participant->participant_name}}</option>
                    @endforeach
                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">District</h6>
            <div class="form-group ">
                <select id="id_district_filter" name="id_district_filter[]" multiple="multiple" class="select2 form-control" data-placeholder="Select District">
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->district_name}}</option>
                    @endforeach

                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Regency</h6>
            <div class="form-group ">
                <div class="input-group">
                    <select class="select2 form-control" id="id_regency_filter" name="id_regency_filter[]" multiple="multiple" data-placeholder="Select Regency">
                        @foreach($regencies as $regency)
                            <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Category</h6>
            <div class="form-group ">
                <select id="id_category_filter" name="id_category_filter[]" multiple="multiple" class="select2 form-control" data-placeholder="Select Category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                </select>
            </div>

            <h6 class="mt-1 mb-1 text-bold-500 font-small-3">Date Range Submit</h6>
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
                <button id='reset' type="button" class="btn btn-warning mr-1">
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

<script src="https://www.google.com/jsapi"></script>
{{--<script src="{{asset('js/scripts/charts/google/pie/pie.min.js')}}"></script>--}}
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

        fetchData();


      $('#reset').click(function() {

          $('#daterange').data('daterangepicker').setStartDate(moment("01/01/2021","DD/MM/YYYY"));
          $('#daterange').data('daterangepicker').setEndDate(moment());

          $('#id_status').val(0).trigger("change");
          $('#id_category').val(0).trigger("change");
          $("#id_area").val(0).trigger("change");
          $('#id_district').val(0).trigger("change");
          $('#id_regency').val(0).trigger("change");


      });

		$('#filterBtn').click(function() {
            $('#participantTable').DataTable().draw(true);
            fetchData();
        });

    });

    function fetchData(){
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idCategory = $('#id_category').val();
        var idDistrict = $('#id_district').val();
        var idArea = $('#id_area').val();
        var idRegency = $('#id_regency').val();
        var idStatus = $('#id_status').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            idCategory: idCategory,
            idDistrict: idDistrict,
            idRegency: idRegency,
            idArea:idArea,
            idStatus:idStatus,
        }

        var table = $('#participantTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('participantList.index') }}",
                data: params
            },
            columns: [
                {data: null},
                {data: 'participant_name_link', name: 'participant_name_link'},
                {data: 'regency_name', name: 'regency_name'},
                {data: 'category_name', name: 'category_name'},
                {data: 'status', name: 'status'},
                {data: 'qty', name: 'qty'},
                {data: 'avg', name: 'avg'},
                {data: 'lastSubmit', name: 'lastSubmit'},
                {data: 'joined_date', name: 'joined_date'},
            ],
            columnDefs: [
                { className: 'text-center', targets: [4] },
            ]
        });

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    }

</script>
@endpush
