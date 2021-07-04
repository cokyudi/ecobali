<div class="modal fade text-left" id="subdistrictModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="subdistrictForm" name="subdistrictForm" class="form-horizontal">
                    <input type="hidden" id="subdistrict_id" name="subdistrict_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">Sub-District</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="subdistrict_name" name="subdistrict_name" placeholder="Enter Sub-District Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" value="" class="btn btn-primary" id="saveBtn" value="create">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>