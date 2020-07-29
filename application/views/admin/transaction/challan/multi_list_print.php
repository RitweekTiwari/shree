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

    table img {
        width: 2.0in;
        height: 50px;
        display: block;
        margin: 0 auto;
        padding-top: 2px;
    }
</style>

<table height="2.5in" width="2.0in">
    <?php foreach ($data as $value) : ?>

        <tr>
            <td>
                <table>

                    <tr>
                        <td colspan="2">
                            <div>
                                <img class="barCodeImage" id="barcode1<?php echo $value['order_barcode']; ?>" />
                                <script>
                                    JsBarcode("#barcode1<?php echo $value['order_barcode']; ?>", "<?php echo $value['order_barcode']; ?>");
                                </script>
                            </div>
                        </td>


                    </tr>
                    <tr>
                        <td width="1.0in">OBC </td>
                        <td>:-<?php echo $value['order_barcode']; ?></td>
                    </tr>
                    <tr>
                        <td width="1.0in">DBC </td>
                        <td>:-<?php echo $value['design_barcode']; ?></td>

                    </tr>
                    <tr>
                        <td width="1.0in">ITEM_NO </td>
                        <td>:-<?php echo $value['hsn']; ?>/<?php echo $value['fabric_name']; ?> </td>

                    </tr>
                    <tr>
                        <td width="1.0in">OD_NO </td>
                        <td>:-<?php echo $value['order_number']; ?></td>

                    </tr>
                    <tr>
                        <td width="1.0in">CODE </td>
                        <td>:-<?php echo $value['design_code']; ?></td>

                    </tr>
                    <tr>
                        <td width="1.0in">SIZE </td>
                        <td>:-<?php echo $value['finish_qty']; ?> <?php echo $value['unit']; ?></td>

                    </tr>
                </table>
            </td>
        </tr>


    <?php endforeach; ?>
</table>