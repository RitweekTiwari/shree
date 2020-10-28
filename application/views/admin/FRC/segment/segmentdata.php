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
                  <td class="align-top " style="width:700px">
                    <table class="remove_datatable table-responsive" id="customer" style="height:200px; overflow-y: scroll;width:700px; overflow-x: scroll;">
                      <caption class="text-center bg-success text-white" style='caption-side : top'>
                        <h5><?php echo $value['segmentName'] ?></h5>
                      </caption>
                      <thead>
                        <tr>
                          <th>PBC</th>
                          <th>Select_Fabric</th>
                          <th>Length</th>
                          <th>PCS</th>
                          <th>TC</th>
                          <th>Rate</th>

                          <th>Value</th>
                        </tr>
                      </thead>
                      <tbody id="segment1-<?php echo $i ?>" class="segment1" row-id="<?php echo $i ?>">
                        <tr id="segment1-tr-<?php echo $i ?>" class="segment1-tr" row-id="<?php echo $i ?>">
                          <td><input type="text" class="form-control pbc " name="pbc[]" id="pbc1-<?php echo $i ?>" data-id="<?php echo json_encode($value['fab'])  ?>"></td>
                          <td><select class="form-control fabric<?php echo $i ?>" name="fabric[]" id="fabric<?php echo $i ?>">
                              <option value="0">select</option>
                              <?php foreach ($value['fab'] as $row) { ?> <option value="<?php echo $row['fabricid'] ?>"><?php echo $row['fabric'] ?>
                                </option> <?php  } ?>
                            </select></td>
                          <td style="width:15%"><input type="number" class="form-control length length<?php echo $i ?>" name="length[]" id="length<?php echo $i ?>" max="<?php echo $value['max'] ?>" min="<?php echo $value['min'] ?>" value="<?php echo $value['length'] ?>"></td>
                          <td><input type="text" class="form-control pcs pcs<?php echo $i ?>" name="pcs[]" id="pcs<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control tc tc1-<?php echo $i ?>" name="tc[]" id="tc1-<?php echo $i ?>"></td>
                          <td><input type="text" class="form-control" name="rate[]" id="rate1-<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control value value<?php echo $i ?>" name="value[]" id="value<?php echo $i ?>" readonly></td>
                          <input type="hidden" class="min<?php echo $i ?>" value="<?php echo $value['min'] ?>"><input type="hidden" class="max<?php echo $i ?>" value="<?php echo $value['max'] ?>">
                          <td> <button type="button" value="1212" class="btn btn-success add_more">+</button></td>
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
                  <td class="align-top" style="width:700px;overflow-x: scroll;">
                    <table class="remove_datatable table-responsive" style="width:700px; overflow-x: scroll;height:200px; overflow-y: scroll;">
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
                          <td><input type="text" class="form-control pbc" id="pbc2-<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control" id="item<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control qty<?php echo $i ?>" id="qty<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control cqty<?php echo $i ?> cqty" name="cqty1[]" id="cqty<?php echo $i ?>" readonly></td>
                          <td><input type="text" class="form-control tc" id="tc<?php echo $i ?>" readonly></td>
                          <td><button type="button" class="btn btn-secondary update">update</button></td>

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