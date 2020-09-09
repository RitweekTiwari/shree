  <div class="col-3">
    <div class="card">
      <div class="card-body">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5> Parent Details </h5>
          </div>
          <hr>
          <?php if (isset($pbc_list)) { ?>
            <table class="text-center table-striped table-bordered  ">
              <thead>
                <tr>
                  <th>
                    <h5> Barcode
                  </th>
                  <th> <?php echo $pbc_list->parent_barcode; ?> </h5>
                  </th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <h6>fabric Name </h6>
                  </td>
                  <td><?php echo $pbc_list->fabricName; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>fabric Type </h6>
                  </td>
                  <td><?php echo $pbc_list->fabric_type; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>HSN </h6>
                  </td>
                  <td><?php echo $pbc_list->hsn; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Stock Quantity </h6>
                  </td>
                  <td><?php echo $pbc_list->stock_quantity; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Current Stock </h6>
                  </td>
                  <td><?php echo $pbc_list->current_stock; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Stock Unit </h6>
                  </td>
                  <td><?php echo $pbc_list->stock_unit; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Challan Number </h6>
                  </td>
                  <td><?php echo $pbc_list->challan_no; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Color </h6>
                  </td>
                  <td><?php echo $pbc_list->color_name; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Purchase Code </h6>
                  </td>
                  <td><?php echo $pbc_list->purchase_code; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Purchase Rate </h6>
                  </td>
                  <td><?php echo $pbc_list->purchase_rate; ?></td>
                </tr>
                <tr>
                  <td>
                    <h6>Tc </h6>
                  </td>
                  <td><?php echo $pbc_list->tc; ?></td>
                </tr>

              </tbody>
            </table>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <div class="col-9">
    <div class="card">
      <div class="card-body">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5> Transaction Details</h5>
          </div>
          <hr>
          <div class="widget-content nopadding">
            <table class="text-center table-striped table-bordered  " id="">
              <thead>
                <tr>
                  <th><b>Order Date</b></th>
                  <th><b>Order Barcode</b></th>
                  <th><b>From Godown</b></th>
                  <th><b>To Godown</b></th>
                  <th><b>Challan In</b></th>
                  <th><b>Challan Out</b></th>
                  <th><b>Jobwork Type</b></th>
                  <th><b>Transtion Type</b></th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($transction_list)) { ?>
                  <?php foreach ($transction_list as $value) { ?>
                    <tr>
                      <td><?php echo my_date_show($value['created_at']); ?></td>
                      <td><?php echo $value['order_barcode']; ?></td>
                      <td><?php echo $value['from']; ?></td>
                      <td><?php echo $value['to']; ?></td>
                      <td><?php echo $value['challan_in']; ?></td>
                      <td><?php echo $value['challan_out']; ?></td>
                      <td><?php echo $value['jobworkType']; ?></td>
                      <td><?php echo $value['transaction_type']; ?></td>

                    </tr>
                  <?php }
                } else { ?>
                  <p class="text-danger text-center"><?php echo $massege; ?></p>
                <?php  } ?>
              </tbody>

            </table>


          </div>
        </div>
      </div>
    </div>
  </div>
<div class="row well align-left">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <button class="btn btn-info " id='printAll'><i class="fa fa-print "></i> Print </button>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<script type="text/javascript">
  $("#printAll").on("click", function() {

    //Wait for all the ajax requests to finish, then launch the print window

    var divToPrint = document.getElementById("show");
    newWin = window.open("");
    newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/dist/css/style.min.css\" type=\"text/css\" media=\"print\"/>");
    newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css\" type=\"text/css\" media=\"print\"/>");

    newWin.document.write(divToPrint.outerHTML);
    newWin.document.close();
    newWin.print();
  });
</script>