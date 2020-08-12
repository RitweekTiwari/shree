<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div id="accordion">

        <div class="modal-content">
          <div class="modal-header text-center">
            <a class="card-link " data-toggle="collapse" href="#collapseOne">
              <h6> <i class="mdi mdi-plus"></i> SRC FORM</h6>

            </a>
          </div>
          <div id="collapseOne" class="collapse " data-parent="#accordion">
            <div class="row">

              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <h5 class=" text-center">SRC CREATION</h5><br>
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label class="col-sm-4">FABRIC NAME:- </label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm fabricName" name="fabricName">
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
                          <input type="text" class="form-control form-control-sm " id="oldRate" value="">
                        </div>
                        <label class="col-sm-4">LAST PURCHASE RATE:-</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control form-control-sm " id="lastRate">
                        </div>
                      </div>



                      <div class="form-group row">
                        <label class="col-sm-4">CODE:-</label>
                        <div class="col-sm-8">
                          <select class="form-control form-control-sm " name="code" id="code1">
                            <option value="">Select Code</option>
                            <?php foreach ($code as $value) { ?>
                              <option value="<?php echo $value['id']; ?>"><?php echo $value['fbcode']; ?></option>

                            <?php } ?>

                          </select>

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
                            <tr>
                              <td><input type="text" class="form-control form-control-sm  code" readonly></td>
                              <td><input type="text" value="<?php echo $row['grade'] ?>" class="form-control form-control-sm " readonly>
                                <input type="hidden" name="grade" value="<?php echo $row['id'] ?>"></td>
                              <td><input type="number" min="0" max="100" id="percent<?php echo $i ?>" class="form-control form-control-sm " <?php if ($i == 0) {
                                                                                                                                              echo "readonly";
                                                                                                                                            } ?> value="0"></td>
                              <td><input type="number" min="0" name="rate" id="rate<?php echo $i ?>" class="form-control form-control-sm "></td>
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
                    <table class=" data-table">
                      <thead>
                        <tr>
                          <th>Fabric Name</th>
                          <th>LAST PURCHASE RATE </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($fresh_fabricname as $value) { ?>
                          <tr class="gradeU order_row">

                            <td><?php echo $value['fabricName']; ?></td>

                            <td><?php echo $value['sale_rate']; ?></td>

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
  <hr>
  <div class="container-fluid">
    <div class='row'>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">SRC LIST</h4>
            <hr>
            <table class="data-table table-bordered">
              <thead>
                <th>fabric</th>
                <th>code</th>
                <?php foreach ($grade as $value) : ?>
                  <th><?php echo $value['grade']; ?></th>
                <?php endforeach; ?>
              </thead>
              <tbody>
                <?php foreach ($output as $val) : ?>
                  <tr>
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

<?php include('src_js.php'); ?>