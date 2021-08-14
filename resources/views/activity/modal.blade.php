<div class="modal fade text-left" id="activityModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="activityForm" name="activityForm" class="form-horizontal">
                    <input type="hidden" id="activity_id" name="activity_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-group-style">
                                    <label for="activity_date">Date</label>
                                    <input required type="date" id="activity_date" class="form-control" name="activity_date">
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section"></h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_program_activity">Activity Program</label>
                                    <select required id="id_program_activity" name="id_program_activity" class="select2 form-control">
                                        <option value="0" selected="" disabled="">Activity Program</option>
                                        @foreach($activity_programs as $activity_program)
                                            <option value="{{$activity_program->id}}">{{$activity_program->activity_program_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="activity">Activity</label>
                                    <input required type="text" class="form-control" placeholder="Activity" id="activity" name="activity">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_category">Category</label>
                                    <select required id="id_category" name="id_category" class="form-control">
                                        <option value="0" selected="" disabled="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input required type="text" class="form-control" placeholder="Location" id="location" name="location">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_district">District</label>
                                    <select required id="id_district" name="id_district" class="select2 form-control">
                                        <option value="0" selected="" disabled="">District</option>
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}">{{$district->district_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
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

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="participant_number">Participant Number</label>
                                    <input required type="number" class="form-control" placeholder="Participant Number" id="participant_number" name="participant_number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                            <i class="la la-check-square-o"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
