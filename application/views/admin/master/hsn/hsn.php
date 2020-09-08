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
            <form id="hsnFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="hsn_code">HSN Code</option>
                    <option value="unit">Unit</option>
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
                <h5>HSN List</h5>
              </div><hr>
              <div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div><hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="hsn">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>HSN Code</th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($hsn_data > 0) {
                      $id = 1;
                      foreach ($hsn_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $id ?></td>
                          <td><?php echo $value->hsn_code ?></td>
                          <td><?php echo $value->unit ?></td>
                          <td>
                            <a href="<?php echo '#' . $value->id; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                              <i class="fas fa-edit blue"></i>
                            </a>

                            <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value->id; ?>)" data-original-title="Delete">
                              <i class="mdi mdi-delete red"></i>
                            </a>
                          </td>
                        </tr>
                        <!-- add modal wind-->
                        <div id="<?php echo $value->id; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/hsn/edit/') . $value->id ?>">
                                <div class="control-group">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit HSN</h5>
                                    <button data-dismiss="modal" class="close" type="button">×</button>

                                  </div>
                                  <div class="modal-body">
                                    <div class="widget-content nopadding">
                                      <div class="form-group row">
                                        <label class="control-label col-sm-3">HSN Code</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="hsn_code" value="<?php echo $value->hsn_code ?>" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="control-label col-sm-3">Select Unit Name</label>
                                        <div class="col-sm-9">

                                          <select name="unit" class="form-control" required>

                                            <?php foreach ($unit_data as $unit_value) : ?>
                                              <option <?php if ($value->unit == $unit_value->unitSymbol) {
                                                      ?>selected<?php } ?> value="<?php echo $unit_value->unitSymbol ?>"><?php echo $unit_value->unitSymbol ?></option>
                                            <?php endforeach; ?>
                                          </select>

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
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/hsn/addHsn') ?>">
        <div class="control-group">
          <div class="modal-header">
            <h5 class="modal-title">Add HSN</h5>
            <button data-dismiss="modal" class="close" type="button">×</button>
          </div>
          <div class="modal-body">
            <div class="widget-content nopadding">
              <div class="form-group row">
                <label class="control-label col-sm-3">HSN Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="hsn_code" value="" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Select Unit</label>
                <div class="col-sm-9">
                  <select name="unit" class="form-control" required>

                    <?php foreach ($unit_data as  $value) : ?>

                      <option value="<?php echo $value->unitSymbol ?>"><?php echo $value->unitSymbol ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
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
        window.location = "<?php echo base_url() ?>admin/HSN/delete/" + id;
      }
    }
  }
</script>

<?php include('hsn_js.php'); ?>