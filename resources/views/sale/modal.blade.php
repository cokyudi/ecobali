<div class="modal fade text-left" id="salesModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="salesForm" name="salesForm" class="form-horizontal">
                    <input type="hidden" id="sales_id" name="sales_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-group-style">
                                    <label for="sale_date">Date</label>
                                    <input type="date" id="sale_date" class="form-control" name="sale_date">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="collected_d_min_1">Collected D-1 Sell</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Collected D-1 Sell" id="collected_d_min_1" name="collected_d_min_1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivered_to_papermill">Delivered to Papermill</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Delivered to Papermill" id="delivered_to_papermill" name="delivered_to_papermill">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row salesDetail">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighing_scale_gap_eco">Weighing scale Gap ecoBali</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Weighing scale Gap ecoBali" id="weighing_scale_gap_eco" name="weighing_scale_gap_eco" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighing_scale_gap_eco_percent">% Weighing scale Gap ecoBali</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="% Weighing scale Gap ecoBali" id="weighing_scale_gap_eco_percent" name="weighing_scale_gap_eco_percent" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="form-section"></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_papermill">Papermill</label>
                                    <select id="id_papermill" name="id_papermill" class="select2 form-control">
                                        <option value="0" selected="" disabled="">Papermill</option>
                                        @foreach($papermills as $papermill)
                                            <option value="{{$papermill->id}}">{{$papermill->papermill_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="received_at_papermill">Received at Papermill</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Received at Papermill" id="received_at_papermill" name="received_at_papermill">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row salesDetail">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighing_scale_gap_papermill">Weighing Scale Gap Papermill</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Weighing scale Gap papermill" id="weighing_scale_gap_papermill" name="weighing_scale_gap_papermill" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighing_scale_gap_papermill_percent">% Weighing scale Gap papermill</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="% Weighing scale Gap papermill" id="weighing_scale_gap_papermill_percent" name="weighing_scale_gap_papermill_percent" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-section"></h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="moisture_content_and_contaminant">Moisture Content and Contaminant</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Moisture Content and Contaminant" id="moisture_content_and_contaminant" name="moisture_content_and_contaminant">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 salesDetail">
                                <div class="form-group">
                                    <label for="moisture_content_and_contaminant_percent">% Moisture Content and Contaminant </label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="% Moisture Content and Contaminant " id="moisture_content_and_contaminant_percent" name="moisture_content_and_contaminant_percent" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-section salesDetail"></h4>

                        <div class="row salesDetail">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deduction">Total Gap / Deduction</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Total Gap / Deduction" id="deduction" name="deduction" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deduction_percent">% Total Gap / Deduction</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="% Total Gap / Deduction" id="deduction_percent" name="deduction_percent" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_weight_accepted">Total Weight Accepted</label>
                                    <div class="input-group mt-0">
                                        <input type="number" class="form-control" placeholder="Total Weight Accepted" id="total_weight_accepted" name="total_weight_accepted" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
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
