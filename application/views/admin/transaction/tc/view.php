<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->

  <!-- **************** Product List *****************  -->
  <div class="col-md-12 bg-white">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">TC Challan Receive Detail</h4>
        <hr>

        <div class="widget-box">
          <div class="widget-content nopadding">
            <div class="row well">
              <div class="col-6"> <a type="button" class="btn btn-info pull-left print_all btn-success" style="color:#fff;"><i class="fa fa-print"></i></a>
              </div>
            </div><hr>
            <Div class="container row">

              <div class="col-md-8 card-title">From : <?php echo $data[0]['sub1']; ?> </div>
              <div class="col-md-4 card-title">Challan no : <?php echo $data[0]['challan_out']; ?></div>

            </Div><hr>
            <table class=" table-bordered data-table text-center " id="frc">
              <thead class="bg-dark text-white">
                <tr class="odd" role="row">
                  <th><input type="checkbox" class="sub_chk" id="master"></th>
                  <th>Sno</th>
                  <th>PBC</th>
                  <th>OBC</th>
                  <th>Order No.</th>
                  <th>Current Qty</th>
                  <th>Finish Qty</th>
                  <th>TC</th>
                  <th>Fabric Code</th>
                  <th>Fabric</th>
                  <th>Hsn</th>
                  <th>Design Name </th>
                  <th>Design Code</th>
                  <th>Dye </th>
                  <th>Matching</th>

                  <th>Unit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $c = 1;
                $qty = 0.00;
                $fqty = 0.00;
                $tc = 0.00;

                foreach ($data as $value) {
                  $qty += $value['quantity'];
                  $fqty += $value['finish_qty'];
                ?>
                  <tr class="gradeU" id="tr_<?php echo $value['trans_meta_id'] ?>">

                    <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['trans_meta_id'] ?>"></td>
                    <td><?php echo $c ?> </td>
                    <td><?php echo $value['pbc'] ?></td>
                    <td><?php echo $value['order_barcode'] ?></td>
                    <td><?php echo $value['order_number'] ?></td>
                    <td><?php echo $value['quantity'] ?></td>
                    <td><?php echo $value['finish_qty'] ?></td>
                    <td><?php $cd = $value['finish_qty'] - $value['quantity'];
                        $tc = $tc + $cd;
                        echo $cd ?></td>
                    <td><?php echo $value['fabricCode'] ?></td>
                    <td><?php echo $value['fabric_name'] ?></td>
                    <td><?php echo $value['hsn'] ?></td>
                    <td><?php echo $value['design_name'] ?></td>
                    <td><?php echo $value['design_code'] ?></td>
                    <td><?php echo $value['dye'] ?></td>
                    <td><?php echo $value['matching'] ?></td>

                    <td><?php echo $value['unit'] ?></td>

                  </tr>

                <?php $c = $c + 1;
                } ?>
              </tbody>
              <tfoot class="bg-dark text-white">

                <tr>
                  <<th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th><?php echo $qty ?></th>
                    <th><?php echo $fqty ?></th>
                    <th><?php echo $tc ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th></th>

                    <th></th>

                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <hr>
        <div id='summary'></div>
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
      var fabric = self.find("td:eq(9)").text().trim();
      var qty = Number(self.find("td:eq(5)").text().trim());
      var fqty = Number(self.find("td:eq(6)").text().trim());
      var tc = Number(self.find("td:eq(7)").text().trim());
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

<script>
  jQuery('.print_all').on('click', function(e) {
    var allVals = [];
    $(".sub_chk:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });
    //alert(allVals.length); return false;
    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      //$("#loading").show();
      WRN_PROFILE_DELETE = "Are you sure you want to Print this rows?";
      var check = confirm(WRN_PROFILE_DELETE);
      if (check == true) {
        //for server side
        var join_selected_values = allVals.join(",");
        // alert (join_selected_values);exit;
        var ids = join_selected_values.split(",");
        var data = [];
        $.each(ids, function(index, value) {
          if (value != "") {
            data[index] = value;
          }
        });
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>admin/transaction/return_print_multiple",
          cache: false,
          data: {
            'ids': data,
            'godown': 19,
            'type': 'tc',
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(response) {
            $("body").html(response);
          }
        });
        //for client side

      }
    }
  });
</script>