<div class="col-5">
  <div class="card">
    <div class="card-body">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5> Order Barcode Details </h5>
        </div>
        <hr>
        <?php if (isset($order_list)) { ?>

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5> Barcode :&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $order_list->order_barcode; ?> </h5>
          </div>
          <div class="row">
            <div class="col-5">
              <h6>Order Date : </h6>
            </div>
            <div class="col-7"><?php echo my_date_show($order_list->order_date); ?></div>
            <div class="col-5">
              <h6>Customer Name: </h6>
            </div>
            <div class="col-7"><?php echo $order_list->customer_name; ?></div>
            <div class="col-5">
              <h6>Godown: </h6>
            </div>
            <div class="col-7"><?php echo $order_list->godown; ?></div>
            <div class="col-5">
              <h6>Order Number : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->order_number; ?></div>
            <div class="col-5">
              <h6>Parent Barcode : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->pbc; ?></div>
            <div class="col-5">
              <h6>Series Number : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->series_number; ?></div>
            <div class="col-5">
              <h6>Design Barcode : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->design_barcode; ?></div>
            <div class="col-5">
              <h6>Fabric Name: </h6>
            </div>
            <div class="col-7"><?php echo $order_list->fabric_name; ?></div>
            <div class="col-5">
              <h6>Unit : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->unit; ?></div>
            <div class="col-5">
              <h6>Quantity : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->quantity; ?></div>
            <div class="col-5">
              <h6>Remark : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->remark; ?></div>
            <div class="col-5">
              <h6>Design Code : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->design_code; ?></div>
            <div class="col-5">
              <h6>Hsn : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->hsn; ?></div>
            <div class="col-5">
              <h6>Design Name : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->design_name; ?></div>
            <div class="col-5">
              <h6>Stitch : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->stitch; ?></div>
            <div class="col-5">
              <h6>Dye : </h6>
            </div>
            <div class="col-7"><?php echo $order_list->dye; ?></div>
            <div class="col-5">
              <h6>Matching: </h6>
            </div>
            <div class="col-7"><?php echo $order_list->matching; ?></div>


          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</div>
<div class="col-7">
  <div class="card">
    <div class="card-body">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5> Transtion Details </h5>
        </div>
        <hr>
        <div class="widget-content nopadding">
          <table class="table table-striped table-bordered table-responsive data-table" id="">
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
<script>
  $(document).ready(function() {
    var table = $('.data-table ').DataTable({


      "pageLength": 50,
      "lengthMenu": [
        [50, 100, 150, -1],
        [50, 100, 150, "All"]
      ],
      select: true,


      dom: 'Bfrtip',
      buttons: [
        'pageLength', {
          extend: 'excel',
          footer: true,
          exportOptions: {
            columns: ':visible'
          }
        }, {
          extend: 'pdf',
          footer: true,
          exportOptions: {
            columns: ':visible'
          }
        }, {
          extend: 'print',
          footer: true,
          exportOptions: {
            columns: ':visible'
          }
        },

        'selectAll',
        'selectNone',
        'colvis'
      ],
      scrollY: 500,
      scrollX: false,
      scrollCollapse: true,
      paging: true,


    });
  });
</script>