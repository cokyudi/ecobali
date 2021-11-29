@extends('template', ['user'=>$user])
@section('participants','active')

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
<style type="text/css">
    label.error {
        color: red !important;
        text-transform: none !important;
        font-weight: normal !important;
    }
</style>
@endpush
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-12 col-12 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">View Participant</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item">View Participant
                                </li>
                                <li class="breadcrumb-item active">{{$participant->participant_name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">

                            <form class="form" id="participantForm" name="participantForm" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <input type="hidden" id="participant_id" name="participant_id" value="{{$participant->id}}">
                                    <input type="hidden" id="created_by" name="created_by" value="">
                                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                                <div class="nav-vertical">
                                    <ul class="nav nav-tabs nav-left nav-border-left">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"  href="#tabGeneral" aria-expanded="true">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"  href="#tabLocation" aria-expanded="false">Location</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab"  href="#tabProduct" aria-expanded="false">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabPayment" aria-expanded="false">Payment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabOther" aria-expanded="false">Other</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabCollection" aria-expanded="false">Collection</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div class="tab-pane active" id="tabGeneral">
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="participant_name">Participant Name</label>
                                                            <input required type="text" id="participant_name" class="form-control" placeholder="Participant Name" name="participant_name"  maxlength="200" value="{{$participant->participant_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_category">Category</label>
                                                            <select required id="id_category" name="id_category" class="form-control">
                                                                <option value="0" selected="" disabled="">Select Category</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4 class="form-section "><i class="la la-book"></i>Contact</h4> -->
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_name_1">Contact Name 1</label>
                                                            <input type="text" id="contact_name_1" class="form-control" placeholder="Contact Name 1" name="contact_name_1"  maxlength="250" value="{{$participant->contact_name_1}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_position_1">Contact Position 1</label>
                                                            <input type="text" id="contact_position_1" class="form-control" placeholder="Contact Position 1" name="contact_position_1"  maxlength="200" value="{{$participant->contact_position_1}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_phone_1">Contact Phone 1</label>
                                                            <input type="number" id="contact_phone_1" class="form-control" placeholder="Contact Phone 1" name="contact_phone_1"  maxlength="50" value="{{$participant->contact_phone_1}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_email_1">Contact Email 1</label>
                                                            <input type="email" id="contact_email_1" class="form-control" placeholder="Contact Email 1" name="contact_email_1"  maxlength="200" value="{{$participant->contact_email_1}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_name_2">Contact Name 2</label>
                                                            <input type="text" id="contact_name_2" class="form-control" placeholder="Contact Name 2" name="contact_name_2"  maxlength="250" value="{{$participant->contact_name_2}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_position_2">Contact Position 2</label>
                                                            <input type="text" id="contact_position_2" class="form-control" placeholder="Contact Position 2" name="contact_position_2"  maxlength="200" value="{{$participant->contact_position_2}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_phone_2">Contact Phone 2</label>
                                                            <input type="number" id="contact_phone_2" class="form-control" placeholder="Contact Phone 2" name="contact_phone_2"  maxlength="50" value="{{$participant->contact_phone_2}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_email_2">Contact Email 2</label>
                                                            <input type="email" id="contact_email_2" class="form-control" placeholder="Contact Email 2" name="contact_email_2"  maxlength="200" value="{{$participant->contact_email_2}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_transport_intensity">Transport Intensity</label>
                                                            <select id="id_transport_intensity" name="id_transport_intensity" class="form-control">
                                                                <option value="0" selected="" disabled="">Transport Intensity</option>
                                                                @foreach($transport_intensities as $transport_intensity)
                                                                    <option value="{{$transport_intensity->id}}">{{$transport_intensity->intensity}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="joined_date">Joined Date</label>
                                                            <input type="date" id="joined_date" class="form-control" name="joined_date">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tabLocation" >
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-style">
                                                            <label for="address">Address</label>
                                                            <input type="text" id="address" class="form-control" placeholder="Address" name="address"  maxlength="400" value="{{$participant->address}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4 class="form-section "><i class="la la-book"></i>Contact</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="latitude">Latitude</label>
                                                            <input type="number" id="latitude" class="form-control" placeholder="Latitude" name="latitude"  maxlength="100" value="{{$participant->latitude}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="langitude">Langitude</label>
                                                            <input type="number" id="langitude" class="form-control" placeholder="Langitude" name="langitude"  maxlength="100" value="{{$participant->langitude}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="service_area">Service Area</label>
                                                            <input type="text" id="service_area" class="form-control" placeholder="Service Area" name="service_area"  maxlength="400" value="{{$participant->service_area}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <h4 class="form-section "><i class="la la-bus"></i>Transport Intensity & <i class="la la-calendar"></i>Joined Date</h4> -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="id_area">Area</label>
                                                            <select id="id_area" name="id_area" class="select2 form-control">
                                                                <option value="0" selected="" disabled="">Area</option>
                                                                @foreach($areas as $area)
                                                                    <option value="{{$area->id}}">{{$area->area_name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="id_district">District</label>
                                                            <select id="id_district" name="id_district" class="form-control">
                                                                <option value="0" selected="" disabled="">District</option>
                                                                @foreach($districts as $district)
                                                                    <option value="{{$district->id}}">{{$district->district_name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="id_regency">Regency</label>
                                                            <select id="id_regency" name="id_regency" class="form-control">
                                                                <option value="0" selected="" disabled="">Regency</option>
                                                                @foreach($regencies as $regency)
                                                                    <option value="{{$regency->id}}">{{$regency->regency_name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tabProduct" >
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_box_resource">Box Resources</label>
                                                            <select class="select2 form-control" id="id_box_resource" name="id_box_resource[]" multiple="multiple">
                                                                @foreach($boxresources as $boxresource)
                                                                    <option value="{{$boxresource->id}}">{{$boxresource->resource_name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="resource_description">Resource Description</label>
                                                            <input type="text" id="resource_description" class="form-control" placeholder="Resource Description" name="resource_description"  maxlength="400" value="{{$participant->resource_description}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4 class="form-section "><i class="la la-book"></i>Contact</h4> -->
                                                <div class="row">

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="id_purchase_price">Purchase Price</label>
                                                            <select id="id_purchase_price" name="id_purchase_price" class="form-control">
                                                                <option value="0" selected="" disabled="">Purchase Price</option>
                                                                @foreach($purchase_prices as $purchase_price)
                                                                    <option value="{{$purchase_price->id}}">{{$purchase_price->price}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tabPayment">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_payment_method">Payment Method</label>
                                                            <select id="id_payment_method" name="id_payment_method" class="form-control">
                                                                <option value="0" selected="" disabled="">Payment Method</option>
                                                                @foreach($payment_methods as $payment_method)
                                                                    <option value="{{$payment_method->id}}">{{$payment_method->payment_method}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_bank">Bank</label>
                                                            <select id="id_bank" name="id_bank" class="form-control">
                                                                <option value="0" selected="" disabled="">Bank</option>
                                                                @foreach($banks as $bank)
                                                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_branch">Bank Branch</label>
                                                            <input type="text" id="bank_branch" class="form-control" placeholder="Bank Branch" name="bank_branch"  maxlength="200" value="{{$participant->bank_branch}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_number">Bank Account Number</label>
                                                            <input type="number" id="bank_account_number" class="form-control" name="bank_account_number"  maxlength="200" value="{{$participant->bank_account_number}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_holder_name">Bank Account Holder Name</label>
                                                            <input type="text" id="bank_account_holder_name" class="form-control" placeholder="Bank Account Holder Name" name="bank_account_holder_name"  maxlength="200" value="{{$participant->bank_account_holder_name}}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane" id="tabOther" >
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-style">
                                                            <label for="notes">Notes</label>
                                                            <input type="text" id="notes" class="form-control" placeholder="Notes" name="notes"  maxlength="400" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <input type="hidden" id="fileNamePhoto1" name="fileNamePhoto1" value="">
                                                                    <label for="url_photo_1">Attach a photograph</label>
                                                                    <input type="file" name="url_photo_1" id="url_photo_1" accept="image/*" class="form-control-file">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <img id="preview-image1-before-upload" data-toggle="modal" data-target="#modalImage1" class="img-thumbnail img-fluid" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                                     alt="preview image" style="display: block; margin-left: auto; margin-right: auto;  max-height: 300px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <fieldset class="form-group">
                                                                    <div class="custom-file">
                                                                        <input type="hidden" id="fileNamePhoto2" name="fileNamePhoto2" value="">
                                                                        <label for="url_photo_2">Attach a photograph</label>
                                                                        <input type="file" name="url_photo_2" id="url_photo_2" accept="image/*" class="form-control-file">
                                                                        @error('url_photo_1')
                                                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <img id="preview-image2-before-upload" data-toggle="modal" data-target="#modalImage2" class="img-thumbnail img-fluid" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                                     alt="preview image" style="display: block; margin-left: auto; margin-right: auto;  max-height: 300px">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal fade text-left" id="modalImage1" tabindex="-1" role="dialog" >
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-body">
                                                                <img id="imageModal1" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="" style="display: block; max-height: 700px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal fade text-left" id="modalImage2" tabindex="-1" role="dialog" >
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-body">
                                                                <img id="imageModal2" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="" style="display: block; max-height: 700px">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane" id="tabCollection" >
                                            <div class="d-flex">

                                                <div class="p-2">
                                                    <button type="button" class="btn btn-sm round btn-min-width " style="width: 180px" id="btnContinuity">Continuity : <b id="continuity">None</b></button>
                                                </div>
                                                <div class="mr-auto p-2">
                                                    <button type="button" class="btn btn-sm round btn-min-width " style="width: 180px" id="btnPotential">Potential : <b id="potential">Low</b></button>
                                                </div>

                                                <div class="p-2">
                                                    <input type="text" id="daterange" name="daterange" class = "form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="pr-2 pl-2 pt-0">
                                                    <button type="button" class="btn btn-primary btn-sm round  btn-min-width" style="width: 180px">Total : <b id="totalubc"> Kg</b></button>
                                                </div>
                                                <div class="mr-auto pr-2 pl-2 pt-0">
                                                    <button type="button" class="btn btn-secondary btn-sm round btn-min-width " style="width: 180px">Average : <b id="average"> Kg</b></button>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="btn-group pull-right mr-3" role="group" aria-label="Basic example">
                                                    <button onclick="getLineChartDataCollection('week');" type="button" class="btn btn-sm btn-secondary">Week</button>
                                                    <button onclick="getLineChartDataCollection('month');" type="button" class="btn btn-sm btn-secondary">Month</button>
                                                    <button onclick="getLineChartDataCollection('quarter');" type="button" class="btn btn-sm btn-secondary">Quarter</button>
                                                    <button onclick="getLineChartDataCollection('year');" type="button" class="btn btn-sm btn-secondary">Year</button>
                                                </div>
                                                <div class="card-body chartjs">
                                                    <canvas id="line-chart" height="400"></canvas>
                                                </div>
                                            </div>

                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="collectionTable" class="table table-striped table-bordered zero-configuration nowrap ml-1" width="95%">
                                                            <thead>
                                                            <tr>
                                                                <th width="20px">No</th>
                                                                <th hidden>ID</th>
                                                                <th width="300px">Collect Date</th>
                                                                <th width="300px">Quantity</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th width="20px">No</th>
                                                                <th hidden>ID</th>
                                                                <th width="300px">Collect Date</th>
                                                                <th width="300px">Quantity</th>
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

                                <div class="form-actions text-right">
                                    <button id='backBtn' type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button>
                                    <button id="saveBtn"  value="modify"  type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('ajax_crud')
    <script src="{{asset('vendors/js/charts/chart.min.js')}}"></script>
{{--    <script src="{{asset('js/scripts/charts/chartjs/line/line.min.js')}}"></script>--}}
    <script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    $(document).ready(function(e) {
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
                }
            },
            function(start, end) {
                fetchDatatable();
                getLineChartDataCollection("week");
            }
        );
        var form = $("#participantForm");
        form.validate();

        $('#url_photo_1').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image1-before-upload').attr('src', e.target.result);
                $('#imageModal1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            var filename = $('#url_photo_1')[0].files[0];
            $('#url_photo_1_label').html(filename.name);

        });

        $('#url_photo_2').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image2-before-upload').attr('src', e.target.result);
                $('#imageModal2').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            var filename = $('#url_photo_2')[0].files[0];
            $('#url_photo_2_label').html(filename.name);

        });
        fetchDatatable();
        getLineChartDataCollection("week");

    });
</script>
<script type="text/javascript">
    $(function() {
        $('#id_category').val("{{$participant->id_category}}");
        $('#joined_date').val("{{$participant->joined_date}}");
        $('#id_transport_intensity').val("{{$participant->id_transport_intensity}}");
        $("#id_area").val("{{$participant->id_area}}").trigger("change");
        $('#id_district').val("{{$participant->id_district}}");
        $('#id_regency').val("{{$participant->id_regency}}");
        $('#id_box_resource').val([{{$participant->id_box_resource}}]).change();
        $('#id_purchase_price').val("{{$participant->id_purchase_price}}");
        $('#id_payment_method').val("{{$participant->id_payment_method}}");
        $('#id_bank').val("{{$participant->id_bank}}");
        $('#notes').val("{{$participant->notes}}");

        if ('{{$participant->url_photo_1}}' !== '' ) {
            $('#preview-image1-before-upload').attr('src', "{{ asset('images/participants/'.$participant->url_photo_1)}}");
            $('#imageModal1').attr('src', "{{ asset('images/participants/'.$participant->url_photo_1)}}");
            $('#fileNamePhoto1').val("{{$participant->url_photo_1}}");

        }

        if ('{{$participant->url_photo_2}}' !== '') {
            $('#preview-image2-before-upload').attr('src', "{{ asset('images/participants/'.$participant->url_photo_2)}}");
            $('#imageModal2').attr('src', "{{ asset('images/participants/'.$participant->url_photo_2)}}");
            $('#fileNamePhoto2').val("{{$participant->url_photo_2}}");
        }

        $('#created_by').val("{{$participant->created_by}}");
        $('#created_datetime').val("{{$participant->created_datetime}}");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#backBtn').click(function() {
            console.log(new FormData($("#participantForm")[0]));
            {{--window.location.href = "{{ route('participants.index') }}";--}}
        });

        $('#saveBtn').click(function(e) {
            if ($('#participantForm').valid()) {
                e.preventDefault();
                if ($('#saveBtn').val() == "create")  {
                    $('#created_by').val("Deva Dwi A");
                    $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                    $('#last_modified_by').val(null);
                    $('#last_modified_datetime').val(null);
                    var alertMessage = 'Participant berhasil ditambahkan.';
                } else {
                    $('#last_modified_by').val("Deva Dwi A Edit");
                    $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                    var alertMessage = 'Participant berhasil di edit.';
                }
                $(this).html('Save');

                $.ajax({
                    data: new FormData($("#participantForm")[0]),
                    url: "{{ route('participants.store') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (dataResult) {
                        $('#saveBtn').val("modify");
                        $('#saveBtn').html('Save Changes');
                        $('#participant_id').val(dataResult.data.id);
                        $('#created_by').val(dataResult.data.created_by);
                        $('#created_datetime').val(dataResult.data.created_datetime);
                        toastr.options = {
                            "positionClass": "toast-bottom-right"
                        };
                        toastr.success(alertMessage);

                        // $('#paymentMethodForm').trigger("reset");
                    },
                    error: function (data) {
                        toastr.error('Gagal menambahkan data.');
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            }

        });
    });

    function fetchDatatable(){
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idParticipant = $('#participant_id').val();

        var params = {
            startDates: startDates,
            endDates: endDates,
            idParticipant: idParticipant,
        }

        var table = $('#collectionTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            searching: false,
            order: [[2, "desc"]],
            ajax: {
                url:"{{ route('participants.getDatatableCollection') }}",
                data: params
            },
            columns: [
                {data: null},
                {data: 'id', name: 'id', visible: false},
                {
                    name: 'collect_date.timestamp',
                    data: {
                        _: 'collect_date.display',
                        sort: 'collect_date.timestamp'
                    }
                },
                {data: 'quantity', name: 'quantity'},
            ],
        });

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    }

    function getLineChartDataCollection(type) {
        var startDates=  $("#daterange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDates=  $("#daterange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var idParticipant = $('#participant_id').val();
        var type = type;

        var myLineChart;
        var params = {
            startDates: startDates,
            endDates: endDates,
            idParticipant: idParticipant,
            type:type,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "../../getLineChartDataCollection",
            data: params,
            success: function (data) {
                $('#btnContinuity').removeClass("btn-danger").removeClass("btn-warning").removeClass("btn-info").removeClass("btn-success");
                $('#btnPotential').removeClass("btn-danger").removeClass("btn-warning").removeClass("btn-info").removeClass("btn-success");
                $('#continuity').html(data.data.continuity);
                $('#potential').html(data.data.potential);
                $('#btnContinuity').addClass(data.data.continuityColor);
                $('#btnPotential').addClass(data.data.potentialColor);

                $('#totalubc').html(data.data.totalUbc + " Kg");
                $('#average').html(data.data.average + " Kg");

                if (myLineChart) {
                    myLineChart.destroy();
                }
                var o = $("#line-chart");
                myLineChart = new Chart(o, {
                    type: "line",
                    options: {
                        responsive: !0,
                        maintainAspectRatio: !1,
                        legend: { position: "none" },
                        hover: { mode: "label" },
                        scales: {
                            xAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "Interval", padding: 10, },ticks: {
                                    padding: 10
                                } }],
                            yAxes: [{ display: !0, gridLines: { color: "#f3f3f3", drawTicks: !1 }, scaleLabel: { display: !0, labelString: "UBC (Kg)", padding: 10 },ticks: { padding: 10, beginAtZero: true}}],
                        },
                        title: { display: !0, text: "" },
                    },
                    data: {
                        labels: data.data.dataLine.label,
                        datasets: [
                            {
                                label: "Collection",
                                data: data.data.dataLine.qty,
                                lineTension: 0,
                                fill: !1,
                                lineTension: 0,
                                borderColor: "#00A5A8",
                                pointBorderColor: "#00A5A8",
                                pointBackgroundColor: "#FFF",
                                pointBorderWidth: 2,
                                pointHoverBorderWidth: 2,
                                pointRadius: 4,
                            },
                        ],
                    },
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>

@endpush
