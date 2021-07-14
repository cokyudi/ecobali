<div class="modal fade text-left" id="userModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
                    <input type="hidden" id="user_id" name="user_id" value="">
                    <input type="hidden" id="created_by" name="created_by" value="">
                    <input type="hidden" id="created_datetime" name="created_datetime" value="">
                    <input type="hidden" id="last_modified_by" name="last_modified_by" value="">
                    <input type="hidden" id="last_modified_datetime" name="last_modified_datetime" value="">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="role" id="role">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="password-form">
                        <label for="password" class="control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group" id="password_confirmation-form">
                        <label for="password" class="control-label">Password Confirmation</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password confirmation" value="" maxlength="50" required="">
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
