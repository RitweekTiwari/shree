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
            <form id="PercentFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="fabric.fabricName">fabric</option>
                    <option value="grade.grade">Grade</option>
                    <option value="gpercent.percent">percent</option>
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
              <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                <h5>Grade List</h5>
              </div>
              <hr>
              <div class="row well">
                <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div>
              <hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="gradepercent">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Fabric</th>
                      <th>Grade</th>
                      <th>Percent</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($grade_percent > 0) {
                      $id = 1;
                      foreach ($grade_percent as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value['id'] ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['id'] ?>"></td>
                          <td><?php echo $id; ?></td>
                          <td><?php 
                                  echo $value['fabricName'];
                               ?></td>

                          <td><?php 
                                  echo $value['grade'];
                                ?>
                          </td>
                          <td><?php echo $value['percent'];  ?></td>
                          <td>
                            <a href="<?php echo '#' . $value['id']; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                              <i class="fas fa-edit blue"></i>
                            </a>

                            <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value['id']; ?>)" data-original-title="Delete">
                              <i class="mdi mdi-delete red"></i>
                            </a>
                          </td>
                        </tr>

                        <!-- add edit modal wind-->
                        <div id="<?php echo $value['id']; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/GradePercent/edit/') . $value['id']; ?>" name="basic_validate" id="basic_validate" novalidate="novalidate">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Grade Percent</h5>
                                  <button data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <div class="modal-body">
                                  <div class="widget-content nopadding">
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Fabric Name</label>
                                      <div class="col-sm-9">
                                        <select  name="fabric" class="form-control">
                                          <option value="">-- Select Fabric --</option>
                                          <?php foreach ($fabric_data as $row) : ?>
                                            <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $value['fabric']) {
                                                                                        echo "selected";
                                                                                      } ?>><?php echo $row['fabricName'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Grade </label>
                                      <div class="col-sm-9">
                                        <select id="searchByCat" name="grade" class="form-control">
                                          <option value="">-- Select Grade--</option>
                                          <?php foreach ($grade_data as $row) : ?>
                                            <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $value['grade']) {
                                                                                        echo "selected";
                                                                                      } ?>><?php echo $row['grade'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Percent</label>
                                      <div class="col-sm-9">
                                        <input type="number" min="0" max="100" class="form-control" name="percent" value="<?php echo $value['percent']; ?>" id="required">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" value="Update" class="btn btn-primary">
                                  <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- end edit modal wind-->
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
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/GradePercent/addGradepercent') ?>" name="basic_validate" id="basic_validate" novalidate="novalidate">
        <div class="modal-header">
          <h5 class="modal-title">Add Grade Percent</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>

        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Fabric Name</label>
              <div class="col-sm-9">
                <select  name="fabric" class="form-control select2" required>
                  <option value="">-- Select Fabric --</option>
                  <?php foreach ($fabric_data as $value) : ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['fabricName'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <?php foreach ($grade_data as $value) : ?>
              <div class="form-group row">
                <label class="control-label col-sm-3">Grade </label>
                <div class="col-sm-3">
                  <select id="searchByCat" name="grade[]" class="form-control ">
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['grade'] ?></option>

                  </select>
                </div>

                <label class="control-label col-sm-3">Percent</label>
                <div class="col-sm-3">
                  <input type="number" min="0" max="100" class="form-control" name="percent[]"  required>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <input type="submit" class="btn btn-primary">
          <a data-dismiss="modal" class="btn " href="#">Cancel</a>
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
        window.location = "<?php echo base_url() ?>admin/GradePercent/delete/" + id;
      }

    }
  }
</script>
<?php include('percent_js.php'); ?>