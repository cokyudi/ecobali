<div class="modal fade text-left" id="purchasePriceModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="purchasePriceForm" name="purchasePriceForm" class="form-horizontal">
                    <input type="hidden" id="purchasePrice_id" name="purchasePrice_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">Purchase Price (Rp.)</label>
                        <div class="col-sm-12">
                            <div class="controls">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Purchase Price in Rupiah" value="" maxlength="100" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" maxlength="50">
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