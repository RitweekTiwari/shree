<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/FRC/addRecieve') ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Create Chalan</h5>
            </div>
            <div class="modal-body">
              <div class="row">


                <div class="col-md-3">
                  <label>From Godown</label>
                  <select name="fromGodown" class="form-control" id='fromGodown' required>
                    <option value="">Select Godown</option>
                    <?php foreach ($sub_dept_data as $value) : ?>
                      <option value="<?php echo $value->id; ?>"> <?php echo $value->subDeptName; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>To Godown</label>
                  <select name="toGodown" class="form-control" id="toGodown" required>
                    <option value="">Select Godown </option>
                    <?php foreach ($sub_dept_data as $value) : ?>
                      <option value="<?php echo $value->id ?>"> <?php echo $value->subDeptName; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>DATE</label>
                  <input type="date" class="form-control" name="PBC_date" value="<?php echo date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-3">
                  <label>Doc Challan No</label>
                  <input type="text" class="form-control" name="Doc_challan" value="" id="Doc_challan" required>
                </div>

              </div>
              <hr>
              <table id="fresh_form" class=" remove_datatable">
                <thead>

                  <th>S no</th>
                  <th>Fabric_Name</th>
                  <th>Hsn</th>
                  <th>Fabric_Type</th>
                  <th>Qty</th>
                  <th>Pcs</th>
                  <th>Unit </th>
                  <th>Color </th>
                  <th>AD NO</th>

                  <th>Purchase code</th>
                  <th>Purchase Rate</th>
                  <th>T Value</th>

                  <th>Option</th>
                </thead>
                <tbody id="fresh_data">
                  <tr id="0">

                    <td><input type="text" class="form-control " id='sno0' value="1" readonly></td>
                    <td style="width: 20%;"><select name="fabric_name[]" class="form-control fabric_name select2" id='fabric0' required>
                        <option>Fabric</option>
                        <?php foreach ($febName as $value) : ?>
                          <option value="<?php echo $value->id; ?>" data_name="<?php echo $value->fabricName; ?>"> <?php echo $value->fabricName; ?></option>
                        <?php endforeach; ?>
                      </select><input type="hidden" class="form-control sno" name="fabric[]"> </td>
                    <td style="width: 10%;"><input type="text" class="form-control " name="hsn[]" value="" id='hsn0' readonly></td>
                    <td><input type="text" class="form-control" name="fabType[]" value="" readonly id='fabType0'></td>
                    <td><input type="text" class="form-control" name="qty[]" value="" id="qty0" required></td>
                    <td><input type="number" class="form-control" name="pcs[]" value="1" id="pcs0" required></td>
                    <td><input type="text" class="form-control" name="unit[]" value="" readonly id='unit0'></td>
                    <td> <input type="text" class="form-control" name="color[]" value="" required></td>
                    <td> <input type="text" class="form-control" name="ADNo[]" value="" required></td>

                    <td><input type="text" class="form-control" name="pcode[]" value="" required></td>
                    <td><input type="text" class="form-control" name="prate[]" value="" id='prate0' required></td>
                    <td><input type="text" class="form-control" name="total[]" readonly value="" id="value0"></td>

                    <td> <button type="button" name="add_more" id="add_more1" class="btn btn-success">+</button></td>
                  </tr>

                </tbody>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Total</th>
                  <th id="th_qty"></th>
                  <th></th>
                  <th> </th>
                  <th></th>

                  <th></th>
                  <th>Total</th>
                  <th id="th_total"></th>
                  <th></th>

                </tr>
              </table>
              <hr>

              <div class="col-md-3" id="submit">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
              </div>
            </div>

          </div>
          <br>
          <div class="col-md-6" id="summary"> </div>
        </form>

      </div>
    </div>

  </div>
</div>


<?php include('FRC_js.php'); ?>