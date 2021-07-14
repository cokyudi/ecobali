<div class="modal fade text-left" id="regencyImportModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalImportHeading">Import Regency from Excel</h4>
            </div>
            <div class="modal-body">
                <form id="regencyFormImport" name="regencyFormImport" class="form-horizontal" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" name="fileImportRegency" id="fileImportRegency" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv" class="form-control-file">
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" value="" class="btn btn-primary" id="saveBtnFormImport" value="create">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
