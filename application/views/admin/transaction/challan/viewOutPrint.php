<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white" id="Print_div">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Challan Out Detail(<?php echo $trans_data[0]['sub2'] ?>) </h4>


                <hr>
                <div class="row">
                    <div class="col-md-8">

                        <table>
                            <tr>
                                <td> From Godown</td>
                                <td> <?php echo $trans_data[0]['sub1'] ?></td>

                            </tr>
                            <tr>
                                <td> To Godown</td>
                                <td><?php echo $trans_data[0]['sub2'] ?></td>
                            </tr>
                            <tr>
                                <td> Job Work type</td>

                                <td><?php echo $trans_data[0]['jobworkType'] ?></td>
                            </tr>
                            <tr>
                                <td> Challan No</td>
                                <td><?php echo $trans_data[0]['challan_out'] ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <hr>

                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="widget-content nopadding">


                            <table class=" table-bordered  text-center  data-table">

                                <thead class="bg-dark text-white">
                                    <tr>
                                      
                                        <th>PBC</th>
                                        <th>OBC</th>
                                        <th>Order No</th>
                                        <th>Fabric</th>
                                        <th>Hsn</th>
                                        <th>Design Name </th>
                                        <th>Design Code</th>
                                        <th>Dye </th>
                                        <th>Matching</th>
                                        <th>Current Qty</th>

                                        <th>Unit</th>
                                        <th>Image</th>
                                        <th>Days Rem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    $qty = 0.0;
                                    $fqty = 0.0;
                                    foreach ($frc_data as $value) {
                                        if ($is_plain == 0) {
                                            $qty +=  $value['quantity'];
                                        } else {
                                            $qty +=  $value['finish_qty'];
                                        }


                                    ?>
                                        <tr class="gradeU" id="tr_<?php echo $c ?>">

                                            <td><?php echo $value['pbc']; ?></td>
                                            <td><?php echo $value['order_barcode']; ?></td>

                                            <td><?php echo $value['order_number']; ?></td>
                                            <td><?php echo $value['fabric_name']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td><?php echo $value['design_name']; ?></td>
                                            <td><?php echo $value['design_code']; ?></td>
                                            <td><?php echo $value['dye'] ?></td>
                                            <td><?php echo $value['matching'] ?></td>
                                            <td><?php if ($is_plain == 0) {
                                                    echo $value['quantity'];
                                                } else {
                                                    echo $value['finish_qty'];
                                                } ?></td>

                                            <td><?php echo $value['unit'] ?></td>
                                            <td><?php echo $value['image'] ?></td>

                                            <td><?php
                                                $date1 = date('Y-m-d');
                                                $date2 = $value['order_date'];
                                                $diff = strtotime($date1) - strtotime($date2);


                                                $diff = 30
                                                    - ceil(abs($diff / 86400));
                                                echo $diff;
                                                ?></td>



                                        </tr>

                                    <?php $c = $c + 1;
                                    } ?>
                                </tbody>
                                <tfoot class="bg-dark text-white">
                                    <tr>
                                        <th></th>
                                       
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th><?php echo $qty;
                                            ?></th>

                                        <th></th>
                                        <th></th>
                                        <th></th>


                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div id='summary'></div>
    </div>
</div>


<script type="text/javascript">
    var summary = [];
    var count = 0;
    var i = 0;


    $(document).ready(function() {


        $("table tbody tr").each(function() {

            var self = $(this);
            var fabric = self.find("td:eq(4)").text().trim();
            var qty = Number(self.find("td:eq(10)").text().trim());
            console.log('fabric=' + fabric);
            console.log('summary=' + summary);
            pcs = 1;
            if (i == 0) {
                var arr = [fabric, pcs, qty];
                if (fabric != '') {
                    summary.push(arr);
                }



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
                    if (fabric != '') {
                        summary.push(arr);
                    }

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
                html += '<td>' + Math.round((array[index][2] + Number.EPSILON) * 100) / 100 + '</td>';
                html += '</tr></tbody>';
            }
            html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' + Math.round((tqty + Number.EPSILON) * 100) / 100 +
                '</th></tr>';
            html += '</table>';

            $('#summary').html(html);
        }
    });
</script>