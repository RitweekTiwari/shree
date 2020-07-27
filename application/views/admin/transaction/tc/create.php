<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/Transaction/addTC/') ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Create TC</h5>
            </div>
            <div class="modal-body">


              <table id="fresh_form" class="remove_datatable">
                <thead>

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
                  <th>Finish Qty</th>
                  <th>TC</th>
                  <th>Unit</th>

                  <th>Days Rem</th>

                  <th>Option</th>
                </thead>
                <tbody id="fresh_data">
                  <tr id="0">

                    <td><input type="text" class="form-control pbc" value="" id='pbc0' readonly></td>
                    <td><input type="text" class="form-control obc" name="obc[]" id="obc0"></td>

                    <td><input type="text" class="form-control " value="" id="orderNo0" readonly></td>
                    <td><input type="text" class="form-control " id='fabric0' readonly></td>
                    <td><input type="text" class="form-control " value="" id='hsn0' readonly></td>
                    <td><input type="text" class="form-control " value="" id='design0' readonly></td>
                    <td><input type="text" class="form-control " value="" id='DesignCode0' readonly></td>
                    <td><input type="text" class="form-control " value="" id='dye0' readonly></td>
                    <td><input type="text" class="form-control " value="" id='matching0' readonly></td>
                    <td><input type="text" class="form-control" value="" id='qty0' readonly></td>
                    <td><input type="text" class="form-control qty" name="fquantity[]" value="" id='fqty0'></td>
                    <td><input type="text" class="form-control" name="tc[]" value="0" id='tc0' readonly></td>
                    <td><input type="text" class="form-control unit " id='unit0' readonly>
                    <td><input type="text" class="form-control " value="" id='days0' readonly>
                      <input type="hidden" name="id[]" id='id0'></td>
                    <td> <button type="button" name="add_more" id="add_more" class="btn btn-success">+</button></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <div class="col-md-3" id='submit_button'>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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

<?php require 'tc_js.php'; ?>