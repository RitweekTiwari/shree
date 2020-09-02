<div class="col-5">
  <div class="card">
    <div class="card-body">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
          <h5> Parent Details </h5>
        </div>
        <hr>
        <?php if (isset($pbc_list)) { ?>

          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5> Barcode :&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $pbc_list->parent_barcode; ?> </h5>
          </div>
          <div class="row">
            <div class="col-5">
              <h6>fabric Name : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->fabricName; ?></div>
            <div class="col-5">
              <h6>fabric Type : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->fabric_type; ?></div>
            <div class="col-5">
              <h6>HSN : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->hsn; ?></div>
            <div class="col-5">
              <h6>Stock Quantity : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->stock_quantity; ?></div>
            <div class="col-5">
              <h6>Current Stock : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->current_stock; ?></div>
            <div class="col-5">
              <h6>Stock Unit : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->stock_unit; ?></div>
            <div class="col-5">
              <h6>Challan Number : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->challan_no; ?></div>
            <div class="col-5">
              <h6>Color : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->color_name; ?></div>
            <div class="col-5">
              <h6>Purchase Code : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->purchase_code; ?></div>
            <div class="col-5">
              <h6>Purchase Rate : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->purchase_rate; ?></div>
            <div class="col-5">
              <h6>Tc : </h6>
            </div>
            <div class="col-7"><?php echo $pbc_list->tc; ?></div>



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
          <h5> Transtion Details</h5>
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