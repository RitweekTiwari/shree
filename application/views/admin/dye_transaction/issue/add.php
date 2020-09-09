<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/Dye_transaction/addChallan/') . $id ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> In Dye Transaction</h5>
            </div>
            <div class="modal-body">
              <table class="table-box">
                <tr>
                  <td><label>From</label></td>
                  <td>
                    <div class="col-md-12">
                      <label>Job Work Party Name</label>
                      <select name="FromParty" class="form-control" readonly>

                        <?php foreach ($branch_data as $value) : if ($value->id == $job) { ?>
                            <option value="<?php echo $value->id ?>"> <?php echo $value->name; ?></option>
                        <?php }
                        endforeach; ?>
                      </select>
                    </div>
                  </td>
                  <td><label>From Godown</label>
                    <input type="text" class="form-control " value="<?php echo $godown; ?>" readonly>
                    <input type="hidden" name="FromGodown" value="<?php echo $id; ?>">
                  </td>
                </tr>
                <tr>
                  <td><label>To</label>
                  </td>
                  <td>
                    <div class="col-md-12">
                      <label>Job Work Party Name</label>
                      <select name="toParty" class="form-control" id="toParty">
                        <option>Select </option>
                        <?php foreach ($branch_data as $value) : if ((in_array($value->subDeptName, $plain) || $value->job_work_type == 130) && $value->subDeptName != $id) { ?>
                            <option value="<?php echo $value->id ?>"> <?php echo $value->name; ?></option>
                        <?php }
                        endforeach; ?>
                      </select>
                    </div>
                  </td>
                  <td><label>To Godown</label>
                    <input type="text" class="form-control " id='ToGodown' value="" readonly></td>
                  <input type="hidden" name="ToGodown" id='ToGodownId'>
                </tr>
                <tr>
                  <td><label>Job Work type</label></td>
                  <td>
                    <div class="col-md-12"><input type="text" class="form-control " name="workType" id='workType' value=""></div>
                  </td>
                  <td></td>
                </tr>

              </table>

              <hr>
              <table id="fresh_form" class="remove_datatable">
                <thead>
                  <th>Sno.</th>
                  <th>PBC</th>
                  <th>Fabric_Name</th>
                  <th>Hsn</th>

                  <th>Quantity</th>
                  <th>Dye Color</th>
                  <th>Unit </th>
                  <th>Days Remain</th>
                  <th>Remark </th>
                  <th>Option</th>
                </thead>
                <tbody id="fresh_data">
                  <tr id="0">
                    <td><input type="text" class="form-control" readonly value="1"></td>
                    <td><input type="text" class="form-control pbc" name="pbc[]" value="" id='pbc0'></td>
                    <td><input type="text" class="form-control fabric_name " id='fabric0' readonly>
                    </td>
                    <td><input type="text" class="form-control " value="" id='hsn0' readonly></td>

                    <td><input type="text" class="form-control qty" value="" id='qty0' readonly></td>
                    <td><input type="text" class="form-control" name="color[]" value="" id='color0' required></td>
                    <td><input type="text" class="form-control unit " id='unit0' readonly>
                    </td>
                    <td><input type="text" class="form-control " value="" id='days0' readonly></td>

                    <td><input type="text" class="form-control" name="remark[]" value="" id='remark0'>
                     <input type="hidden" name="trans_id[]" id='trans_id0'></td>

                    <td> <button type="button" name="add_more" id="add_more" class="btn btn-success">+</button></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> Total </th>

                    <th id="thtotal"></th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th></th>

                  </tr>
                </tfoot>
              </table>
              <hr>
              <div class="col-md-3">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
              </div>
              <div class="pull-right" id="msg">

              </div>
            </div>

          </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include('issue_js.php'); ?>