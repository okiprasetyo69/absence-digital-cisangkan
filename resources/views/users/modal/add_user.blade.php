<!-- Modal -->
<div class="modal fade" id="modalAddUser" role="dialog" aria-labelledby="modalAddUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="frm-add-user">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="hidden" name="id" class="form-control" id="user_id">
                    <input type="hidden" name="role_name" class="form-control" id="role_name">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                    <span id="err_name"> </span>
                </div>
                <div class="form-group">
                  <label for="">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                  <span id="err_email"> </span>
                </div>
                <div class="form-group">
                  <label for="">Role</label>
                  <select class="form-control role_id" name="role_id" id="role_id" style="width:100%">
                    <option value="">-- Choose Role --</option>
                  </select>
                  <span id="err_role_id"> </span>
                </div>
                <div class="form-group lbl-password">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                  <span id="err_password"> </span>
                </div>
                <div class="form-group lbl-c_password">
                    <label for="">Confirm Password</label>
                    <input type="password" name="c_password"  class="form-control" id="c_password" placeholder="Confirm Password">
                    <span id="err_c_password"> </span>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-window-close"></i> Close</button>
          <button type="submit" class="btn btn-primary btn-sm" id="btn-save"> <i class="fas fa-save"></i> Save</button>
        </div>
            </form>
      </div>
    </div>
  </div>