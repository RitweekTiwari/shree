<script src="<?php echo base_url('optimum/barcode/dist/JsBarcode.all.js'); ?>"></script>
<script>
    function textToBase64Barcode(text) {
        var canvas = document.createElement("canvas");
        JsBarcode(canvas, text, {
            format: "pharmacode"
        });
        return canvas.toDataURL("image/png");
    }
</script>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-body" id="Print">
                <h4 class="card-title">Packing Slip</h4>

                <hr>
                <a type="button" class="btn  pull-left print_all btn-success" style="color:#fff;"><i class="fa fa-print"></i></a>
                <hr>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="widget-content nopadding">
                            <Div class="container row">

                                <div class="col-md-8 card-title">From : <?php echo $trans_data[0]['sub1']; ?> To : <?php echo $trans_data[0]['sub2']; ?></div>
                                <div class="col-md-4 card-title">Challan no : <?php echo $trans_data[0]['challan_out']; ?></div>

                            </Div>

                            <table class=" table-bordered data-table text-center " id="list">

                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th><input type="checkbox" class="sub_chk" id="master"></th>
                                        <th>Barcode</th>
                                        <th>OBC</th>
                                        <th>Order No</th>
                                        <th>Fabric Code</th>
                                        <th>Fabric</th>
                                        <th>Hsn</th>
                                        <th>DBC</th>
                                        <th>Design Name </th>
                                        <th>Design Code</th>

                                        <th>Current Qty</th>
                                        <th>Unit</th>
                                        <th>Image barcode</th>

                                    </tr>
                                </thead>
                                <tbody><?php
                                        $id = 1;
                                        foreach ($trans_data as $value) {
                                            $barcode = 'SNS-' . $value['order_barcode'] . '-' . $value['fabricCode'] . '/' . $value['fabric_name'] . '/' . $value['design_code'];


                                        ?>

                                        <tr id="tr_<?php echo $value['trans_meta_id'] ?>">

                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['trans_meta_id'] ?>"></td>
                                            <td>
                                                <div>
                                                    <svg class="barCodeImage" id="barcode1<?php echo $value['trans_meta_id']; ?>"></svg>
                                                    <script>
                                                        JsBarcode("#barcode1<?php echo $value['trans_meta_id']; ?>", "<?php echo $barcode; ?>", {
                                                            height: 50,
                                                            width: 1
                                                        });
                                                    </script>
                                                </div>
                                            </td>
                                            <td><?php echo $value['order_barcode']; ?></td>
                                            <td><?php echo $value['order_number']; ?></td>
                                            <td><?php echo $value['fabricCode']; ?></td>
                                            <td><?php echo $value['fabric_name']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td><?php echo $value['design_barcode']; ?></td>
                                            <td><?php echo $value['design_name']; ?></td>
                                            <td><?php echo $value['design_code']; ?></td>
                                            <td><?php echo $value['finish_qty']; ?></td>
                                            <td><?php echo $value['unit']; ?></td>
                                            <td>
                                                <div>
                                                    <svg class="barCodeImage" id="barcode2<?php echo $value['trans_meta_id']; ?>"></svg>
                                                    <script>
                                                        JsBarcode("#barcode2<?php echo $value['trans_meta_id']; ?>", "<?php echo $value['finish_qty']; ?>", {
                                                            height: 50,
                                                            width: 1
                                                        });
                                                    </script>
                                                </div>
                                            </td>


                                        </tr>

                                    <?php $id = $id + 1;
                                        } ?></tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <hr>

                <div id='summary'></div>

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
            var fabric = self.find("td:eq(5)").text().trim();
            var qty = Number(self.find("td:eq(10)").text().trim());
            console.log('fabric=' + fabric);
            console.log('summary=' + summary);
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

                    }

                }
                if (found == 0) {
                    pcs = 1;
                    qty = Number(qty);
                    arr = [fabric, pcs, qty];
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
            html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' + Math.round((tqty + Number.EPSILON) * 100) / 100  +
                '</th></tr>';
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
                    url: "<?= base_url() ?>admin/Transaction/print_packing_slip",
                    cache: false,
                    data: {
                        'ids': data,
                        'type' : 'table',
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(response) {
                        var w = window.open('about:blank');
                        w.document.open();
                        w.document.write(response);
                        w.document.close();
                    }
                });
                //for client side

            }
        }
    });
  
</script>