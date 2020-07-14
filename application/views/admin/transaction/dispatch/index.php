  

  <table>

      <thead>
          <tr>

              <th> BARCODE IMAGE
              </th>
              <th>OBC</th>
              <th>OD No</th>
             
              <th>Fabric</th>
              <th>Hsn</th>
              <th>DBC</th>
              <th>Des Code</th>

              <th>Qty</th>
              <th>Image barcode</th>

          </tr>
      </thead>
      <tbody><?php
                $id = 1;
                foreach ($trans_data as $value) {
                    $barcode = 'SNS-' . $value['order_barcode'] . '-' . $value['fabricCode'] . '/' . $value['fabric_name'] . '/' . $value['design_code'];
                ?>

              <tr id="tr_<?php echo $value['trans_meta_id'] ?>">

                  <td>
                      <div>
                          <svg id="barcode1<?php echo $value['trans_meta_id']; ?>"></svg>
                          <script>
                              JsBarcode("#barcode1<?php echo $value['trans_meta_id']; ?>", "<?php echo $barcode; ?>", {
                                  height: 30,
                                  fontSize: 13,
                                  width: 1
                              });
                          </script>
                      </div>
                  </td>
                  <td><?php echo $value['order_barcode']; ?></td>
                  <td><?php echo $value['order_number']; ?></td>

                  <td><?php echo $value['fabric_name']; ?></td>

                  <td><?php echo $value['hsn']; ?></td>
                  <td><?php echo $value['design_barcode']; ?></td>
                  <td><?php echo $value['design_code']; ?></td>
                  <td><?php echo $value['finish_qty']; ?></td>
                  <td>
                      <div>
                          <svg id="barcode2<?php echo $value['trans_meta_id']; ?>"></svg>
                          <script>
                              JsBarcode("#barcode2<?php echo $value['trans_meta_id']; ?>", "<?php echo $value['finish_qty']; ?>", {
                                  height: 30,
                                  fontSize: 13,
                                  width: 1
                              });
                          </script>
                      </div>
                  </td>


              </tr>

          <?php $id = $id + 1;
                } ?></tbody>
  </table>
  <div id='summary'></div>
  <script type="text/javascript" src="<?php echo base_url('optimum/web/js/vendor/jquery-1.12.4.min.js'); ?>"></script>

  <script type="text/javascript">
      var summary = [];
      var count = 0;
      var i = 0;
      $(document).ready(function() {
          
          $("table tbody tr").each(function() {
              var self = $(this);
              var fabric = self.find("td:eq(3)").text().trim();
              var qty = Number(self.find("td:eq(7)").text().trim());
              pcs = 1;
              if (i == 0) {
                  var arr = [fabric, pcs, qty];
                  summary.push(arr);
              } else {
                  var found = 0;
                  summary.forEach(myFunction);

                  function myFunction(value, index, array) {

                      if (fabric == array[index][0]) {
                          found = 1;
                          array[index][1] += 1;
                          array[index][2] += Number(qty);
                          //  console.log('#fabric found'+summary);
                      }

                  }
                  if (found == 0) {
                      pcs = 1;
                      qty = Number(qty);
                      arr = [fabric, pcs, qty];
                      summary.push(arr);

                  }
              }
              i = i + 1;
          });
          var html =
              '<table  ><caption>Summary</caption><thead class="bg-secondary text-white">';
          html += '<tr><th >Fabric</th>';
          html += '<th >PCS</th>';
          html += '<th >Quantity</th>';

          html += '</tr>';
          html += '</thead>';
          html += '<tbody>';
          if (summary) {

              var stotal = 0;
              var tqty = 0;
              var Tpcs = 0;
              summary.forEach(myFunction);

              function myFunction(value, index, array) {
                  stotal += array[index][3];
                  tqty += array[index][2];
                  Tpcs += array[index][1];
                  html += ' <tr><td>' + array[index][0] + '</td>';
                  html += '<td>' + array[index][1] + '</td>';
                  html += '<td>' + Math.round((array[index][2] + Number.EPSILON) * 100) / 100  + '</td>';
                  html += '</tr></tbody>';
              }
              html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' +  Math.round((tqty + Number.EPSILON) * 100) / 100  +
                  '</th></tr>';
              html += '</table>';

              $('#summary').html(html);
          }
      });
  </script>