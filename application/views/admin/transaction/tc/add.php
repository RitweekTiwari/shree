<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->

  <!-- **************** Product List *****************  -->
  <div class="col-md-12 bg-white">
    <div class="card">
      <div class="card-body">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-plus"></i> Create TC Chalan</h5>
          </div>
          <div class="modal-body">
            <?php if ($data) { ?>
              <form method="post" action="<?php echo base_url('admin/transaction/add_tc_challan/') . $id ?>">
                <table class="remove_datatable">
                  <thead>
                    <tr class="odd" role="row">
                      <th>Sno</th>
                      <th>PBC</th>
                      <th>OBC</th>
                      <th>Order No.</th>

                      <th>Fabric</th>
                      <th>Hsn</th>
                      <th>Design Name </th>
                      <th>Design Code</th>
                      <th>Dye </th>
                      <th>Matching</th>
                      <th>Current Qty</th>
                      <th>Finish Qty</th>
                      <th>TC</th>
                      <th>Unit</th>



                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    echo $content;

                    ?>
                  </tbody>
                </table>
                <hr>
                <div id='summary'></div>
                <hr>
                <div class="col-md-3">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                  <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
                </div>
                <hr>
              <?php } else {
              echo "<h4 style='color:red '>No data found</h4>";
            }

              ?>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</div>
</div>
<script type="text/javascript">
  var summary = [];
  var count = 0;
  var i = 0;
  $(document).ready(function() {
    $("table tbody tr").each(function() {

      var self = $(this);
      var fabric = self.find("td:eq(4)  .fabric").val().trim();
      var qty = Number(self.find("td:eq(10)  .qty").val().trim());
      var fqty = Number(self.find("td:eq(11)  .fqty").val().trim());
      var tc = Number(self.find("td:eq(12)  .tc").val().trim());
      console.log('fabric=' + fabric);
      console.log('summary=' + summary);
      pcs = 1;
      if (i == 0) {
        var arr = [fabric, pcs, qty, fqty, tc];
        summary.push(arr);


      } else {
        var found = 0;
        summary.forEach(myFunction);

        function myFunction(value, index, array) {

          if (fabric == array[index][0]) {
            found = 1;
            array[index][1] += 1;
            array[index][2] += Number(qty);
            array[index][3] += Number(fqty);
            array[index][4] += Number(tc);
          }

        }
        if (found == 0) {
          pcs = 1;
          qty = Number(qty);
          arr = [fabric, pcs, qty, fqty, tc];
          summary.push(arr);
          console.log(summary);
        }
      }
      i = i + 1;
    });
    var html =
      '<table class=" table-bordered text-center "><caption>Summary</caption><thead class="bg-secondary text-white">';
    html += '<tr><th >Fabric</th>';
    html += '<th >PCS</th>';
    html += '<th >Quantity</th>';
    html += '<th >F Quantity</th>';
    html += '<th >TC</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    if (summary) {

      var stotal = 0;
      var tqty = 0;
      var Tpcs = 0;
      var Ttc = 0;
      var Tfqty = 0;
      summary.forEach(myFunction);

      function myFunction(value, index, array) {

        Ttc += array[index][4];
        Tfqty += array[index][3];
        tqty += array[index][2];
        Tpcs += array[index][1];
        html += ' <tr><td>' + array[index][0] + '</td>';
        html += '<td>' + array[index][1] + '</td>';
        html += '<td>' + Math.round((array[index][2] + Number.EPSILON) * 100) / 100 + '</td>';
        html += '<td>' + Math.round((array[index][3] + Number.EPSILON) * 100) / 100 + '</td>';
        html += '<td>' + Math.round((array[index][4] + Number.EPSILON) * 100) / 100 + '</td>';
        html += '</tr></tbody>';
      }
      html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' + Math.round((tqty + Number.EPSILON) * 100) / 100 +
        '</th><th>' + Math.round((Tfqty + Number.EPSILON) * 100) / 100 + '</th><th>' + Math.round((Ttc + Number.EPSILON) * 100) / 100 + '</th></tr>';
      html += '</table>';

      $('#summary').html(html);
    }
  });
</script>