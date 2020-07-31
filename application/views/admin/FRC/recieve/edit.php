<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/FRC/save') ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Edit Recieve Chalan</h5>
            </div>
            <div class="col-6 ">
              <h6> Challan No - <span class="label label-info"> <?php echo $frc_data[0]['challan_no'] ?></span> </h6>
            </div>
            <div class="modal-body">
              <div class="row">


                <div class="col-md-3">
                  <label>From Godown</label>
                  <select name="fromGodown" class="form-control" id='Select_Session' required>
                    <option>Select Godown</option>
                    <?php foreach ($sub_dept_data as $value) : ?>
                      <option value="<?php echo $value->id; ?>" <?php if ($frc_data[0]['sub1'] == $value->subDeptName) {
                                                                  echo "selected";
                                                                } ?>> <?php echo $value->subDeptName; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>To Godown</label>
                  <select name="toGodown" class="form-control" id="Select_Category" required>
                    <option>Select Godown </option>
                    <?php foreach ($sub_dept_data as $value) : ?>
                      <option value="<?php echo $value->id ?>" <?php if ($frc_data[0]['sub2'] == $value->subDeptName) {
                                                                  echo "selected";
                                                                } ?>> <?php echo $value->subDeptName; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>DATE</label>
                  <input type="date" class="form-control" name="PBC_date" value="<?php echo $frc_data[0]['challan_date'] ?>" required>
                </div>
                <div class="col-md-3">
                  <label>Doc Challan No</label>
                  <input type="text" class="form-control" name="Doc_challan" value="<?php echo $frc_data[0]['doc_challan'] ?>" required>
                </div>
                <input type="hidden" name="fc_id" value="<?php echo $frc_data[0]['fc_id'] ?>">
              </div>
              <hr>
              <table class=" remove_datatable">
                <thead>

                  <th>S no</th>
                  <th>pbc</th>
                  <th style='width:20%'>Fabric_name</th>
                  <th style='width:10%'>Hsn</th>
                  <th>Fab_Type</th>
                  <th>Quantity</th>
                  <th>Unit </th>
                  <th>Color </th>
                  <th>AD NO</th>

                  <th>P code</th>
                  <th>P Rate</th>
                  <th style='width:10%'>T Value</th>


                </thead>
                <tbody>
                  <?php $count = 0;
                  $total_qty = 0.00;
                  $total_val = 0.00;
                  foreach ($pbc as $row) {
                    $count++;
                    $total_qty += $row['stock_quantity'];
                    $total_val += $row['total_value'] ?>
                    <tr id="<?php echo $count ?>">

                      <td><?php echo $count ?></td>
                      <td><input type="text" class="form-control " name="pbc[]" value="<?php echo $row['parent_barcode'] ?>" id="pbc<?php echo $count ?>" readonly></td>
                      <td style='width:20%'><select name="fabric_name[]" class="form-control fabric_name " required>
                          <option>Fabric</option>
                          <?php foreach ($febName as $value) : ?>
                            <option value="<?php echo $value->id; ?>" <?php if ($row['fabric_id'] == $value->id) {
                                                                        echo "selected";
                                                                      } ?>> <?php echo $value->fabricName; ?></option>
                          <?php endforeach; ?>
                        </select> </td>
                      <td style='width:10%'><input type="text" class="form-control " name="hsn[]" value="<?php echo $row['hsn'] ?>" id="hsn<?php echo $count ?>" readonly></td>
                      <td><input type="text" class="form-control" name="fabType[]" value="<?php echo $row['fabric_type'] ?>" readonly id='fabType<?php echo $count ?>'></td>
                      <td><input type="text" class="form-control" name="qty[]" value="<?php echo $row['stock_quantity'] ?>" id="qty<?php echo $count ?>" required></td>
                      <td><input type="text" class="form-control" name="unit[]" value="<?php echo $row['stock_unit'] ?>" readonly id='unit<?php echo $count ?>'></td>
                      <td> <input type="text" class="form-control" name="color[]" value="<?php echo $row['color_name'] ?>" required></td>
                      <td> <input type="text" class="form-control" name="ADNo[]" value="<?php echo $row['ad_no'] ?>" required></td>

                      <td><input type="text" class="form-control" name="pcode[]" value="<?php echo $row['purchase_code'] ?>" required></td>
                      <td><input type="text" class="form-control" name="prate[]" value="<?php echo $row['purchase_rate'] ?>" id="prate<?php echo $count ?>" required></td>
                      <td style='width:10%'><input type="text" class="form-control" name="total[]" readonly value="<?php echo $row['total_value'] ?>" id="value<?php echo $count ?>"></td>
                      <input type="hidden" name="fsr_id[]" value="<?php echo $row['fsr_id'] ?>">

                    </tr>
                  <?php } ?>
                </tbody>
                <tr>
                  <th></th>

                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Total</th>
                  <th id="th_qty"><?php echo $total_qty ?></th>
                  <th></th>
                  <th> </th>
                  <th></th>

                  <th></th>
                  <th>Total</th>
                  <th id="th_total"><?php echo $total_val ?></th>
                </tr>
              </table>
              <hr>
              <div class="col-md-3">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" name="submit" class="btn btn-success btn-md">Update</button>
              </div>
            </div>

          </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>
<script>


</script>
<?php include('FRC_js.php'); ?>