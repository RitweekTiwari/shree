<style>
    .PrintThis table {
        width: '2in';
        padding: 10px 10px;
    }

    .PrintThis table tr td {
        text-align: center;
        padding: 0px 10px;
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
</style>

<table height="2.5in" width="2.0in">
    <?php foreach ($data as $value) :
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
                                        height: 60,
                                        fontSize: 14,
                                        width: 1.9
                                    });
                                </script>
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    <?php endforeach; ?>
</table>