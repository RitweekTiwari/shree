<div class="col-3">
  <div class="card">
    <div class="card-body">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5> Order Barcode Details </h5>
        </div>
        <hr>
        <?php if (isset($order_list)) { ?>

          <table class=" text-center table-striped table-bordered  ">
            <thead>
              <tr>
                <th> Barcode </th>
                <th> <?php echo $order_list->order_barcode; ?> </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <h6> Order Date </h6>
                </td>

                <td><?php echo my_date_show($order_list->order_date); ?></td>
              </tr>
              <tr>
                <td>
                  <h6>Customer </h6>
                </td>
                <td><?php echo $order_list->customer_name; ?></td>

              </tr>
              <tr>
                <td>
                  <h6>Godown </h6>
                </td>
                <td><?php echo $order_list->godown; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>OD Number </h6>
                </td>
                <td><?php echo $order_list->order_number; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>PBC </h6>
                </td>
                <td><?php echo $order_list->pbc; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Series  </h6>
                </td>
                <td><?php echo $order_list->series_number; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>DBC </h6>
                </td>
                <td><?php echo $order_list->design_barcode; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Fabric </h6>
                </td>
                <td><?php echo $order_list->fabric_name; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Unit </h6>
                </td>
                <td><?php echo $order_list->unit; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Quantity </h6>
                </td>
                <td><?php echo $order_list->quantity; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Remark </h6>
                </td>
                <td><?php echo $order_list->remark; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Des Code </h6>
                </td>
                <td><?php echo $order_list->design_code; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Hsn  </h6>
                </td>
                <td><?php echo $order_list->hsn; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Design  </h6>
                </td>
                <td><?php echo $order_list->design_name; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Stitch  </h6>
                </td>
                <td><?php echo $order_list->stitch; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Dye  </h6>
                </td>
                <td><?php echo $order_list->dye; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Matching </h6>
                </td>
                <td><?php echo $order_list->matching; ?>
                </td>
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
          <h5> Transaction Details </h5>
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
              } ?>
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