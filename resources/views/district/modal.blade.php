<div class="modal fade text-left" id="districtModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="districtForm" name="districtForm" class="form-horizontal">
                    <input type="hidden" id="district_id" name="district_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">District</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="district_name" name="district_name" placeholder="Enter District Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" maxlength="50">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="mit" value="" class="btn btn-primary" id="saveBtn" value="create">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
