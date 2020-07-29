<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/Orders/add_new_order') ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Create Order</h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <label>Order Type</label>
                  <select name="order_type" class="form-control" id="selectType">
                    <option value="">Select Order Type</option>
                    <?php foreach ($all_Order as $value) : ?>
                      <option value="<?php echo $value['id']; ?>"> <?php echo $value['orderType']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>Session</label>
                  <select name="session" class="form-control" id='Select_Session'>
                    <option value="">Select Session</option>
                    <?php foreach ($all_session as $value) : ?>
                      <option value="<?php echo $value['id']; ?>"> <?php echo $value['financial_year']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>Data Category</label>
                  <select name="category" class="form-control" id="Select_Category">
                    <option value="">Select Data Category</option>
                    <?php foreach ($data_cat as $value) : ?>
                      <option value="<?php echo $value['id']; ?>"> <?php echo $value['dataCategory']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <button type="button" name="add_more" id="add_order" class="btn btn-success btn-md">Select Order Type</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div id="order_form" class="card overflow-auto">
            <div class="card-header">
              <h5 class="card-title"><i class="fa fa-plus"></i>ENTER NEW ORDER DETAILS</h5>
              <div class='float-right msg'>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label>ORDER NUMBER</label>
                  <input type="text" class="form-control order_number" name="order_number" id='order_number' readonly>
                </div>
                <div class="col-md-3">
                  <label>CUSTOMER NAME</label>
                  <select name="customer_name" class="form-control" id="select_cust">
                    <option value="">Select Customer</option>
                    <?php foreach ($customer as $value) : ?>
                      <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4"><label>IMAGE</label><img src="" alt="" id="preview" style="width:100px"> </div>
              </div>
            </div>
            <hr>
            <div id="fresh_form" class="card overflow-auto">
              <table id="" class="remove_datatable">
                <thead>
                  <th>#</th>
                  <th>Type</th>
                  <th>Serial N0.</th>
                  <th id='barcode_head'>Design Barcode</th>
                  <th>Fabric_Name</th>
                  <th>Hsn</th>

                  <th>Design_Name</th>
                  <th>Code</th>
                  <th>Stitch</th>
                  <th>Dye</th>
                  <th>Matching</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Image</th>
                  <th>priority</th>
                  <th>Order Barcode</th>
                  <th>Remark</th>
                  <th>Option</th>
                </thead>
                <tbody id="fresh_data">
                  <tr id="0">
                    <td><input type="text" class="form-control" readonly value="1"></td>
                    <td style="width: 5%;"> <select name="type[]" class="form-control type " id='type0'>

                        <option value="1">Barcode </option>
                        <option value="2"> Manual </option>
                      </select></td>
                    <td><input type="text" class="form-control" name="serial_number[]" value="" id='serial_number0'></td>
                    <td id='tdbarcode0'></td>
                    <td id='tdfab0' style="width: 10%;"><input type="text" class="form-control fabric_name " name="fabric_name[]" readonly value="" id='fabric0'>
                    </td>
                    <td><input type="text" class="form-control " name="hsn[]" value="" id='hsn0' readonly></td>

                    <td id='tddesign0' style="width: 10%;"><input type="text" name="design_name[]" class="form-control" value="" readonly id='designName0'></td>
                    <td> <input type="text" name="design_code[]" class="form-control" value="" readonly id='designCode0'></td>
                    <td><input type="text" class="form-control" name="stitch[]" value="" readonly id='stitch0'></td>
                    <td> <input type="text" class="form-control" name="dye[]" value="" readonly id='dye0'></td>
                    <td style="width: 15%;"><input type="text" class="form-control" name="matching[]" value="" readonly id='matching0'></td>

                    <td><input type="text" class="form-control" name="quantity[]" value=""></td>
                    <td><input type="text" name="unit[]" class="form-control " value="" readonly id="unit0"></td>
                    <td><input type="text" name="image[]" class="form-control image" value="" readonly id="image0"></td>
                    <td> <input type="text" class="form-control" name="priority[]" value="30"></td>
                    <td> <input type="text" class="form-control" name="order_barcode[]" value="" id="obc0" readonly></td>
                    <td><input type="text" class="form-control" name="remark[]" value=""></td>
                    <td> <button type="button" name="add_more" id="add_more" class="btn btn-success">+</button></td>
                  </tr>
                </tbody>
              </table>
              <div class="col-md-3 align-center" id='submit_button'><br>
                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="submit" name="action" id="order_btn" class="btn btn-info btn-block" value="CREATE " />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('order_js.php'); ?>