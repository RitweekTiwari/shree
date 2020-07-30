<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white" id="Print_div">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Challan Out Detail</h4>


                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <a type="button" class="btn  pull-left print_all btn-success" target="_blank" style="color:#fff;"><i class="fa fa-print"></i></a>

                        <table class="table-box">
                            <tr>
                                <td><label>From</label></td>
                                <td>
                                    <div class="col-md-12">
                                        <label>Job Work Party Name</label>
                                        <select name="FromParty" class="form-control" id="toParty" readonly>
                                            <?php foreach ($branch_data as $value) : ?>
                                                <option value="<?php echo $value->id ?>" <?php if ($value->id == $trans_data[0]['fromParty']) {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $value->name; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </td>
                                <td><label>From Godown</label>
                                    <input type="text" class="form-control " name="FromGodown" value="<?php echo $trans_data[0]['sub1']; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><label>To</label>
                                </td>
                                <td>
                                    <div class="col-md-12">
                                        <label>Job Work Party Name</label>
                                        <select name="toParty" class="form-control" id="toParty" readonly>
                                            <?php foreach ($branch_data as $value) : ?>
                                                <option value="<?php echo $value->id ?>" <?php if ($value->id == $job2) {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $value->name; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </td>
                                <td><label>To Godown</label><input type="text" class="form-control " value="<?php echo $trans_data[0]['sub2']; ?>" readonly></td>

                            </tr>
                            <tr>
                                <td><label>Job Work type</label></td>
                                <td>
                                    <div class="col-md-12"><input type="text" class="form-control " value="<?php echo $trans_data[0]['jobworkType']; ?>" readonly></div>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><label>Challan No</label></td>
                                            <td><input type="text" class="form-control " name="challan" value="<?php echo $trans_data[0]['challan_out']; ?>" readonly></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-4 "><img src="" alt=""> </div>
                </div>
                <hr>

                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="widget-content nopadding">


                            <table class="table table-bordered  text-center table-responsive">

                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>#</th>
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
                                    foreach ($frc_data as $value) {
                                        $qty +=  $value['quantity'];
                                    ?>
                                        <tr class="gradeU" id="tr_<?php echo $c ?>">
                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['trans_meta_id'] ?>"></td>

                                            <td><?php echo $value['pbc']; ?></td>
                                            <td><?php echo $value['order_barcode']; ?></td>

                                            <td><?php echo $value['order_number']; ?></td>
                                            <td><?php echo $value['fabric_name']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td><?php echo $value['design_name']; ?></td>
                                            <td><?php echo $value['design_code']; ?></td>
                                            <td><?php echo $value['dye'] ?></td>
                                            <td><?php echo $value['matching'] ?></td>
                                            <td><?php echo $value['quantity'] ?></td>
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
        function printData() {
            var divToPrint = document.getElementById("Print_div");

            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th,table td {' +
                'border-bottom:1px solid black;' +
                'padding:0.5em;' + 'text-align: center;' +
                '}' +
                '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.document.close();
            newWin.print();

        }

        $('.print_all').on('click', function() {
            printData();

        });

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