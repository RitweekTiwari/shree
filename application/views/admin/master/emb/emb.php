<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
        <!-- add modal wind-->

        <div class="card container">

          <div class="card-body">
            <form class="form-horizontal" method="post" action="<?php echo base_url('admin/EMB/add_emb') ?>" name="basic_validate" novalidate="novalidate">
              <div class="card-header">
                <h5 class="card-title">Add Detail</h5>

              </div>

              <div class="form-group row">
                <label class="control-label col-sm-6">Design</label>
                <label class="control-label col-sm-6">EMB Rate</label>
                <div class="col-sm-6">
                  <select name="design" class="form-control select2" id="desname">
                    <option value="">Select Design</option>
                    <?php foreach ($erc as $value) : ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['desName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-sm-6">
                  <input type="text" name="embrate" class="form-control" value="" id="rate" readonly>
                </div>
              </div>

              <hr>
              <div class="row">
                <label class="col-md-4">Job Worker</label><label class="col-md-2">Rate</label> <label class="col-md-4">Job Worker</label><label class="col-md-2">Rate</label>
                <?php foreach ($worker as $value) : ?>
                  <div class="col-md-4">
                    <select name="job[]" class="form-control" readonly>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <input type="number" class="form-control" name="rate[]" min="0" value="0" step="0.01">
                  </div>


                <?php endforeach; ?>
              </div>




              <div class=" float-right">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="submit" class="btn btn-primary">
              </div>

            </form>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-12">
          <div class="card">

          </div>
          <div class="row">
            <div class="col-8">
              <div class="card">
                <div class="card-body">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                      <h5>Emb List</h5>
                    </div>
                    <hr>
                    <div class="row well">
                      &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                    </div>
                    <hr>
                    <div class="widget-content nopadding">
                      <table class="table table-striped table-bordered data-table" id="jobWorktype">
                        <thead>
                          <tr>
                            <th><input type="checkbox" class="sub_chk" id="master"></th>
                            <th>S/No</th>
                            <th>Design</th>
                            <!-- <th>Rate</th> -->
                            <th>View</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($emb > 0) {
                            $id = 1;
                            foreach ($emb as $value) { ?>
                              <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['id'] ?>"></td>
                                <td><?php echo $id ?></td>
                                <td><?php foreach ($erc_value as $row) : ?>
                                    <?php if ($value['designName'] == $row['id']) {
                                        echo $row['desName'];
                                      } ?>
                                  <?php endforeach; ?></td>

                                <!-- <td><?php echo $value['embrate'] ?></td> -->

                                <td>
                                  <a href="<?php echo base_url('admin/emb/view_worker/') . $value['id'] ?>" class="text-center tip" data-original-title="View">
                                    <i class="fas fa-eye blue"></i>
                                  </a>

                                </td>
                                <td>
                                  <a href="<?php echo base_url('admin/EMB/get_emb_details/') . $value['id'] ?>" class="text-center tip" data-original-title="Edit">
                                    <i class="fas fa-edit blue"></i>
                                  </a>
                                  &nbsp;&nbsp;&nbsp;
                                  <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value['id']; ?>)" data-original-title="Delete">
                                    <i class="mdi mdi-delete red"></i>
                                  </a>
                                </td>
                              </tr>



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

            <div class="col-4">

              <div class="card">
                <div class="card-body">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                      <h5>Emb Design List</h5>
                    </div>

                    <div class="widget-content nopadding">
                      <table class="table table-striped table-bordered data-table" id="jobWorktype">
                        <thead>
                          <tr>

                            <th>S/No</th>
                            <th>Design</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($erc > 0) {
                            $id = 1;
                            foreach ($erc as $value) { ?>
                              <tr class="gradeU">
                                <td><?php echo $id ?></td>
                                <td> <?php echo $value['desName'] ?></td>

                              </tr>
                          <?php $id = $id + 1;
                            }
                          } ?>


                    </div>
                  </div>
                  <!-- End Edit modal wind-->

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
</div>
</div>
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/EMB/delete/" + id;
      }

    }
  }
</script>
<style>
  #DataTables_Table_0_previous {
    display: none;
  }

  #DataTables_Table_0_paginate {
    display: none;
  }

  select {
    width: 120px;
    height: 35px;
    box-sizing: border-box;
    border-color: #e9ecef;
  }
</style>

<?php include('emb_js.php'); ?>