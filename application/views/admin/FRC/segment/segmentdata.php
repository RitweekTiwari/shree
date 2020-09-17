<div class="card">
  <div class="card-body">
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h5>Segment List</h5>
      </div>
      <hr>

      <div class="widget-content nopadding">
        <div class="row">
          <?php if (isset($segment)) { ?>
            <table class="table-responsive">


              <tr>
                <?php $i = 0;
                foreach ($segment as $value) : ?>
                  <td>
                    <table class="remove_datatable" id="customer">
                      <caption class="text-center bg-success text-white" style='caption-side : top'>
                        <h5><?php echo $value['segmentName'] ?></h5>
                      </caption>
                      <thead>
                        <tr>
                          <th>PBC</th>
                          <th>Fabric</th>
                          <th>Length</th>
                          <th>PCS</th>
                          <th>TC</th>
                          <th>Rate</th>

                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="segment1-<?php echo $i ?>" row-id="<?php echo $i ?>">
                          <td><input type="text" class="form-control pbc" name="pbc" id="pbc1-<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control fabric" name="fabric" id="fabric<?php echo $i ?>" value="<?php echo $value['fabricName'] ?>" readonly></td>
                          <td><input type="text" class="form-control length" name="length" id="length<?php echo $i ?>" value="<?php echo $value['length'] ?>" readonly></td>
                          <td><input type="number" class="form-control pcs" name="pcs" id="pcs<?php echo $i ?>" value=""></td>
                          <td><input type="text" class="form-control" name="tc" id="tc1-<?php echo $i ?>" value=""></td>
                          <td><input type="number" class="form-control" name="rate" id="rate1-<?php echo $i ?>" value="" readonly></td>
                          <td><input type="number" class="form-control" name="value" id="value<?php echo $i ?>" value="" readonly></td>
                          <td> <button type="button" id="add_more" class="btn btn-success">+</button></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                <?php $i++;
                endforeach; ?>
              </tr>
            </table>
          <?php } else { ?>
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5 style="color:red;"> No Segment </h5>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
        <h5>Segment List</h5>
      </div>
      <hr>

      <div class="widget-content nopadding">
        <div class="row">
          <?php if (isset($segment)) { ?>
            <table class="table-responsive">


              <tr>
                <?php $i = 0;
                foreach ($segment as $value) : ?>
                  <td>
                    <table class="remove_datatable">
                      <caption class="text-center bg-info text-white" style='caption-side : top'>
                        <h5><?php echo $value['segmentName'] ?></h5>
                      </caption>
                      <thead>
                        <tr>
                          <th>PBC</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          <th>C Qty</th>
                          <th>TC</th>
                          <th>Rate</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="<?php echo $i ?>">
                          <td><input type="text" class="form-control" name="pbc" id="pbc2-<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control" name="item" id="item<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control " name="qty" id="qty<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control cqty" name="cqty" id="cqty<?php echo $i ?>" value="" readonly></td>
                          <td><input type="text" class="form-control tc" name="tc1" id="tc<?php echo $i ?>" value="" ></td>
                          <td><input type="text" class="form-control rate" name="rate" id="rate2-<?php echo $i ?>" value="" readonly></td>

                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <th></th>
                          <th></th>
                          <th id="th_qty<?php echo $i ?>"></th>
                          <th id="th_tc<?php echo $i ?>"></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </td>
                <?php $i++;
                endforeach; ?>
              </tr>
            </table>
          <?php } else { ?>
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5 style="color:red;"> No Segment </h5>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>


</script>