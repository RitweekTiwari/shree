<style>
  .PrintThis table {
    width: '7in';
    padding: 0px 0px;
    margin: 0px 0px;
  }

  .PrintThis table tr td {
    text-align: center;
    height: 10px;
    padding: 0px 0px;
    margin: 0px 0px;
    vertical-align: top;
  }

  .PrintThis table td {
    font-size: 14px;
    height: 10px;
    font-weight: 650;
  }

  .PrintThis table table {
    width: 6.0in;
    height: 1.50in;
  }

  .PrintThis table table td {

    width: 1.0in;
    border: none;
    text-align: left;
  }
</style>

<table height="7in" width="7in">
  <?php foreach ($data as $value) : ?>

    <tr>
      <td>
        <table>

          <tr>
            <td rowspan="3">
              <svg id="barcode<?php echo $value[0]['order_barcode']; ?>"></svg>
              <script>
                JsBarcode("#barcode<?php echo $value[0]['order_barcode']; ?>", "<?php echo $value[0]['order_barcode']; ?>", {
                  height: 50,
                  fontSize: 14,
                  width: 1.5
                });
              </script>
            </td>
            <td>SIZE</td>
            <td width="2in" style="white-space:nowrap">:- <?php echo $value[0]['quantity']; ?> <?php echo $value[0]['unit']; ?></td>
            <td rowspan="6" style="border-left:1px solid black;padding : 2px"> &nbsp; Matching :- <?php echo $value[0]['matching']; ?> </td>
          </tr>
          <tr>
            <td>FABRIC</td>
            <td width="1in" style="white-space:nowrap">:- <?php echo $value[0]['fabric_name'] . "  "; ?></td>
            <td> &nbsp;</td>
          </tr>
          <tr>

            <td>OD NO</td>
            <td width="1in" style="white-space:nowrap">:- <?php echo $value[0]['order_number']; ?></td>
            <td> &nbsp;</td>
          </tr>
          <tr>
            <td style="text-align:center"><?php echo $value[0]['order_barcode']; ?> </td>
            <td>DESIGN </td>
            <td width="1in" style="white-space:nowrap">:-<?php echo $value[0]['design_name']; ?></td>
            <td></td>
            <td> &nbsp; </td>
          </tr>
          <tr>
            <td rowspan="3">
              <svg id="barcode1<?php echo $value[0]['order_barcode']; ?>"></svg>
              <script>
                JsBarcode("#barcode1<?php echo $value[0]['order_barcode']; ?>", "<?php echo $value[0]['pbc']; ?>", {
                  height: 50,
                  fontSize: 14,
                  width: 1.5
                });
              </script>
            </td>
            <td>CODE</td>
            <td width="1in">:- <?php echo $value[0]['design_code']; ?></td>
            <td> &nbsp;</td>

          </tr>
          <tr>
            <td>STITCH</td>
            <td width="1in">:- <?php echo $value[0]['stitch']; ?></td>
            <td> &nbsp;</td>
          </tr>
          <tr>

            <td>DYE</td>
            <td width="1in" style="white-space:nowrap">:- <?php echo $value[0]['dye']; ?></td>
            <td style="border-left:1px solid black;padding : 2px"> &nbsp;KARIGAR</td>
          </tr>
          <tr>
            <td style="text-align:center"><?php echo $value[0]['pbc']; ?> </td>

            <td>Godown</td>
            <td collspan="2" style="white-space:nowrap">:- <?php echo $value[0]['party']; ?></td>
            <td style="border-left:1px solid black;padding : 2px"> &nbsp;……………………………</td>
          </tr>
          <tr>
            <td></td>
            <td>Party</td>
            <td collspan="2" style="white-space:nowrap">:- <?php echo $value[0]['godown']; ?></td>
            <td style="border-left:1px solid black;padding : 2px"> &nbsp;……………………………</td>
          </tr>

        </table>
      </td>
    </tr>


  <?php endforeach; ?>
</table>