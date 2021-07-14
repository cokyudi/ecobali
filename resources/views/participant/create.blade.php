@extends('template')
@section('participants','active')

@push('css_extend')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/selects/select2.min.css')}}">
@endpush
@section('content')
        <!-- BEGIN: Content-->
        <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Create Participant</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">Create Participant
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
                                    <input type="hidden" id="participant_id" name="participant_id" value="">
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
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div class="tab-pane active" id="tabGeneral">
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="participant_name">Participant Name</label>
                                                            <input type="text" id="participant_name" class="form-control" placeholder="Participant Name" name="participant_name"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_category">Category</label>
                                                            <select id="id_category" name="id_category" class="form-control">
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
                                                            <input type="text" id="contact_name_1" class="form-control" placeholder="Contact Name 1" name="contact_name_1"  maxlength="250" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_position_1">Contact Position 1</label>
                                                            <input type="text" id="contact_position_1" class="form-control" placeholder="Contact Position 1" name="contact_position_1"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_phone_1">Contact Phone 1</label>
                                                            <input type="number" id="contact_phone_1" class="form-control" placeholder="Contact Phone 1" name="contact_phone_1"  maxlength="50" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_email_1">Contact Email 1</label>
                                                            <input type="email" id="contact_email_1" class="form-control" placeholder="Contact Email 1" name="contact_email_1"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_name_2">Contact Name 2</label>
                                                            <input type="text" id="contact_name_2" class="form-control" placeholder="Contact Name 2" name="contact_name_2"  maxlength="250" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_position_2">Contact Position 2</label>
                                                            <input type="text" id="contact_position_2" class="form-control" placeholder="Contact Position 2" name="contact_position_2"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_phone_2">Contact Phone 2</label>
                                                            <input type="number" id="contact_phone_2" class="form-control" placeholder="Contact Phone 2" name="contact_phone_2"  maxlength="50" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_email_2">Contact Email 2</label>
                                                            <input type="email" id="contact_email_2" class="form-control" placeholder="Contact Email 2" name="contact_email_2"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <h4 class="form-section "><i class="la la-bus"></i>Transport Intensity & <i class="la la-calendar"></i>Joined Date</h4> -->
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
                                                            <input type="text" id="address" class="form-control" placeholder="Address" name="address"  maxlength="400" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4 class="form-section "><i class="la la-book"></i>Contact</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="latitude">Latitude</label>
                                                            <input type="number" id="latitude" class="form-control" placeholder="Latitude" name="latitude"  maxlength="100" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="langitude">Langitude</label>
                                                            <input type="number" id="langitude" class="form-control" placeholder="Langitude" name="langitude"  maxlength="100" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="service_area">Service Area</label>
                                                            <input type="text" id="service_area" class="form-control" placeholder="Service Area" name="service_area"  maxlength="400" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <h4 class="form-section "><i class="la la-bus"></i>Transport Intensity & <i class="la la-calendar"></i>Joined Date</h4> -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
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
                                                            <input type="text" id="resource_description" class="form-control" placeholder="Resource Description" name="resource_description"  maxlength="400" >
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
                                                            <input type="text" id="bank_branch" class="form-control" placeholder="Bank Branch" name="bank_branch"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_number">Bank Account Number</label>
                                                            <input type="number" id="bank_account_number" class="form-control" name="bank_account_number"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_holder_name">Bank Account Holder Name</label>
                                                            <input type="text" id="bank_account_holder_name" class="form-control" placeholder="Bank Account Holder Name" name="bank_account_holder_name"  maxlength="200" >
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
                                    </div>
                                </div>
                                </div>

                                <div class="form-actions text-right">
                                    <button id='backBtn' type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> Cancel
                                    </button>
                                    <button id="saveBtn"  value="create"  type="submit" class="btn btn-primary">
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
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(e) {

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

    });
</script>
<script type="text/javascript">
    $(function() {
        // $('#id_box_resource').val(['AK', 'AB']).change(); //select multiple select
        //alert("Selected value is: "+$("#id_box_resource").val());
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

                    // $('#paymentMethodForm').trigger("reset");
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });

        });
    });
</script>

@endpush
