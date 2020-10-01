<style>
  .PrintThis table {
    width: '6in';
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
    width: 5.0in;
    height: 1.80in;
  }

  .PrintThis table table td {
    border: none;
    text-align: left;
  }

  table img {
    width: 1.0in;
    height: 50px;
    display: block;
    margin: 0 auto;
    padding-top: 2px;
  }
</style>

<table height="6in" width="6in">
  <?php foreach ($data as $value) : ?>

    <tr>
      <td>
        <table>

          <tr>
            <td rowspan="2" width="120px">
              <div>
                <img class="barCodeImage" id="barcode1<?php echo $value[0]['order_barcode']; ?>" />
                <script>
                  JsBarcode("#barcode1<?php echo $value[0]['order_barcode']; ?>", "<?php echo $value[0]['order_barcode']; ?>");
                </script>
              </div>
            </td>
            <td width="90px">SIZE</td>
            <td width="200px">:- <?php echo $value[0]['quantity']; ?> <?php echo $value[0]['unit']; ?></td>
            <td width="140px" rowspan="5">Matching :- <?php echo $value[0]['matching']; ?> </td>
          </tr>
          <tr>
            <td width="90px">FABRIC</td>
            <td width="200px">:- <?php echo $value[0]['fabric_name']; ?></td>
            <td width="140px"></td>
          </tr>
          <tr>
            <td style="text-align:center" rowspan="2">OBC:<?php echo $value[0]['order_barcode']; ?> </td>
            <td width="90px">OD NO</td>
            <td width="200px">:- <?php echo $value[0]['order_number']; ?></td>
            <td width="140px"></td>
          </tr>
          <tr>

            <td width="90px">DESIGN </td>
            <td width="200px">:-<?php echo $value[0]['design_name']; ?></td>
            <td width="140px"></td>
            <td> </td>
          </tr>
          <tr>
            <td rowspan="2">
              <div>
                <img class="barCodeImage" id="barcode1<?php echo $value[0]['pbc']; ?>" />
                <script>
                  JsBarcode("#barcode1<?php echo $value[0]['pbc']; ?>", "<?php echo $value[0]['pbc']; ?>");
                </script>
              </div>
            </td>
            <td width="90px">CODE</td>
            <td width="200px">:- <?php echo $value[0]['design_code']; ?></td>
            <td width="140px"></td>

          </tr>
          <tr>
            <td width="90px">STITCH</td>
            <td width="200px">:- <?php echo $value[0]['stitch']; ?></td>
            <td>KARIGAR</td>
          </tr>
          <tr>
            <td width="90px" style="text-align:center"><?php echo $value[0]['pbc']; ?> </td>
            <td width="90px">DYE</td>
            <td width="200px">:- <?php echo $value[0]['dye']; ?></td>
            <td>……………………………</td>
          </tr>

          <tr>
            <td></td>
            <td width="120px">Godown</td>
            <td width="240px" collspan="2">:- <?php echo $value[0]['to_godown']; ?></td>
            <td>……………………………</td>
          </tr>

        </table>
      </td>
    </tr>


  <?php endforeach; ?>
</table>