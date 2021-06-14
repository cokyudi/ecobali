<div class="modal fade text-left" id="categoryModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="categoryForm" name="categoryForm" class="form-horizontal">
                    <input type="hidden" id="category_id" name="category_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">Category</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="" maxlength="50" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <div class="col-sm-12">
                            <!-- <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" maxlength="200" required=""> -->
                            <fieldset class="form-group">
                                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Enter Description" value="" maxlength="200"></textarea>
                            </fieldset>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">This Year Target</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="this_year_target" name="this_year_target" placeholder="Enter Province Name" value="" maxlength="50" required="">
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