<div id="content">
  <div id="content-header">
    <div class="container-fluid">


      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-body text-center">
              <h6 class="text-center"> <i class="mdi mdi-plus"></i> SRC FORM</h6>

            </div>
          </div>
        </div>

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
                      <select class="form-control  fabricName" name="fabricName">
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
                      <a href="<?php echo base_url('admin/SRC/show_list'); ?>">

                        <h6>SRC List</h6>
                      </a>
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
                          <td><input type="text" class="form-control   code" readonly></td>
                          <td><input type="text" value="<?php echo $row['grade'] ?>" class="form-control  " readonly>
                            <input type="hidden" name="grade" value="<?php echo $row['id'] ?>"></td>
                          <td><input type="number" min="0" max="100" id="percent<?php echo $i ?>" class="form-control  " <?php if ($i == 0) {
                                                                                                                            echo "readonly";
                                                                                                                          } ?> value="0"></td>
                          <td><input type="number" min="0" name="rate" id="rate<?php echo $i ?>" class="form-control  "></td>
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

  <?php include('src_js.php'); ?>