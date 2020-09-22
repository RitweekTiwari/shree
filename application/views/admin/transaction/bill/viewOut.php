<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white" id="Print_div">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">BILL</h3>


                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <a type="button" class="btn  pull-left print_all btn-success" target="_blank" style="color:#fff;"><i class="fa fa-print"></i></a>
                        <hr>
                        <table class="table-box">
                            <tr>
                                <td><label>From</label></td>
                                <td>
                                    <div class="col-md-12">
                                        <label> Party Name</label>
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
                                        <label> Party Name</label>
                                        <select name="toParty" class="form-control" id="toParty" readonly>
                                            <?php foreach ($branch_data as $value) : ?>
                                                <option value="<?php echo $value->id ?>" <?php if ($value->id == $job2) {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $value->name; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </td>
                                <td><label>To Godown</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control " value="<?php echo $trans_data[0]['sub2']; ?>" readonly></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-md-12"><label>Job Work </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control " value="<?php echo $trans_data[0]['jobworkType']; ?>" readonly></div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6"><label>Challan No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <input type="text" class="form-control " value="<?php echo $trans_data[0]['challan_out']; ?>" readonly>
                                        </div>
                                        <div class="col-md-6"><label>Challan Type</label>&nbsp;&nbsp;

                                            <input type="text" class="form-control " value="<?php echo $trans_data[0]['transaction_type']; ?>" readonly>
                                        </div>
                                    </div>
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


                            <table class=" table-bordered  text-center  datatable">

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
                                        <th>Rate</th>
                                        <th>Value</th>
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
                                    $total_val = 0.0;
                                    foreach ($frc_data['data'] as $value) {
                                        if ($is_plain == 0) {
                                            $qty +=  $value['quantity'];
                                            $quantity = $value['quantity'];
                                            $total = $value['rate'] * $quantity;
                                            $total_val += $total;
                                        } else {
                                            $qty +=  $value['finish_qty'];
                                            $quantity = $value['finish_qty'];
                                            $total = $value['rate'] * $quantity;
                                            $total_val += $total;
                                        }


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
                                            <td><?php echo $quantity ?></td>

                                            <td><?php echo $value['rate'] ?></td>
                                            <td><?php echo $total ?></td>
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
                                        <th><?php echo $total_val;
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
            <hr>
            <div class="row">
                <div class="col-4">
                    <table class=" table-bordered    ">
                        <caption style='caption-side : top; '>SUMMARY</caption>
                        <thead>
                            <tr>
                                <th>Fabric</th>
                                <th>Design</th>
                                <th>Pcs</th>
                                <th>Qty</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $Tqty = 0.0;
                            $tval = 0.0;
                            $pcs = 0.0;
                            foreach ($frc_data['summary'] as $value) {
                                $Tqty += $value['qty'];
                                $tval += $value['total'];
                                $pcs += $value['pcs'];
                            ?>
                                <tr>
                                    <td><?php echo $value['fabric_name'] ?></td>
                                    <td><?php echo $value['design_name'] ?></td>
                                    <td><?php echo $value['pcs'] ?></td>
                                    <td><?php echo $value['qty'] ?></td>
                                    <td><?php echo $value['total'] ?></td>
                                </tr>
                            <?php  }
                            ?>
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            <th></th>
                            <th><?php echo $pcs ?></th>
                            <th><?php echo $Tqty  ?></th>
                            <th><?php echo  $tval ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable ').DataTable({

            select: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                'selectAll',
                'selectNone',
                'colvis'
            ],

            paging: false,

        });

        function printData() {
            var divToPrint = document.getElementById("Print_div");

            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th,table td {' +
                'border-bottom:1px solid black;' +
                'padding:0.5em;' + 'text-align: center;' +
                '}' +
                'label {' +
                'font-weight: bold;' +
                '}' +
                'caption {' +
                'font-weight: bold; ' +
                'align :left; !important' +
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
    });
</script>