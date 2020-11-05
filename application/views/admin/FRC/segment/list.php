<div class="col-md-12 bg-white">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Challan Receive Detail</h4>

            <hr>

            <div class="widget-box">
                <div class="widget-content nopadding">
                    <div class="widget-content nopadding">


                        <table class=" table-bordered data-table text-center table-responsive" id="frc">
                            <caption style='caption-side : top' class=" text-info ">
                                <div class="row well container">
                                    <div class="col-4">
                                        <h6> Challan No - <span class="label label-primary"> <?php echo $frc_data[0]['challan_no'] ?></span>
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <h6> Challan From - <span class="label label-primary"> <?php echo $pbc[0]['sub1'] ?></span>
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <h6> Challan To - <span class="label label-primary"> <?php echo $pbc[0]['sub2'] ?></span>
                                        </h6>
                                    </div>
                                </div>
                            </caption>
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th><input type="checkbox" class="sub_chk" id="master"></th>
                                    <th>Date</th>

                                    <th>PBC</th>
                                    <th>Fabric </th>
                                    <th>Hsn </th>
                                    <th>Total qty</th>

                                    <th>Color</th>
                                    <th>Ad_no</th>
                                    <th>P_ code </th>
                                    <th>P _rate </th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                $total_qty = 0.00;
                                $total_val = 0.00;

                                foreach ($frc_data as $value) {
                                    $total_qty += $value['stock_quantity'];
                                    $total_val += $value['total_value']; ?>
                                    <tr>

                                        <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['fsr_id'] ?>"></td>
                                        <td><?php echo $value['created_date']; ?></td>

                                        <td><?php echo $value['parent_barcode']; ?></td>
                                        <td><?php echo $value['fabricName']; ?></td>
                                        <td><?php echo $value['hsn']; ?></td>

                                        <td><?php echo $value['stock_quantity'] ?></td>


                                        <td><?php echo $value['color_name'] ?></td>
                                        <td><?php echo $value['ad_no']; ?></td>
                                        <td><?php echo $value['purchase_code']; ?></td>
                                        <td><?php echo $value['purchase_rate']; ?></td>
                                        <td><?php echo $value['total_value']; ?></td>

                                    </tr>

                                <?php $c = $c + 1;
                                } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th id="th_qty"><?php echo $total_qty ?></th>

                                    <th> </th>
                                    <th></th>

                                    <th></th>
                                    <th>Total</th>
                                    <th id="th_total"><?php echo $total_val ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="widget-box">
                            <a type="button" class="btn  pull-left print_all btn-success" target="_blank" style="color:#fff;"><i class="fa fa-print"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;
                            <hr>
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>Segment List</h5>
                            </div>
                            <hr>

                            <div class="widget-content nopadding">
                                <div class="row">

                                    <table class="data-table table-bordered table-responsive" id="customer">

                                        <caption style='caption-side : top' class=" text-info ">
                                            <div class="row well container">
                                                <div class="col-4">
                                                    <h6> Challan No - <span class="label label-primary"> <?php echo $frc_data[0]['challan_no'] ?></span>
                                                    </h6>
                                                </div>
                                                <div class="col-4">
                                                    <h6> Challan From - <span class="label label-primary"> <?php echo $pbc[0]['sub1'] ?></span>
                                                    </h6>
                                                </div>
                                                <div class="col-4">
                                                    <h6> Challan To - <span class="label label-primary"> <?php echo $pbc[0]['sub2'] ?></span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </caption>
                                        <tbody> <?php if (isset($output)) { ?>

                                                <?php $i = 0;
                                                    foreach ($output as $value) : ?>

                                                    <tr>
                                                        <td>
                                                            <table class="  table-responsive">
                                                                <caption class=" text-center bg-success text-white" style='caption-side : top'><?php echo $value['segment'] ?></caption>
                                                                <thead>
                                                                    <tr>
                                                                        <th>PBC</th>
                                                                        <th>Current Qty</th>
                                                                        <th>Fabric</th>
                                                                        <th>Length</th>
                                                                        <th>Consumed Mtr</th>
                                                                        <th>PCS</th>
                                                                        <th>TC</th>
                                                                        <th>Rate</th>

                                                                        <th>Value</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0;
                                                                    $tqty = 0;
                                                                    $tlength = 0;
                                                                    $tpcs = 0;
                                                                    $ttc = 0;
                                                                    $tconsume = 0;
                                                                    $tvalue = 0;

                                                                    foreach ($value['detail'] as $row) : ?>
                                                                        <tr>
                                                                            <td><?php echo $row['pbc'] ?></td>
                                                                            <td><?php $tqty += $row['qty'];
                                                                                echo $row['qty'] ?></td>
                                                                            <td><?php echo $row['fabric'] ?></td>
                                                                            <td><?php $tlength += $row['length'];
                                                                                echo $row['length'] ?>
                                                                            </td>
                                                                            <td><?php $tpcs += $row['pcs'];
                                                                                echo $row['pcs'] ?></td>
                                                                            <td><?php $ttc += $row['tc'];
                                                                                echo $row['tc'] ?></td>
                                                                            <td><?php $tconsume += $row['tc'] * $row['pcs'];
                                                                                echo $row['tc'] * $row['pcs']  ?></td>
                                                                            <td><?php echo $row['rate'] ?></td>
                                                                            <td><?php $tvalue += $row['value'];
                                                                                echo $row['value'] ?></td>
                                                                        </tr> <?php
                                                                            endforeach; ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th><?php echo $tqty  ?></th>
                                                                        <th></th>
                                                                        <th><?php echo $tlength ?></th>
                                                                        <th><?php echo $tpcs ?></th>
                                                                        <th><?php echo $ttc  ?></th>
                                                                        <th><?php echo $tconsume ?></th>
                                                                        <th></th>
                                                                        <th><?php echo $tvalue ?></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                <?php $i++;
                                                    endforeach;
                                                } else { ?>
                                                <h5 style="color:red;"> No Segment </h5>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function printData() {
        var divToPrint = document.getElementById("customer");

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
</script>