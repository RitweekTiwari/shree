<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white" id="content_body">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Order</h3><hr>
        </div>
       
        <div class="row well">
          &nbsp;&nbsp; &nbsp;&nbsp; <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;

        </div><hr>
        <table class="table table-bordered data-table text-center table-responsive">
          <thead>
            <tr>
              <th><input type="checkbox" class="sub_chk" id="master"></th>
              <th>SESSION</th>
              <th>ORDER DATE</th>
              <th>ORDER NUMBER</th>
              <th>NO. OF ORDERS</th>


              <th>CUSTOMER NUMBER</th>
              <th>TYPE</th>
              <th>DATA CATEGORY</th>
              <th>STATUS</th>

              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_Order as $orders_value) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" data-id="<?php echo $orders_value['order_id'] ?>"></td>
                <td><?php echo $orders_value['financial_year']; ?></td>
                <td><?php echo my_date_show($orders_value['order_date']); ?></td>
                <td><?php echo $orders_value['order_number']; ?></td>
                <td><?php echo $orders_value['pcs']; ?></td>


                <td><?php echo $orders_value['customer_name']; ?></td>
                <td><?php echo $orders_value['order_type']; ?></td>
                <td><?php echo $orders_value['data_category']; ?></td>
                <td><?php echo $orders_value['status']; ?></td>

                <td>
                  <a href="<?php echo base_url('admin/orders/get_details/') . serve_url($orders_value['order_id']) ?> ">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="<?php echo base_url('admin/Orders/edit_order_product_details/') . $orders_value['order_id'] ?> ">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
</div>



<?php include('order_js.php'); ?>