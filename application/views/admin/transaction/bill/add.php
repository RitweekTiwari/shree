<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/Transaction/addBill/') . $id ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Bill Transaction</h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <table class="table-box">
                    <tr>
                      <td><label>From</label></td>
                      <td>
                        <div class="col-md-12">
                          <label>Job Work Party Name</label>
                          <select name="FromParty" id="FromParty" class="form-control" readonly>

                            <?php foreach ($branch_data as $value) : if ($value->id == $job->id) { ?>
                                <option value="<?php echo $value->id ?>"> <?php echo $value->name; ?></option>
                            <?php }
                            endforeach; ?>
                          </select>
                        </div>
                      </td>
                      <td><label>From Godown</label>
                        <input type="text" class="form-control " value="<?php echo $godown; ?>" readonly>
                        <input type="hidden" name="FromGodown" value="<?php echo $id; ?>"> </td>
                    </tr>
                    <tr>
                      <td><label>To</label>
                      </td>
                      <td>
                        <div class="col-md-12">
                          <label>Job Work Party Name</label>
                          <select name="toParty" class="form-control" id="toParty">
                            <option>Select </option>
                            <?php foreach ($branch_data as $value) : if ($value->id != $job->id) { ?>
                                <option value="<?php echo $value->id ?>"> <?php echo $value->name; ?></option>
                            <?php }
                            endforeach; ?>
                          </select>
                        </div>
                      </td>
                      <td><label>To Godown</label><input type="text" class="form-control " id='ToGodown' value="" readonly></td>
                      <input type="hidden" name="ToGodown" id='ToGodownId'></td>
                    </tr>
                    <tr>
                      <td><label>Job Work type</label></td>
                      <td>
                        <div class="col-md-12"><input type="text" class="form-control " name="workType" id='workType' value="<?php echo $job->type ?>" readonly>
                          <input type="hidden" name="workTypeId" id='workTypeId ' value="<?php echo $job->job_work_type ?>">
                          <input type="hidden" name="category" id='category' value="<?php echo $job->category ?>">
                          <input type="hidden" name="rate_from" id='rate_from' value="<?php echo $job->rate_from ?>">
                      </td>
                </div>
                </td>

                </tr>

                </table>
              </div>
              <div class="col-md-4 text-center "><img src="<?php echo base_url('optimum/admin/assets/images/preview.webp') ?>" alt="preview" id="preview" style="width:150px; "> </div>
            </div>
            <hr>
            <table id="fresh_form" class="remove_datatable">
              <thead>
                <th>#</th>
                <th>PBC</th>
                <th>OBC</th>
                <th>Order No.</th>
                <th>Fabric</th>
                <th>Hsn</th>
                <th>Design Name </th>
                <th>Design Code</th>
                <th>Dye </th>
                <th>Matching</th>
                <th>Current Qty</th>
                <th>Unit</th>
                <th>Job_work</th>
                <th>Rate </th>
                <th>Value</th>
                <th>Image</th>
                <th>Days Rem</th>
                <th>Remark</th>
                <th>Option</th>
              </thead>
              <tbody id="fresh_data">
                <tr id="0">
                  <td><input type="text" class="form-control" readonly value="1"></td>
                  <td><input type="text" class="form-control pbc" name="pbc[]" value="" id='pbc0' readonly></td>
                  <td><input type="text" class="form-control obc" name="obc[]" value="" id='obc0'></td>
                  <td><input type="text" class="form-control " name="orderNo[]" value="" id='orderNo0' readonly></td>
                  <td><input type="text" name="fabric_name[]" class="form-control fabric_name " id='fabric0' readonly></td>
                  <td><input type="text" class="form-control " name="hsn[]" value="" id='hsn0' readonly></td>
                  <td><input type="text" class="form-control " name="design[]" value="" id='design0' readonly></td>
                  <td><input type="text" class="form-control " name="designCode[]" value="" id='DesignCode0' readonly></td>
                  <td><input type="text" class="form-control " name="dye[]" value="" id='dye0' readonly></td>
                  <td><input type="text" class="form-control " name="matching[]" value="" id='matching0' readonly></td>
                  <td><input type="text" class="form-control" name="quantity[]" value="" id='qty0' readonly></td>
                  <td><input type="text" name="unit[]" class="form-control unit " id='unit0' readonly>
                  <td><select type="text" class="form-control job" name="job[]" id='job0'></select></td>
                  <td><input type="text" class="form-control " name="rate[]" value="" id='rate0' readonly></td>
                  <td><input type="text" class="form-control" name="value[]" value="" id='value0' readonly></td>
                  <td><input type="text" class="form-control" name="image[]" value="" id='image0' readonly></td>
                  <td><input type="text" class="form-control " name="days[]" value="" id='days0' readonly></td>
                  <td><input type="text" class="form-control" name="remark[]" value="" id='remark0' readonly>
                    <input type="hidden" name="trans_id[]" id='trans_id0'></td>
                  <td> <button type="button" name="add_more" id="add_more" class="btn btn-success">+</button></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th> </th>
                  <th></th>
                  <th></th>
                  <th> </th>
                  <th> </th>
                  <th> </th>
                  <th>Total</th>
                  <th id="thtotal"> </th>
                  <th></th>
                  <th></th>
                  <th> </th>
                  <th></th>
                  <th></th>

                </tr>
              </tfoot>
            </table>
            <hr>
            <div class="col-md-3" id='submit_button'>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
              <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
            </div>

          </div>

      </div>
      <br>

      </form>
    </div>
  </div>
</div>
</div>
<template id="jobwork_temp">
  <option value="0">Select</option>
  <?php
  if ($job_meta != "") {

    foreach ($job_meta as $row) { ?>
      <option value="<?php echo $row['rate'] ?>"><?php echo $row['job'] ?></option>
  <?php }
  } ?>
</template>
<?php include('bill_js.php'); ?>