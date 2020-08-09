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
                    <option value="">-- Select Category --</option>
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
              <div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="subDept">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Department</th>
                      <th>Godown</th>
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
                      $id = 1;
                      foreach ($sub_dept_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $id ?></td>
                          <td><?php echo $value->deptName ?></td>
                          <td><?php echo $value->subDeptName ?></td>
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
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Sub_department/edit/') . $value->id ?>" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
                                        <select name="deptName" class="form-control" required="">
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
                                        <input type="text" class="form-control" name="subDeptName" value="<?php echo $value->subDeptName ?>" id="required">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-12">Material In:- </label>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Prefix </label>
                                        <input type="text" class="form-control" name="inPrefix" value="<?php echo $value->inPrefix ?>" id="" required="required">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Start No</label>
                                        <input type="text" class="form-control" name="inStart" value="<?php echo $value->inStart ?>" id="" required="required">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Suffix </label>
                                        <input type="text" class="form-control" name="inSuffix" value="<?php echo $value->inSuffix ?>" id="" required="required">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-12">Material Out:- </label>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Prefix </label>
                                        <input type="text" class="form-control" name="outPrefix" value="<?php echo $value->outPrefix ?>" id="" required="required">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Start No</label>
                                        <input type="text" class="form-control" name="outStart" value="<?php echo $value->outStart ?>" id="" required="required">
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="control-label"> Suffix </label>
                                        <input type="text" class="form-control" name="outSuffix" value="<?php echo $value->outSuffix ?>" id="" required="required">
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
                            <!-- end add modal wind-->
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
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Sub_department/addSubDept') ?>" name="basic_validate" id="basic_validate" novalidate="novalidate">
        <div class="modal-header">
          <h5 class="modal-title">Add Godown</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Department:- </label>
              <div class="col-sm-9">
                <select name="deptName" class="form-control" required="">
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
                <input type="text" class="form-control" name="subDeptName" value="" id="required" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-12">Material In:- </label>
              <div class="col-sm-4">
                <label class="control-label"> Prefix </label>
                <input type="text" class="form-control" name="inPrefix" value="" id="" required="required">
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Start No</label>
                <input type="text" class="form-control" name="inStart" value="" id="" required="required">
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Suffix </label>
                <input type="text" class="form-control" name="inSuffix" value="" id="" required="required">
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-12">Material Out:- </label>
              <div class="col-sm-4">
                <label class="control-label"> Prefix </label>
                <input type="text" class="form-control" name="outPrefix" value="" id="" required="required">
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Start No</label>
                <input type="text" class="form-control" name="outStart" value="" id="" required="required">
              </div>
              <div class="col-sm-4">
                <label class="control-label"> Suffix </label>
                <input type="text" class="form-control" name="outSuffix" value="" id="" required="required">
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