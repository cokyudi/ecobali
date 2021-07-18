<div class="modal fade text-left" id="collectionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="collectionForm" name="collectionForm" class="form-horizontal">
                    <input type="hidden" id="collection_id" name="collection_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="participant_id" class="control-label">Participant</label>
                        <div class="col-sm-12">
                            <select id="participant_id" name="participant_id" class="select2 form-control">
                                <option value="0" selected="" disabled="">Participant</option>
                                @foreach($participants as $participant)
                                    <option value="{{$participant->id}}">{{$participant->participant_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="control-label">Quantity</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="collect_date">Collect Date</label>
                        <div class="col-sm-12">
                            <input type="date" id="collect_date" class="form-control" name="collect_date">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" value="" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
