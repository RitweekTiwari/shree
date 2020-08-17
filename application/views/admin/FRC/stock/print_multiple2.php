<style>
  body {
    width: 12.5%;
  }

  .PrintThis table {
    width: 100%;
    padding: 5px 5px;
  }

  .PrintThis table tr td {
    text-align: center;
    padding: 0px 5px;
    vertical-align: top;
  }

  .PrintThis table td {
    font-size: 12px;
    font-weight: 650;
  }

  .PrintThis table table {
    width: 2.0in;
  }

  .PrintThis table table td {
    border: none;
    text-align: left;
  }
</style>

<table>
  <?php //echo print_r($data); 
  ?>
  <?php foreach ($data as $value) : ?>
    <tr class="first_part">
      <td>
        <table>
          <tr>
            <td colspan="2" class=" main-text">
              <div>
                <svg class="barCodeImage" id="barcode1<?php echo $value->fsr_id; ?>" /></svg>
                <script>
                  JsBarcode("#barcode1<?php echo $value->fsr_id; ?>", "<?php echo $value->parent_barcode; ?>", {
                    height: 50,
                    fontSize: 14,
                    width: 1.0
                  });
                </script>
              </div>
            </td>

          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> BARCODE</td>
            <td>:-<?php echo  $value->parent_barcode ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> FABRIC</td>
            <td>:-<?php echo  $value->fabricName ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> HSN</td>
            <td>:-<?php echo $value->hsn ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> SIZE</td>
            <td>:-<?php echo $value->current_stock ?> <?php echo $value->stock_unit ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> COLOR</td>
            <td>:-<?php echo $value->color_name ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> CHALLAN NO</td>
            <td>:-<?php echo  $value->challan_no ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> AD NO</td>
            <td>:-<?php echo  $value->ad_no ?></td>
          </tr>
          <tr>
            <td style="width: 50%; text-align: left"> RATE CODE</td>
            <td>:-<?php echo  $value->purchase_code ?></td>
          </tr>
        </table>
      </td>
      <td>
        <table>
          <tr>
            <td colspan="2" class=" main-text">
              <div>
                <svg class="barCodeImage" id="barcode2<?php echo $value->fsr_id; ?>" /></svg>
                <script>
                  JsBarcode("#barcode2<?php echo $value->fsr_id; ?>", "<?php echo $value->parent_barcode; ?>", {
                    height: 50,
                    fontSize: 14,
                    width: 1.0
                  });
                </script>
              </div>
            </td>

          </tr>

          <tr>
            <td style="width: 30%; text-align: center" colspan="2"> BARCODE
              :-<?php echo  $value->parent_barcode ?></td>
          </tr>
          <tr>

          </tr>
          <tr>
            <td colspan="2" class=" main-text">
              <div>
                <svg class="barCodeImage" id="barcode3<?php echo $value->fsr_id; ?>" /></svg>
                <script>
                  JsBarcode("#barcode3<?php echo $value->fsr_id; ?>", "<?php echo $value->parent_barcode; ?>", {
                    height: 50,
                    fontSize: 14,
                    width: 1.0
                  });
                </script>
              </div>
            </td>

          </tr>
          <tr>
            <td style="width: 30%;text-align: center" colspan="2"> BARCODE
              :-<?php echo  $value->parent_barcode ?></td>
          </tr>

        </table>
      </td>
    </tr>
  <?php endforeach; ?>
</table>