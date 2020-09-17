<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-plus"></i> GENERATE SUIT & SAREE</h5>
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
                            <table id="fresh_form" class="remove_datatable">
                                <thead>
                                    <th>S no</th>
                                    <th>Date</th>
                                    <th>Fabric</th>
                                    <th>Color</th>
                                    <th>PCS</th>
                                    <th>Avg Rate</th>
                                    <th>Total Value</th>
                                    <th>Barcode</th>
                                </thead>
                                <tbody id="fresh_data">
                                    <tr>
                                        <td><input type="text" class="form-control" id="sno0" value="1" readonly /></td>
                                        <td><input type="date" class="form-control" name="date[]" value="<?php echo date('Y-m-d') ?>" id="date" /></td>
                                        <td style="width: 20%;">
                                            <select name="fabric_name[]" class="form-control fabric_name select2" id="fabric_name0" required>
                                                <option>Fabric</option>
                                                <?php foreach ($fabric as $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" data_name="<?php echo $value['fabricName']; ?>"> <?php echo $value['fabricName']; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <input type="hidden" class="form-control sno" name="fabric[]" />
                                        </td>

                                        <td><input type="text" class="form-control" name="color[]" value="" id="color0" required /></td>
                                        <td><input type="number" class="form-control" name="pcs[]" value="" id="pcs0" /></td>


                                        <td><input type="text" class="form-control" name="avgrate[]" value="" id="avgrate0" required /></td>
                                        <td><input type="text" class="form-control" name="total[]" value="" id="value0" /></td>
                                        <td><input type="text" class="form-control" name="barcode[]" value="" id="barcode0" required /></td>

                                    </tr>

                                </tbody>
                            </table>
                            <hr>
                            <div id="counter">
                                
                            </div>
                            <hr />
                            <div class="col-md-3" id="submit">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
                            </div>
                        </div>
                    </div>
                    <br />

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="list"></div>
</div>

<?php include('segment_js.php'); ?>