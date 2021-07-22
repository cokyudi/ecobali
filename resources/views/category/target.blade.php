<div class="modal fade text-left" id="categoryTargetModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeadingTarget"></h4>
            </div>
            <div class="modal-body">
                <form id="categoryTargetForm" name="categoryTargetForm" class="form-horizontal">
                    <input type="hidden" id="category_detail_id" name="category_detail_id" value="">
                    <input type="hidden" id="category_id_target" name="category_id_target" value="{{ $category->id }}">
                    <input type="hidden" id="created_by_target" name="created_by_target" value="">
                    <input type="hidden" id="created_datetime_target" name="created_datetime_target" value="">
                    <input type="hidden" id="last_modified_by_target" name="last_modified_by_target" value="">
                    <input type="hidden" id="last_modified_datetime_target" name="last_modified_datetime_target" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">Year</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="year" name="year" placeholder="Enter Category Name" value="" maxlength="50" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semester 1 Target</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="semester_1_target" name="semester_1_target" placeholder="Enter Semester 1 Target" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Semester 2 Target</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="semester_2_target" name="semester_2_target" placeholder="Enter Semester 2 Target" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" value="" class="btn btn-primary" id="saveTargetBtn" value="create">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
