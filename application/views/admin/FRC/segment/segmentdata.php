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
                    <table class="remove_datatable table-responsive" id="customer">
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
                      <tbody id="segment1-<?php echo $i ?>" row-id="<?php echo $i ?>">
                        <tr id="segment1-tr-<?php echo $i ?>" class="segment1-tr-<?php echo $i ?>" row-id="<?php echo $i ?>">
                          <td><input type="text" class="form-control pbc " name="pbc[]" id="pbc1-<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control fabric<?php echo $i ?>" name="fabric[]" id="fabric<?php echo $i ?>" value="<?php echo $value['fabricName'] ?>" readonly></td>
                          <td><input type="text" class="form-control length<?php echo $i ?>" name="length[]" id="length<?php echo $i ?>" value="<?php echo $value['length'] ?>" readonly></td>
                          <td><input type="text" class="form-control pcs pcs<?php echo $i ?>" name="pcs[]" id="pcs<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control tc tc1-<?php echo $i ?>" name="tc[]" id="tc1-<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control" name="rate[]" id="rate1-<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control value value<?php echo $i ?>" name="value[]" id="value<?php echo $i ?>" readonly></td>
                          <td> <button type="button" id="add_more" class="btn btn-success">+</button></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <th></th>

                          <th id="seg1-th_qty<?php echo $i ?>"></th>
                          <th id="seg1-th_pcs<?php echo $i ?>"></th>
                          <th id="seg1-th_tc<?php echo $i ?>"></th>
                          <th></th>

                          <th id="seg1-th_val<?php echo $i ?>"></th>
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
                    <table class="remove_datatable table-responsive">
                      <caption class="text-center bg-info text-white" style='caption-side : top'>
                        <h5><?php echo $value['segmentName'] ?></h5>
                      </caption>
                      <thead>
                        <tr>
                          <th>PBC</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          <th>C Qty</th>
                          <th>Remain</th>
                          <th>Rate</th>
                        </tr>
                      </thead>
                      <tbody id="segment2-<?php echo $i ?>" row-id="<?php echo $i ?>">
                        <tr id="segment2-tr-<?php echo $i ?>" row-id="<?php echo $i ?>">
                          <td><input type="text" class="form-control" name="pbc1[]" id="pbc2-<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control" id="item<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control qty<?php echo $i ?>" id="qty<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control cqty<?php echo $i ?>" name="cqty1[]" id="cqty<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control tc" id="tc<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control rate" id="rate2-<?php echo $i ?>" readonly></td>

                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <th></th>

                          <th id="seg2-th_qty<?php echo $i ?>"></th>
                          <th></th>
                          <th id="seg2-th_tc<?php echo $i ?>"></th>
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