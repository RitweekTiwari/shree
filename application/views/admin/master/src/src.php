<div id="content">
  <div id="content-header">
    <div id="accordion1">

      <div class="modal-content">
        <div class="modal-header">
          <a class="card-link" data-toggle="collapse" href="#collapse3">
            <h6 class="text-center"> <i class="mdi mdi-plus"></i> SRC FORM</h6>
          </a>
        </div>
        <div id="collapse3" class="collapse " data-parent="#accordion1">
          <div class="modal-body">
            <div class="container-fluid">


              <div class="row">

                <div class="col-md-8">
                  <div class="card">
                    <div class="card-body">
                      <h5 class=" text-center">SRC CREATION</h5>
                      <hr>
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label class="col-sm-4">FABRIC NAME:- </label>
                          <div class="col-sm-8">
                            <select class="form-control  fabricName" name="fabricName" id='fabricName'>
                              <option value="">Select Fabric</option>
                              <?php foreach ($fresh_fabricname as $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['fabricName']; ?></option>

                              <?php } ?>

                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-4">OLD PURCHASE RATE:-</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control  " id="oldRate" value="">
                          </div>
                          <label class="col-sm-4">LAST PURCHASE RATE:-</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control  " id="lastRate">
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                          <label class="col-sm-4">Update Fabric Rate:-</label>
                          <div class="col-sm-3">
                            <select class="form-control  " id="operation">
                              <option value="">Select one</option>
                              <option value="+">Add +</option>
                              <option value="-">Sub -</option>

                            </select>
                          </div>

                          <div class="col-sm-3">
                            <input type="number" min="0" class="form-control" id="new_rate">
                          </div>
                          <div class="col-sm-2">
                            <input type="BUTTON" class="btn btn-danger text-right" value="update" id='update'>
                          </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                          <label class="col-sm-4">CODE:-</label>
                          <div class="col-sm-4">
                            <select class="form-control  " name="code" id="code1">
                              <option value="">Select Code</option>
                              <?php foreach ($code as $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['fbcode']; ?></option>

                              <?php } ?>

                            </select>

                          </div>
                          <div class="col-sm-2">
                            <a href="<?php echo base_url('admin/FbCode') ?>" target="_blank">Add Code</a>
                          </div>
                          <div class="col-sm-2">
                            <a href="<?php echo base_url('admin/Grade') ?>" target="_blank">Add Grade</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-8">

                          </div>
                          <div class="col-sm-2"><input type="BUTTON" class="btn btn-warning text-right" value="Clear"></div>


                          <div class="col-sm-1"><input type="BUTTON" class="btn btn-primary text-right" value="Next" id='next'>
                          </div>
                        </div>
                        <div id="FormGrade">
                          <hr>
                          <h5 class="">ADD GRADE</h5>
                          <table class="">

                            <tr>
                              <th style="font-weight:bold;">CODE </th>
                              <th style="font-weight:bold;">GRADE</th>
                              <th style="font-weight:bold;">%of A sale rate</th>
                              <th style="font-weight:bold;">SALE RATE</th>
                            </tr>
                            <?php $i = 0;
                            foreach ($grade as $row) { ?>
                              <tr id="tr<?php echo $row['id'] ?>">
                                <td><input type="text" class="form-control   code" readonly <?php if ($i == 0) {
                                                                                              echo 'name="code2"';
                                                                                            } ?>></td>
                                <td><input type="text" value="<?php echo $row['grade'] ?>" class="form-control  " readonly>
                                  <input type="hidden" name="grade" value="<?php echo $row['id'] ?>"></td>
                                <td><input type="number" min="0" max="100" id="percent<?php echo $i ?>" class="form-control  percent" <?php if ($i == 0) {
                                                                                                                                        echo "readonly";
                                                                                                                                      } ?> value="0"></td>
                                <td><input type="number" min="0" name="rate" id="rate<?php echo $i ?>" class="form-control  rate"></td>
                              </tr>
                            <?php $i += 1;
                            } ?>

                          </table>
                          <hr>
                          <div>
                            <div class="span4 text-right"><INPUT TYPE="button" VALUE="ADD" id="add_src" class="btn btn-primary "></div>

                          </div>
                        </div>
                      </form>


                    </div>

                  </div>

                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>New Fabric List</h5>
                      </div>
                      <hr>
                      <table class=" data-table table-bordered">
                        <thead>
                          <tr>
                            <th>Fabric_Name</th>
                            <th>Last_code_Rate </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($fresh_fabricname as $value) { ?>
                            <tr class="gradeU order_row">

                              <td><?php echo $value['fabricName']; ?></td>

                              <td><?php echo $value['code_rate']; ?></td>

                            </tr>

                          <?php } ?>


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
  <hr>
  <div class="container-fluid">
    <div class='row'>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">SRC LIST</h4>
            <hr>
            <div id="accordion">

              <div class="modal-content">
                <div class="modal-header">
                  <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    Simple filter
                  </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                  <div class="modal-body">
                    <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
                      <div class="form-row">
                        <div class="col-2">
                          <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                        </div>
                        <div class="col-2">

                          <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="col-2">

                          <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                            <option value="">-- Select Category --</option>
                            <option value="sb1.subDeptName">Party Name</option>
                            <option value="challan_no">Challan no</option>
                            <option value="doc_challan">Doc Challan </option>
                            <option value="fabric_type">Fabric Type</option>
                            <option value="total_quantity">Quantity</option>
                            <option value="total_amount">Total amount</option>
                          </select>
                        </div>
                        <div class="col-2">

                          <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                        </div>
                        <input type="hidden" name="type" value="recieve"><input type="hidden" name="search" value="simple">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" name="search" value="simple" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal-content">
                <div class="modal-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                    Advance filter
                  </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="modal-body">
                    <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
                      <table class=" remove_datatable">
                        <caption>Advance Filter</caption>
                        <thead>
                          <tr>
                            <th>Date_from</th>
                            <th>Date_to</th>
                            <th>Party Name</th>
                            <th>Challan No</th>
                            <th>Doc Challan</th>
                            <th>Fab Type</th>
                            <th>Total Quan</th>
                            <th>TotalAmount</th>
                          </tr>
                        </thead>
                        <tr>
                          <td>
                            <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                          <td>
                            <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>

                          <td><input type="text" name="sb1.subDeptName" class="form-control form-control-sm" value="" placeholder="Party Name">
                          </td>

                          <td><input type="text" name="challan_no" class="form-control form-control-sm" value="" placeholder="challan">
                          </td>

                          <td>
                            <input type="text" name="doc_challan" class="form-control form-control-sm" value="" placeholder="DocChallan">
                          </td>
                          <td>
                            <input type="text" name="fabric_type" class="form-control form-control-sm" value="" placeholder="FabType"></td>
                          <td>
                            <input type="text" name="total_quantity" class="form-control form-control-sm" value="" placeholder="TotalQuan "></td>
                          <td>
                            <input type="text" name="total_amount" class="form-control form-control-sm" value="" placeholder="TotalAmount "></td>
                        </tr>

                      </table>
                      <input type="hidden" name="type" value="recieve"><input type="hidden" name="search" value="advance">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" name="search" value="advance" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row well">
              <div class="col-6"> <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;<a type="button" class="btn btn-info   btn-success" href='<?php echo base_url('/admin/FRC/showRecieveList'); ?>' style="color:#fff;">Clear filter</a>
              </div>
              <div class="col-6">

                <form action="<?php echo base_url('/admin/FRC/showRecieveList'); ?>" method="post">

                  <div class="form-row ">
                    <div class="col-5">
                      <label>Date From</label>
                      <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                    </div>
                    <div class="col-5">
                      <label>Date To</label>
                      <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="col-2">
                      <label>Search</label>
                      <input type="hidden" name="type" value="recieve">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <hr>
            <table class="data-table table-bordered">
              <thead>
                <th><input type="checkbox" class="sub_chk" id="master"></th>
                <th>fabric</th>
                <th>code</th>
                <?php foreach ($grade as $value) : ?>
                  <th><?php echo $value['grade']; ?></th>
                <?php endforeach; ?>
              </thead>
              <tbody>
                <?php if (isset($output)) {
                  foreach ($output as $val) : ?>
                    <tr>
                      <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['id'] ?>"> </td>
                      <td><?php echo $val['fabric'] ?></td>
                      <td><?php echo $val['code'] ?></td>

                      <?php foreach ($grade as $value) : ?>
                        <?php if (array_key_exists($value['grade'], $val['grade'])) : ?>
                          <td><?php echo $val['grade'][$value['grade']]; ?></td>
                        <?php else : ?>
                          <td>N/A</td>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </tr>
                <?php endforeach;
                } else {
                  echo "No Result Found";
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('src_js.php'); ?>