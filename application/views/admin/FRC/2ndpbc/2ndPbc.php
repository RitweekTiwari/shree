<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/FRC/submitPbc') ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Create 2nd PBC</h5>
              <div id='msg'></div>
            </div>
            <div class="modal-body">
              <table class="remove_datatable">
                <thead>
                  <th>Parent Barcode</th>


                  <th>Fabric</th>
                  <th>Quantity</th>


                  <th>Date</th>
                  <th>Curr qty </th>
                  <th>Challan</th>
                  <th>AD no</th>
                  <th>Unit </th>
                  <th>Color</th>
                  <th>Rate</th>
                  <th>TC</th>
                  <th>ADD</th>
                </thead>
                <tbody>
                  <tr>

                    <td>

                      <input type="text" class="form-control " name="pbc" value="" id="pbc" required>
                    </td>

                    <td>
                      <input type="text" class="form-control" name="fabric_name" value="" id="fabric" readonly>
                      <input type="hidden" class="form-control" name="fabric_id" value="" id="fabric_id" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="Tquantity" value="" id='Tquantity' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="datex" value="" id='date' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="Cur_quantity" value="" id='Cur_quantity' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="challan_no" value="" id='challan_no' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="ad_no" value="" id='ad_no' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="unit" value="" id='unit' readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control color" name="color" value="" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control rate" name="prate" value="" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="tc" value="" id='tcmain' required>
                      <input type="hidden" name='oldtc' value="" id='oldtc'>
                    </td>
                    <td>
                      <button class="btn btn-success " id="add_tc">Add </button>
                    </td>
                    <input type="hidden" name='pcode' value="" id='pcode'>

                    <input type="hidden" name='fabtype' value="" id='fabtype'>
                    <input type="hidden" name='hsn' value="" id='hsn'>
                  </tr>
                </tbody>
              </table>
              <hr>
              <div class="container" id="details"></div>
              <hr>
              <div class="container-fluid" id="fresh_form">
                <table class="remove_datatable">
                  <thead>
                    <th>S no.</th>


                    <th>Current Quantity</th>
                    <th>TC</th>


                    <th>Color</th>
                    <th>Rate </th>
                    <th>value</th>
                    <th>Option</th>

                  </thead>
                  <tbody id="fresh_data">
                    <tr id="0">
                      <td><input type="text" class="form-control sno" name="sno[]" value="1" readonly></td>

                      <td><input type="text" class="form-control qty" name="quantity[]" value="" id='qty0' required>
                      </td>
                      <td><input type="text" name="tc[]" class="form-control " value="" id="tc" required></td>
                      <td><input type="text" class="form-control color" name="color[]" value="" readonly></td>
                      <td><input type="text" name="rate[]" class="form-control rate" value="" id="rate0" readonly></td>
                      <td><input type="text" name="value[]" class="form-control " value="" id="value0" readonly></td>

                      <td> <button type="button" name="add_more" id="add_more2" class="btn btn-success">+</button></td>
                    </tr>
                  </tbody>
                </table>
                <hr>
                <div class="col-md-3">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                  <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
                </div>
              </div>
            </div>

          </div>
          <br>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include('FRC_js.php'); ?>