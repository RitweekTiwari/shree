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
            <form id="jobWorkFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="name">Name</option>
                    <option value="phone_no">Phone No.</option>
                    <option value="gst">GST/URD</option>
                    <option value="deptName">Department</option>
                    <option value="subDeptName">Godown</option>
                    <option value="address">Address</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="searchValue" value="" placeholder="Search" id="searchByValue" class="form-control">
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
                <h5>Job Work Party List</h5>
              </div><hr>
              <div class="row well">
                 &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div>
              <hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table table-responsive" id="jobWork">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>GST/URD</th>
                      <th>Department</th>
                      <th>Godown</th>
                      <th>Work Type</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($party_data > 0) {
                      $id = 1;
                      foreach ($party_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $id ?></td>
                          <td><?php echo $value->name ?></td>
                          <td><?php echo $value->phone_no ?></td>
                          <td><?php echo $value->gst ?></td>
                          <td><?php echo $value->dept ?></td>
                          <td><?php echo $value->godown ?></td>
                          <td><?php echo $value->job ?></td>
                          <td><?php echo $value->address ?></td>
                          <td>
                            <a href="<?php echo '#' . $value->id; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                              <i class="fas fa-edit blue"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value->id; ?>)" data-original-title="Delete">
                              <i class="mdi mdi-delete red"></i>
                            </a>
                          </td>
                        </tr>

                        <!-- Edit modal wind-->
                        <div id="<?php echo $value->id; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Job_work_party/edit/') . $value->id; ?>">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Detail</h5>
                                  <button data-dismiss="modal" class="close" type="button">×</button>

                                </div>
                                <div class="modal-body">
                                  <div class="widget-content nopadding">

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Name</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" required value="<?php echo $value->name ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Phone/Mobile</label>
                                      <div class="col-sm-9">
                                        <input type="number" class="form-control" name="phone_no" value="<?php echo $value->phone_no ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">GST/URD</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="gst" value="<?php echo $value->gst ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Department</label>
                                      <div class="col-sm-9">
                                        <select name="deptName" class="form-control" required>
                                          <?php foreach ($dept_name as $dept) : ?>

                                            <option value="<?php echo $dept->id ?>" <?php if ($value->deptName == $dept->id) {  ?> selected <?php } ?>><?php echo $dept->deptName  ?></option>
                                          <?php endforeach; ?>

                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Godown</label>
                                      <div class="col-sm-9">
                                        <select name="subDeptName" class="form-control" required>
                                          <?php foreach ($subDept_name as $rec) : ?>
                                            <option <?php if ($value->subDeptName == $rec->id) { ?>selected <?php } ?> value="<?php echo $rec->id ?>"><?php echo $rec->subDeptName ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Job Work Type</label>
                                      <div class="col-sm-9">

                                        <select name="job_work_type" class="form-control" required>
                                          <?php foreach ($job_type_name as $job) : ?>
                                            <option <?php if ($value->job_work_type == $job->id) { ?> selected <?php } ?> value="<?php echo $job->id ?>"><?php echo $job->type ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Address</label>
                                      <div class="col-sm-9">
                                        <textarea name="address" class="form-control" cols="30" rows="5"><?php echo $value->address ?></textarea>
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
                        <!-- End Edit modal wind-->
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Job_work_party/addJob') ?>">
        <div class="modal-header">
          <h5 class="modal-title">Add Detail</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Phone/Mobile</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="phone_no" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">GST/URD</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="gst" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Department</label>
              <div class="col-sm-9">
                <select name="deptName" class="form-control" required>
                  <?php foreach ($dept_name as $rec) : ?>
                    <option value="<?php echo $rec->id; ?>"><?php echo $rec->deptName; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Godown</label>
              <div class="col-sm-9">
                <select name="subDeptName" class="form-control" required>
                  <?php foreach ($subDept_name as $rec) : ?>
                    <option value="<?php echo $rec->id; ?>"><?php echo $rec->subDeptName; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Job Work Name</label>
              <div class="col-sm-9">
                <select name="job_work_type" class="form-control" required>
                  <?php foreach ($job_type_name as $rec) : ?>
                    <option value="<?php echo $rec->id; ?>"><?php echo $rec->type; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Address</label>
              <div class="col-sm-9">
                <textarea name="address" class="form-control" cols="30" rows="5"></textarea>
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
<!-- <div class="control-group">
<label class="control-label">Rate</label>
<div class="controls">
  <label>
    <input type="checkbox" name="mtr[]" value="MTR" />
    MTR <input type="number" name="mtr[]" value="" id="">
  </label>

  <label>
    <input type="checkbox" name="saree[]" value="Saree" />
    Saree <input type="number" name="saree_rate" value="" id=""></label>

    <label>
      <input type="checkbox" name="suit" value="Suit" />
      Suit <input type="number" name="suit_rate" value="" id="">
    </label>

    <label>
      <input type="checkbox" name="dupatta" value="Dupatta" />
      Dupatta <input type="number" name="dupatta_rate" value="" id="">
    </label>

  </div>
</div> -->
<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/Job_work_party/delete/" + id;
      }

    }
  }
</script>

<?php include('job_js.php'); ?>