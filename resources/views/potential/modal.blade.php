<div class="modal fade text-left" id="potentialModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="potentialForm" name="potentialForm" class="form-horizontal">
                    <input type="hidden" id="potential_id" name="potential_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group form-group-style">
                        <label for="id_category">Category</label>
                        <select id="id_category" name="id_category" class="form-control">
                            <option value="0" selected="" disabled="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="potential_low" class="control-label">Low</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="potential_low" name="potential_low" placeholder="Enter Low Potential" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="potential_medium" class="control-label">Medium</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="potential_medium" name="potential_medium" placeholder="Enter Medium Potential" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="potential_high" class="control-label">High</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="potential_high" name="potential_high" placeholder="Enter High Potential" value="">
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
