<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4 text-right">
          <a href="#addnew" class="btn btn-primary addNewbtn" data-toggle="modal">Add New</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form id="deptFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value=" deptName">Department Name</option>
                    <option value="userId">User ID</option>
                    <option value="email">Email</option>
                    <option value="phone_no">Contact Number</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="searchValue" placeholder="Search" id="searchByValue" class="form-control">
                </div>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Department List</h5>
              </div>
              <hr><div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div><hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="dept">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Department Name</th>
                      <th>User ID</th>
                      <th>Email</th>
                      <th>Contact Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($dept_data > 0) {
                      $id = 1;
                      foreach ($dept_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $id ?></td>
                          <td><?php echo $value->deptName ?></td>
                          <!-- <td><?php echo $value->headName ?></td> -->
                          <td><?php echo $value->userId ?></td>
                          <td><?php echo $value->email ?></td>
                          <td><?php echo $value->phone_no ?></td>
                          <td>
                            <a href="<?php echo '#' . $value->id; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                              <i class="fas fa-edit blue"></i>
                            </a>
                            <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value->id; ?>)" data-original-title="Delete">
                              <i class="mdi mdi-delete red"></i>
                            </a>
                          </td>
                        </tr>

                        <div id="<?php echo $value->id; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Department/edit/') . $value->id ?>">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Department</h5>
                                  <button data-dismiss="modal" class="close" type="button">×</button>

                                </div>
                                <div class="modal-body">
                                  <div class="widget-content nopadding">

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Name of Department</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="deptName" required value="<?php echo $value->deptName ?>">
                                      </div>
                                    </div>
                                    <!-- <div class="control-group">
                            <label class="control-label">Name Of Head</label>
                            <div class="controls">
                              <input type="text" name="headName" value="<?php echo $value->headName ?>" >
                            </div>
                          </div> -->
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">User ID</label>
                                      <div class="col-sm-9">
                                        <select name="userId" class="form-control" required>
                                          <?php foreach ($user as $rec) : ?>
                                            <option <?php if ($value->userId == $rec->username) {
                                                    ?>selected<?php } ?> value="<?php echo $rec->username ?>"><?php echo $rec->username ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Email</label>
                                      <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email"  value="<?php echo $value->email ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Contact Number</label>
                                      <div class="col-sm-9">
                                        <input type="number" class="form-control" name="phone_no" value="<?php echo $value->phone_no ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                  <input type="submit" value="Update" class="btn btn-primary">
                                  <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>


                    <?php $id = $id + 1;
                      }
                    } ?>

                  </tbody>
                </table>
              </div>
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
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Department/addDept') ?>">
        <div class="modal-header">
          <h5 class="modal-title">Add Department</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">

            <div class="form-group row">
              <label class="control-label col-sm-3">Name of Department</label>
              <div class="controls col-sm-9">
                <input type="text" class="form-control" name="deptName" value="">
              </div>
            </div>
            <!-- <div class="control-group">
            <label class="control-label">Name Of Head</label>
            <div class="controls">
              <input type="text" name="headName" value="" >
            </div>
          </div> -->
            <div class="form-group row">
              <label class="control-label col-sm-3">User </label>
              <div class="col-sm-9">

                <select name="userId" class="form-control">
                  <?php foreach ($user as $rec) : ?>
                    <option value="<?php echo $rec->username ?>"><?php echo $rec->username ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Contact Number</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="phone_no" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <input type="submit" class="btn btn-primary">
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
        window.location = "<?php echo base_url() ?>admin/Department/delete/" + id;
      }

    }
  }
</script>
<?php include('department_js.php'); ?>