<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-body" id="Print">
                <h4 class="card-title">STOCK LIST</h4>

                <hr>

                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="widget-content nopadding">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Home</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" id="link" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Summary</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="p-20">
                                        <table class=" table-bordered data-table text-center ">
                                            <caption class="text-center text-info" style='caption-side : top'>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h3><?php echo $godown; ?></h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <h3>STOCK LIST</h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <h3><?php echo $stock[0]['date'] ?></h3>
                                                    </div>
                                                </div>
                                            </caption>
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th>From</th>
                                                    <th>To </th>
                                                    <th>PBC</th>
                                                    <th>OBC</th>
                                                    <th>Order No</th>
                                                    <th>Fabric</th>
                                                    <th>Design Name </th>
                                                    <th>Dye </th>
                                                    <th>Matching</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $c = 1;
                                                $qty = 0.0;
                                                foreach ($stock as $value) {
                                                    $qty += $value['finish_qty'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $value['from_godown']; ?></td>
                                                        <td><?php echo $value['to_godown']; ?></td>
                                                        <td><?php echo $value['pbc']; ?></td>
                                                        <td><?php echo $value['order_barcode']; ?></td>

                                                        <td><?php echo $value['order_number']; ?></td>
                                                        <td><?php echo $value['fabric_name']; ?></td>
                                                        <td><?php echo $value['design_name']; ?></td>
                                                        <td><?php echo $value['dye'] ?></td>
                                                        <td><?php echo $value['matching'] ?></td>
                                                        <td><?php echo $value['finish_qty'] ?></td>
                                                        <td><?php echo $value['unit'] ?></td>




                                                    </tr>

                                                <?php $c = $c + 1;
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>



                                                    <th></th>
                                                    <th> </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th> </th>
                                                    <th></th>
                                                    <th> </th>
                                                    <th> </th>
                                                    <th>Total</th>
                                                    <th><?php echo $qty; ?></th>
                                                    <th></th>





                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                    <div class="p-20" id="summary">
                                        Summary
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>
                <hr>


            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#link', function(e) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/stock/getStock_summary",
            cache: false,
            data: {
                'id': <?php echo $id ?>,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
                $("#summary").html(response);
            }
        });
    });
</script>