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
            <form id="subDeptFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option>-- Select Category --</option>
                    <option value="deptName">Department</option>
                    <option value="subDeptName">Godown </option>
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
                <h5>Godown List</h5>
              </div>
              <hr>
              <div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div>
              <hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="subDept">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>ID</th>
                      <th>Department</th>
                      <th>Godown</th>
                      <th>Sortname</th>
                      <th>Order</th>
                      <th>Under</th>
                      <th>PrefixIn</th>
                      <th>StartIN</th>
                      <th>SuffixIN</th>
                      <th>PrefixOut</th>
                      <th>StartOut</th>
                      <th>SuffixOut</th>


                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($sub_dept_data > 0) {

                      foreach ($sub_dept_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $value->id ?></td>
                          <td><?php echo $value->deptName ?></td>
                          <td><?php echo $value->subDeptName ?></td>
                          <td><?php echo $value->sortname ?></td>
                          <td><?php echo $value->priority ?></td>
                          <td><?php if ($value->under1 != "") echo $value->under1;
                              else echo "Primary"; ?></td>
                          <td><?php echo $value->inPrefix ?></td>
                          <td><?php echo $value->inStart ?></td>
                          <td><?php echo $value->inSuffix ?></td>
                          <td><?php echo $value->outPrefix ?></td>
                          <td><?php echo $value->outStart ?></td>
                          <td><?php echo $value->outSuffix ?></td>
                          <td>
                            <a href="<?php echo '#' . $value->id; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                              <i class="fas fa-edit blue"></i>
                            </a>

                            <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value->id; ?>)" data-original-title="Delete">
                              <i class="mdi mdi-delete red"></i>
                            </a>
                          </td>
                        </tr>
                        <!--edit modal wind-->
                        <div id="<?php echo $value->id; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Sub_department/edit/') . $value->id ?>">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Godown</h5>
                                  <button data-dismiss="modal" class="close" type="button">×</button>

                                </div>
                                <div class="modal-body">
                                  <div class="widget-content nopadding">
                                    <?php echo $this->session->flashdata('success'); ?>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Select Department</label>
                                      <div class="col-sm-9">
                                        <select name="deptName" class="form-control" required>
                                          <?php foreach ($department as $rec) : ?>
                                            <option <?php if ($value->deptName == $rec->deptName) {
                                                    ?>selected<?php } ?> value="<?php echo $rec->deptName ?>"><?php echo $rec->deptName ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Godown</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control subDeptName" name="subDeptName" required value="<?php echo $value->subDeptName ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Sortname</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control sortname" name="sortname" maxlength="15" required value="<?php echo $value->sortname ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Order</label>
                                      <div class="col-sm-9">
                                        <input type="number" min="0" class="form-control order" name="order" required value="<?php echo $value->priority ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Select Under</label>
                                      <div class="col-sm-9">
                                        <select name="under" class="form-control" required>
                                          <option value="Primary">Primary</option>
                                          <?php foreach ($under as $rec) : ?>
                                            <option <?php if ($value->under == $rec['id']) {
                                                    ?>selected<?php } ?> value="<?php echo $rec['id'] ?>"><?php echo $rec['sortname'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-12">Material In:- </label>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Prefix </label>
                                        <input type="text" class="form-control" name="inPrefix" value="<?php echo $value->inPrefix ?>" required>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Start No</label>
                                        <input type="text" class="form-control" name="inStart" value="<?php echo $value->inStart ?>" required>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Suffix </label>
                                        <input type="text" class="form-control" name="inSuffix" value="<?php echo $value->inSuffix ?>" required>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-12">Material Out:- </label>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Prefix </label>
                                        <input type="text" class="form-control" name="outPrefix" value="<?php echo $value->outPrefix ?>" required>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Start No</label>
                                        <input type="text" class="form-control" name="outStart" value="<?php echo $value->outStart ?>" required>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Suffix </label>
                                        <input type="text" class="form-control" name="outSuffix" value="<?php echo $value->outSuffix ?>" required>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                  <input type="submit" value="Update" class="btn btn-primary submits">
                                  <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                                </div>
                              </form>
                            </div>
                            <!-- end add modal wind-->
                        <?php
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
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Sub_department/addSubDept') ?>">
        <div class="modal-header">
          <div class="row">
            <div class="col-sm-5">
              <h5 class="modal-title">Add Godown</h5>
            </div>
            <div class="text-center col-sm-7"><span id="name-error" class="error" style="color:red;"></span></div>
          </div>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Department:- </label>
              <div class="col-sm-9">
                <select name="deptName" class="form-control">
                  <?php foreach ($department as $rec) : ?>
                    <option <?php if ($value->deptName == $rec->deptName) {
                            ?>selected<?php } ?> value="<?php echo $rec->deptName ?>"><?php echo $rec->deptName ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Godown:- </label>
              <div class="col-sm-9">
                <input type="text" class="form-control subDeptName" name="subDeptName" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Sortname:- </label>
              <div class="col-sm-9">
                <input type="text" class="form-control sortname" maxlength="15" name="sortname" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Order:- </label>
              <div class="col-sm-9">
                <input type="number" min="0" class="form-control" name="order" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Select Under</label>
              <div class="col-sm-9">
                <select name="under" class="form-control" required>
                  <option value="0">Primary</option>
                  <?php foreach ($under as $rec) : ?>
                    <option value="<?php echo $rec['id'] ?>"><?php echo $rec['sortname'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-12">Material In:- </label>
              <div class="col-sm-4">
                <label class="control-label"> Prefix </label>
                <input type="text" class="form-control" name="inPrefix" required>
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Start No</label>
                <input type="text" class="form-control" name="inStart" required>
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Suffix </label>
                <input type="text" class="form-control" name="inSuffix" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-12">Material Out:- </label>
              <div class="col-sm-4">
                <label class="control-label"> Prefix </label>
                <input type="text" class="form-control" name="outPrefix" required>
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Start No</label>
                <input type="text" class="form-control" name="outStart" required>
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Suffix </label>
                <input type="text" class="form-control" name="outSuffix" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <input type="submit" class="btn btn-primary submit">
          <a data-dismiss="modal" class="btn" href="#">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end add modal wind-->
<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/Sub_department/delete/" + id;
      }
    }
  }
</script>

<?php include('sub_js.php'); ?>