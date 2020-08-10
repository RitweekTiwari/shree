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
            <form id="CustomerFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="name">Name</option>
                    <option value="phone_no">Phone No.</option>
                    <option value="email">Email</option>
                    <option value="under_branch">Under Branch</option>
                    <option value="address">Address</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="searchValue" class="form-control" value="" placeholder="Search" id="searchByValue">
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
                <h5>Customer Details List</h5>
              </div>
              <div class="row well">
                <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              </div>
              <div class="widget-content nopadding">

                <table class="table table-striped table-bordered data-table" id="customer">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Grade</th>
                      <th>Address</th>
                      <th>Under Branch</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($cust_data > 0) {
                      $id = 1;
                      foreach ($cust_data as $value) { ?>
                        <tr class="gradeU" id="tr_<?php echo $value->id ?>">
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                          <td><?php echo $id ?></td>
                          <td><?php echo $value->name ?></td>
                          <td><?php echo $value->phone_no ?></td>
                          <td><?php echo $value->email ?></td>
                          <td><?php echo $value->grade ?></td>
                          <td><?php echo $value->address ?></td>
                          <td><?php echo $value->bname ?></td>
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

                        <div id="<?php echo $value->id; ?>" class="modal hide">
                          <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Customer_detail/edit/') . $value->id ?>" name="" novalidate="novalidate">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Detail</h5>
                                  <button data-dismiss="modal" class="close" type="button">×</button>

                                </div>
                                <div class="modal-body">
                                  <div class="widget-content nopadding">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Name</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="<?php echo $value->name ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Phone Number</label>
                                      <div class="col-sm-9">
                                        <input type="number" class="form-control" name="phone_no" value="<?php echo $value->phone_no ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Email</label>
                                      <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" value="<?php echo $value->email ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Grade</label>
                                      <div class="col-sm-9">
                                        <input type="text" name="grade" class="form-control" value="<?php echo $value->grade ?>">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Under Branch</label>
                                      <div class="col-sm-9">
                                        <select name="under_branch" class="form-control">
                                          <?php foreach ($branch_name as $rec) : ?>
                                            <option <?php if ($value->under_branch == $rec->id) {
                                                    ?>selected<?php } ?> value="<?php echo $rec->id ?>"><?php echo $rec->name ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Address</label>
                                      <div class="col-sm-9">
                                        <textarea name="address" class="form-control" cols="30" rows="5"><?php echo $value->address ?>
                                </textarea>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                  <input type="submit" value="Update" class="btn btn-primary">
                                  <!-- <input type="hidden" name="role" value="<?php echo $value->id; ?>"> -->
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
<!-- </div>
</div> -->

<!-- add modal wind-->
<div id="addnew" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Customer_detail/addCust') ?>" name="basic_validate" novalidate="novalidate">
        <div class="modal-header">
          <h5 class="modal-title">Add Detail</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>

        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">

            <div class="form-group row">
              <label class="control-label col-sm-3">Name</label>
              <div class="controls col-sm-9">
                <input type="text" class="form-control" name="name" value="" id="customername">
                <span id="customername-error" class="error" style="color:red;"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Phone Number</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="phone_no" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Grade</label>
              <div class="col-sm-9">
                <input type="test" class="form-control" name="grade" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Under Branch</label>
              <div class="col-sm-9">
                <select name="under_branch" class="form-control">
                  <?php foreach ($branch_name as $rec) : ?>
                    <option value="<?php echo $rec->id; ?>"> <?php echo $rec->name; ?> </option>
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
          <input type="submit" class="btn btn-primary" id="customerSubmit">
          <a data-dismiss="modal" class="btn" href="#">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function delete_detail(id) {
      var del = confirm("Do you want to Delete");
      if (del == true) {
        var sureDel = confirm("Are you sure want to delete");
        if (sureDel == true) {
          window.location = "<?php echo base_url() ?>admin/Customer_detail/delete/" + id;
        }

      }
    }
  </script>
  <?php include('customer_js.php'); ?>