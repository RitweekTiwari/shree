<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Order List</h4>
          <hr>

          <div class="widget-box">
            <div class="widget-content nopadding">
              <div class="row well">
                &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo base_url('admin/Orders/back') ?>" style="">GO Back</a>
              </div>
              <hr>
              <form method="post" action="<?php echo base_url('admin/Orders/edit_order_product') ?>">
                <table class=" remove_datatable">
                  <thead class="">
                    <tr class="odd" role="row">

                      <th>#</th>
                      <th>Type</th>
                      <th>Serial N0.</th>
                      <th id='barcode_head'>Design Barcode</th>
                      <th>Fabric_Name</th>
                      <th>Hsn</th>

                      <th>Design_Name</th>
                      <th>Design Code</th>
                      <th>Stitch</th>
                      <th>Dye</th>
                      <th>Matching</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      <th>Image</th>
                      <th>priority</th>
                      <th>Status</th>
                      <th>Order Barcode</th>
                      <th>Remark</th>



                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id = 1;
                    foreach ($order_data as $value) { ?>
                      <tr id="<?php echo $id ?>">
                        <td><?php echo $id ?><input type="hidden" name="pro_id[]" value="<?php echo $value['order_product_id'] ?>"></td>
                        <td> <select name="type[]" class="form-control type " id='type<?php echo $id ?>'>

                            <option value="1">Barcode </option>
                            <option value="2"> Manual </option>
                          </select></td>
                        <td><input type="text" class="form-control" name="serial_number[]" value="<?php echo $value['series_number'] ?>"></td>
                        <td id='tdbarcode<?php echo $id ?>'><input type="text" class="form-control design_barcode" name="design_barcode[]" value="<?php echo $value['design_barcode'] ?>"></td>
                        <td id='tdfab<?php echo $id ?>'><input type="text" class="form-control fabric_name " name="fabric_name[]" value="<?php echo $value['fabric_name'] ?>" id='fabric<?php echo $id ?>'>
                        </td>
                        <td><input type="text" class="form-control " name="hsn[]" value="<?php echo $value['hsn'] ?>" id='hsn<?php echo $id ?>' readonly></td>

                        <td id='tddesign<?php echo $id ?>'><input type="text" name="design_name[]" class="form-control" value="<?php echo $value['design_name'] ?>" id='designName<?php echo $id ?>'></td>
                        <td> <input type="text" name="design_code[]" class="form-control" value="<?php echo $value['design_code'] ?>" readonly id='designCode<?php echo $id ?>'></td>
                        <td><input type="text" class="form-control" name="stitch[]" value="<?php echo $value['stitch'] ?>" readonly id='stitch<?php echo $id ?>'></td>
                        <td> <input type="text" class="form-control" name="dye[]" value="<?php echo $value['dye'] ?>" readonly id='dye<?php echo $id ?>'></td>
                        <td><input type="text" class="form-control" name="matching[]" value="<?php echo $value['matching'] ?>" readonly id='matching<?php echo $id ?>'></td>

                        <td><input type="text" class="form-control" name="quantity[]" value="<?php echo $value['quantity'] ?>"></td>
                        <td><input type="text" name="unit[]" class="form-control " value="<?php echo $value['unit'] ?>" readonly id="unit<?php echo $id ?>"></td>
                        <td><input type="text" name="image[]" class="form-control image" value="<?php echo $value['image'] ?>" readonly id="image<?php echo $id ?>"></td>
                        <td> <input type="text" class="form-control" name="priority[]" value="30"></td>
                        <td><input type="text" class="form-control" name="status[]" value=""></td>
                        <td> <input type="text" class="form-control" name="order_barcode[]" value="<?php echo $value['order_barcode'] ?>" id="obc<?php echo $id ?>" readonly></td>
                        <td><input type="text" class="form-control" name="remark[]" value="<?php echo $value['remark'] ?>"></td>
                      </tr>
                    <?php $id = $id + 1;
                    } ?>
                  </tbody>
                </table>
                <div class="col-md-3 align-center"><br>
                  <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <input type="submit" name="action" id="order_btn" class="btn btn-info btn-block" value="Update " />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      window.location = "<?php echo base_url() ?>admin/Orders/deleteOrders/" + id;
    }
  }
</script>

<?php include('order_js.php'); ?>