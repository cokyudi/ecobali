@extends('template', ['user'=>$user])
@section('papermills','active')

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
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Create Papermill</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item active">Create Papermill
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

                            <form class="form" id="papermillForm" name="papermillForm" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <input type="hidden" id="papermill_id" name="papermill_id" value="">
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
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div class="tab-pane active" id="tabGeneral">
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="papermill_name">Papermill Name</label>
                                                            <input required type="text" id="papermill_name" class="form-control" placeholder="Papermill Name" name="papermill_name"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-style">
                                                            <label for="id_papermill_category">Papermill Category</label>
                                                            <select required id="id_papermill_category" name="id_papermill_category" class="form-control">
                                                                <option value="0" selected="" disabled="">Select Papermill Category</option>
                                                                @foreach($papermill_categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->papermill_category_name}}</option>
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
                                                            <input required type="text" id="contact_name_1" class="form-control" placeholder="Contact Name 1" name="contact_name_1"  maxlength="250" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_position_1">Contact Position 1</label>
                                                            <input required type="text" id="contact_position_1" class="form-control" placeholder="Contact Position 1" name="contact_position_1"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_phone_1">Contact Phone 1</label>
                                                            <input required type="number" id="contact_phone_1" class="form-control" placeholder="Contact Phone 1" name="contact_phone_1"  maxlength="50" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_email_1">Contact Email 1</label>
                                                            <input required type="email" id="contact_email_1" class="form-control" placeholder="Contact Email 1" name="contact_email_1"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <h4 class="form-section "><i class="la la-bus"></i>Transport Intensity & <i class="la la-calendar"></i>Joined Date</h4> -->
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tabLocation" >
                                            <div class="col-md-12">
                                                <!-- <h4 class="form-section "><i class="la la-user"></i>Name & <i class="la la-street-view"></i>Category</h4> -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-style">
                                                            <label for="address">Address</label>
                                                            <input required type="text" id="address" class="form-control" placeholder="Address" name="address"  maxlength="400" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <h4 class="form-section "><i class="la la-book"></i>Contact</h4> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="latitude">Latitude</label>
                                                            <input required type="number" id="latitude" class="form-control" placeholder="Latitude" name="latitude"  maxlength="100" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="langitude">Langitude</label>
                                                            <input required type="number" id="langitude" class="form-control" placeholder="Langitude" name="langitude"  maxlength="100" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <h4 class="form-section "><i class="la la-bus"></i>Transport Intensity & <i class="la la-calendar"></i>Joined Date</h4> -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_area">Area</label>
                                                            <select required id="id_area" name="id_area" class="select2 form-control">
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
                                                            <select required id="id_district" name="id_district" class="form-control">
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
                                                            <select required id="id_regency" name="id_regency" class="form-control">
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
                                                        <div class="form-group">
                                                            <label for="id_purchase_price">Purchase Price</label>
                                                            <select required id="id_purchase_price" name="id_purchase_price" class="form-control">
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
                                                            <select required id="id_payment_method" name="id_payment_method" class="form-control">
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
                                                            <select required id="id_bank" name="id_bank" class="form-control">
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
                                                            <input required type="text" id="bank_branch" class="form-control" placeholder="Bank Branch" name="bank_branch"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_number">Bank Account Number</label>
                                                            <input required type="number" id="bank_account_number" class="form-control" name="bank_account_number"  maxlength="200" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <label for="bank_account_holder_name">Bank Account Holder Name</label>
                                                            <input required type="text" id="bank_account_holder_name" class="form-control" placeholder="Bank Account Holder Name" name="bank_account_holder_name"  maxlength="200" >
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
        var form = $("#papermillForm");
        form.validate();
    });
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#backBtn').click(function() {
            console.log(new FormData($("#papermillForm")[0]));
        });

        $('#saveBtn').click(function(e) {
            if ($('#papermillForm').valid()) {
                e.preventDefault();
                if ($('#saveBtn').val() == "create")  {
                    $('#created_by').val("Deva Dwi A");
                    $('#created_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                    $('#last_modified_by').val(null);
                    $('#last_modified_datetime').val(null);
                    var alertMessage = 'Papermill berhasil ditambahkan.';
                } else {
                    $('#last_modified_by').val("Deva Dwi A Edit");
                    $('#last_modified_datetime').val(new Date().toISOString().slice(0, 19).replace('T', ' '));
                    var alertMessage = 'Papermill berhasil di edit.';
                }
                $(this).html('Save');

                $.ajax({
                    data: new FormData($("#papermillForm")[0]),
                    url: "{{ route('papermills.store') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (dataResult) {
                        $('#saveBtn').val("modify");
                        $('#saveBtn').html('Save Changes');
                        $('#papermill_id').val(dataResult.data.id);
                        $('#created_by').val(dataResult.data.created_by);
                        $('#created_datetime').val(dataResult.data.created_datetime);
                        toastr.options = {
                            "positionClass": "toast-bottom-right"
                        };
                        toastr.success(alertMessage);
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
</script>

@endpush
