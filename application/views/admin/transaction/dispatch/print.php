<style>
    .PrintThis table {
        width: '2in';
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
        width: 1.8in;

    }

    .PrintThis table table td {
        border: none;
        text-align: left;
    }

    table svg {
        width: 2.0in;
        height: 50px;
        display: block;
        margin: 0 auto;
        padding-top: 2px;
    }
</style>

<table height="2.5in" width="2.0in">
    <?php foreach ($trans_data as $value) :
    $barcode = 'SNS-' . $value['order_barcode'] . '-' . $value['fabricCode'] . '/' . $value['fabric_name'] . '/' . $value['design_code'];

        ?>

        <tr>
            <td>
                <table>

                    <tr>
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
        </tr>
        <tr><td>
        </td></tr>
        <tr>
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
        </tr>

                </table>
            </td>
        </tr>


    <?php endforeach; ?>
</table>