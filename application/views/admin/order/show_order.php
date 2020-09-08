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
                            <table class=" table-bordered data-table text-center table-responsive">
                                <thead class="">
                                    <tr class="odd" role="row">
                                        <th><input type="checkbox" class="sub_chk" id="master"></th>
                                        <th>S/No</th>
                                        <th>Series Number</th>
                                        <th>Order Barcode </th>
                                        <th>Order Number</th>
                                       
                                        <th>Customer Name</th>
                                        <th>Fabric Name</th>
                                        <th>Hsn</th>


                                        <th>Design Name</th>
                                        <th>Design Code</th>
                                        <th>Stitch</th>
                                        <th>Dye</th>
                                        <th>Matching</th>
                                        <th>Remark</th>
                                        <th>Quntity</th>
                                        <th>Unit</th>
                                        <th>Image</th>
                                        <th>Priority</th>

                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = 1;
                                    foreach ($order_data as $value) { ?>
                                        <tr class="gradeU" id="tr_<?php echo $value['order_id'] ?>">

                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['order_id'] ?>"></td>
                                            <td><?php echo $id ?></td>

                                            <td><?php echo $value['series_number'] ?></td>
                                            <td><?php echo $value['order_barcode']; ?></td>
                                            <td><?php echo $value['order_number']; ?></td>
                                            
                                            <td><?php echo $value['customer']; ?></td>
                                            <td><?php echo $value['fabric_name']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>

                                            <td><?php echo $value['design_name'] ?></td>
                                            <td><?php echo $value['design_code'] ?></td>
                                            <td><?php echo $value['stitch'] ?></td>
                                            <td><?php echo $value['dye'] ?></td>
                                            <td><?php echo $value['matching'] ?></td>
                                            <td><?php echo $value['remark'] ?></td>
                                            <td><?php echo $value['quantity'] ?></td>
                                            <td><?php echo $value['unit'] ?></td>
                                            <td><?php echo $value['image'] ?></td>
                                            <td><?php echo $value['priority'] ?></td>
                                            
                                        </tr>

                                    <?php $id = $id + 1;
                                    } ?>
                                </tbody>
                            </table>
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