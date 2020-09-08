<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">

      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex">
              <div>
                <h4 class="card-title"> All Users List</h4>
                <h5 class="card-subtitle">Overview of all Employee (Name, Roles & Department) Type</h5>
              </div>
              <div class="ml-auto text-right">
                <a href="#addnew" class="btn btn-primary addNewbtn" data-toggle="modal">Add New</a>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NAME</th>
                  <th>USER NAME</th>
                  <th>CREATED</th>
                  <th>ROLE</th>
                  <th>DEPARTMENT</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user as $value): ?>
                <tr>
                  <td><?php echo get_increment(0, $inc);  ?></td>
                  <td><?php echo $value['name'] ?></td>
                  <td><?php echo $value['username'] ?></td>
                  <td><?php echo my_date_show_time($value['created_at']) ?></td>
                  <td>
                    <?php echo get_badge($value['roles']); ?>
                  </td>
                  <td>
                    <?php echo 'N/A'; ?>
                  </td>
                  <td>
                    <?php if ($value['status']): ?>
                    <span class="badge badge-pill badge-success">Active</span>
                    <?php else: ?>
                    <span class="badge badge-pill badge-danger">Deactive</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/roles/edit/').$value['id']; ?>"><button type="button" class="btn btn-outline-info"><i class="mdi mdi-lead-pencil w-30px"></i></button></a>
                    <a href="<?php echo base_url('admin/permissions/assign/').$value['id']; ?>"><button type="button" class="btn btn-outline-success">Add Permissions</button></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- add modal wind-->
<div id="addnew" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" id="create_user" method="post" action="<?php echo base_url('admin/user/add') ?>" name="basic_validate">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <span id="design-error" class="error" style="color:red;"></span>
            <div class="form-group row">
              <label class="control-label col-sm-3">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required value="" id="role_name" required>
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">User Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="username" value="" id="username" required>
                <span id="username-error" class="error" style="color:red;"></span>
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Add Role</label>
              <div class="col-md-9">
                <select class="select2" name="role[]" multiple="multiple" required style="width: 100%">
                  <?php foreach ($roles as $value): ?>
                      <option value="<?php echo $value->id ?>"><?php echo $value->display_name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" name="password" value="" id="password" placeholder="********" required>
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Confirm Password</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="re-password" value="" id="re-password" placeholder="********" required>
                <span id="password-error" class="error" style="color:red;"></span>
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Description (optional)</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="description" value="" id="description"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input type="submit" id="usersubmit" class="btn btn-primary" value="submit">
            <a data-dismiss="modal" class="btn" href="#">Cancel</a>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url()?>admin/roles/delete/" + id;
      }

    }
  }
</script>

<?php include('script.php'); ?>
