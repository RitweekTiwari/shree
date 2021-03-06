<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div id="accordion">

                        <div class="modal-content">
                            <div class="modal-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                    Simple filter
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="modal-body">
                                    <form action="<?php echo base_url('/admin/Transaction/showStock/') . $godownid ?>" method="post">
                                        <div class="form-row">
                                            <div class="col-2">
                                                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                                            </div>
                                            <div class="col-2">
                                                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-2">
                                                <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                                                    <option value="">-- Select Category --</option>
                                                    <option value="pbc">PBC</option>
                                                    <option value="order_barcode">OBC</option>
                                                    <option value="order_number">ORDER NO</option>
                                                    <option value="fabric_name">FABRIC NAME</option>
                                                    <option value="hsn">HSN</option>
                                                    <option value="design_barcode">DESIGN BARCODE</option>
                                                    <option value="design_name">DESIGN NAME</option>
                                                    <option value="design_code">DESIGN CODE</option>
                                                    <option value="dye">DYE</option>
                                                    <option value="matching">MATCHING</option>

                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                                            </div>
                                            <input type="hidden" name="type" value="recieve"><input type="hidden" name="search" value="simple">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                            <button type="submit" name="search" value="simple" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal-content">
                            <div class="modal-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                    Advance filter
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="modal-body">
                                    <form action="<?php echo base_url('/admin/Transaction/showStock'); ?>" method="post">
                                        <table class=" remove_datatable">
                                            <caption>Advance Filter</caption>
                                            <thead>
                                                <tr>
                                                    <th>Date_from</th>
                                                    <th>Date_to</th>
                                                    <th>PBC</th>
                                                    <th>OBC</th>
                                                    <th>ORDER NO</th>
                                                    <th>FABRIC NAME</th>
                                                    <th>HSN</th>

                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>
                                                    <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                                                <td>
                                                    <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>
                                                <td><input type="text" name="pbc" class="form-control form-control-sm" value="" placeholder="pbc">
                                                </td>
                                                <td><input type="text" name="order_barcode" class="form-control form-control-sm" value="" placeholder="obc">
                                                </td>
                                                <td>
                                                    <input type="text" name="order_number" class="form-control form-control-sm" value="" placeholder="order_number"></td>
                                                <td>
                                                    <input type="date" name="fabric_name" class="form-control form-control-sm" value="" placeholder="fabric_name"></td>

                                                <td>
                                                    <input type="date" name="hsn" class="form-control form-control-sm" value="" placeholder="hsn"></td>

                                            </tr>

                                            <th>DESIGN BARCODE</th>
                                            <th>DESIGN NAME</th>
                                            <th>DESIGN CODE</th>
                                            <th>DYE</th>
                                            <th>MATCHING</th>
                                            <th>QUANTITY</th>
                                            <tr>
                                                <td>
                                                    <input type="text" name="design_barcode" class="form-control form-control-sm" value="" placeholder="DESIGN BARCODE"></td>
                                                <td>
                                                    <input type="text" name="design_name" class="form-control form-control-sm" value="" placeholder="DESIGN NAME"></td>

                                                <td>
                                                    <input type="text" name="design_code" class="form-control form-control-sm" value="" placeholder="DESIGN CODE"></td>

                                                <td>
                                                    <input type="text" name="dye" class="form-control form-control-sm" value="" placeholder="Dye"></td>
                                                <td>
                                                    <input type="text" name="matching" class="form-control form-control-sm" value="" placeholder="Matching"></td>
                                                <td>
                                                    <input type="text" name="quantity" class="form-control form-control-sm" value="" placeholder="Curr Qty"></td>

                                            </tr>

                                        </table>
                                        <input type="hidden" name="type" value="recieve"><input type="hidden" name="search" value="advance">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                        <button type="submit" name="search" value="advance" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>


        <!-- **************** Product List *****************  -->
        <div class="col-md-12 bg-white">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stock of Godown</h4>
                    <hr>

                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <div class="row well">

                                <div class="col-6">

                                    <form id="frc_dateFilter">

                                        <div class="form-row ">
                                            <div class="col-5">
                                                <label>Date From</label>
                                                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                                            </div>
                                            <div class="col-5">
                                                <label>Date To</label>
                                                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-2">
                                                <label>Search</label>
                                                <input type="hidden" name="type" value="recieve">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <table class=" table-bordered data-table text-center table-responsive" id="frc">
                                <thead class="">
                                    <tr class="odd" role="row">
                                        <th><input type="checkbox" class="sub_chk" id="master"></th>
                                        <th>PBC</th>
                                        <th>OBC</th>
                                        <th>ORDER NO</th>
                                        <th>FABRIC NAME</th>
                                        <th>HSN</th>
                                        <th>DESIGN BARCODE</th>
                                        <th>DESIGN NAME</th>
                                        <th>DESIGN CODE</th>
                                        <th>DYE</th>
                                        <th>MATCHING</th>
                                        <th>QUANTITY</th>
                                        <th>UNIT</th>
                                        <th>IMAGE</th>
                                        <th>DAYS REM.</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    $qty = 0.0;
                                    foreach ($plain_data as $value) {
                                        $qty += $value['quantity'];
                                    ?>
                                        <tr class="gradeU" id="tr_<?php echo $c ?>">
                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['order_product_id'] ?>"></td>

                                            <td><?php echo $value['pbc']; ?></td>
                                            <td><?php echo $value['order_barcode']; ?></td>

                                            <td><?php echo $value['order_number']; ?></td>
                                            <td><?php echo $value['fabric_name']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td><?php echo $value['design_barcode']; ?></td>
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
                                    <?php

                                    foreach ($dye_data as $value) {
                                        $qty += $value['current_stock'];
                                    ?>
                                        <tr class="gradeU" id="tr_<?php echo $c ?>">
                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['trans_meta_id'] ?>"></td>

                                            <td><?php echo $value['order_barcode']; ?></td>
                                            <td>Null</td>

                                            <td>Null</td>
                                            <td><?php echo $value['fabricName']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td><?php echo $value['color'] ?></td>
                                            <td>Null</td>
                                            <td><?php echo $value['current_stock'] ?></td>
                                            <td><?php echo $value['stock_unit'] ?></td>
                                            <td>Null</td>

                                            <td><?php echo $value['created_date'] ?></td>



                                        </tr>

                                    <?php $c = $c + 1;
                                    } ?>
                                    <?php

                                    foreach ($frc_data as $value) {
                                        $qty += $value['current_stock'];
                                    ?>
                                        <tr class="gradeU" id="tr_<?php echo $c ?>">
                                            <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['fsr_id'] ?>"></td>

                                            <td><?php echo $value['parent_barcode']; ?></td>
                                            <td>Null</td>

                                            <td>Null</td>
                                            <td><?php echo $value['fabricName']; ?></td>
                                            <td><?php echo $value['hsn']; ?></td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td>Null</td>
                                            <td><?php echo $value['current_stock'] ?></td>
                                            <td><?php echo $value['stock_unit'] ?></td>
                                            <td>Null</td>

                                            <td><?php echo $value['created_date'] ?></td>



                                        </tr>

                                    <?php $c = $c + 1;
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="odd" role="row">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th> </th>
                                        <th> </th>
                                        <th></th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th></th>
                                        <th></th>
                                        <th> <?php echo $qty
                                                ?></th>
                                        <th></th>
                                        <th></th>
                                        <th> </th>



                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div id='summary'></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- <script type="text/javascript">
    var summary = [];
    var count = 0;
    var i = 0;
    $(document).ready(function() {

        $("#frc tbody tr").each(function() {

            var self = $(this);
            var fabric = self.find("td:eq(4)").text().trim();
            var qty = Number(self.find("td:eq(11)").text().trim());
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
                html += '<td>' + Math.round((array[index][2] + Number.EPSILON) * 100) / 100 + '</td>';
                html += '</tr></tbody>';
            }
            html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' + Math.round((tqty + Number.EPSILON) * 100) / 100 +
                '</th></tr>';
            html += '</table>';

            $('#summary').html(html);
        }
    });
</script> -->
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
                    url: "<?= base_url() ?>admin/Transaction/return_print_multiple",
                    cache: false,
                    data: {
                        'ids': data,
                        'godown': '<?php echo $godown ?>',
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