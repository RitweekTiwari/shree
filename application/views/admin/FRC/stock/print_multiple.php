<style>
  body {
    width: 4.0in;
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
    font-size: 14px;
    font-weight: 650;
  }

  .PrintThis table table {
    width: 3.8in;
  }

  .PrintThis table table td {
    border: none;
    text-align: left;
  }

  table img {
    width: 2.2in;
    height: 50px;
    display: block;

    padding-top: 2px;
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
            <td colspan="2">
              <div>
                <img class="barCodeImage" id="barcode1<?php echo $value->parent_barcode; ?>" />
                <script>
                  JsBarcode("#barcode1<?php echo $value->parent_barcode; ?>", "<?php echo $value->parent_barcode; ?>");
                </script>
              </div>
            </td>

          </tr>
          <tr>
            <td style='width:1.0in'> BARCODE</td>
            <td>:-<?php echo  $value->parent_barcode ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> FABRIC</td>
            <td>:-<?php echo  $value->fabricName ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> HSN</td>
            <td>:-<?php echo $value->hsn ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> SIZE</td>
            <td>:-<?php echo $value->current_stock ?> <?php echo $value->stock_unit ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> COLOR</td>
            <td>:-<?php echo $value->color_name ?></td>
          </tr>
          <tr>
            <td> CHALLAN NO</td>
            <td>:-<?php echo  $value->challan_no ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> AD NO</td>
            <td>:-<?php echo  $value->ad_no ?></td>
          </tr>
          <tr>
            <td style='width:1.0in'> RATE CODE</td>
            <td>:-<?php echo  $value->purchase_code ?></td>
          </tr>

        </table>
      </td>
    </tr>
  <?php endforeach; ?>
</table>