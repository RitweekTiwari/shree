<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Stock of Plain Fabric</h4>
                    <hr>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label ">PBC Barcode</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="barcode1" placeholder="Barcode">
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-success" id="print1">Print</button>
                            <button type="button" class="btn btn-warning" id="print2">Print</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Program in P.G List</h4>
                    <hr>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label ">OBC Barcode</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="barcode2" placeholder="Barcode">
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary" id="print3">Print</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Stock of Godown(Finish)</h4>
                    <hr>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label ">OBC Barcode</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="barcode3" placeholder="Barcode">
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-success" id="print4">Print</button>
                            <button type="button" class="btn btn-primary" id="print5">Print</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#print1').on('click', function(e) {
        var barcode = $('#barcode1').val();
        if (barcode != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>admin/FRC/return_print_multiple",
                cache: false,
                data: {
                    'barcode': barcode,
                    'title': 'Challan Receive Detail',
                    'type': 'barcode',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {
                    var w = window.open('about:blank');
                    w.document.open();
                    w.document.write(response);
                    w.document.close();
                }
            });
        } else {
            toastr.error('Failed!', "Please enter some value");
        }

        //for client side



    });
    jQuery('#print2').on('click', function(e) {
        var barcode = $('#barcode1').val();
        if (barcode != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>admin/FRC/return_print_multiple",
                cache: false,
                data: {
                    'barcode': barcode,
                    'title': 'Challan Receive Detail',
                    'type': 'barcode1',
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
        } else {
            toastr.error('Failed!', "Please enter some value");
        }

    });
    jQuery('#print3').on('click', function(e) {
        var barcode = $('#barcode2').val();
        if (barcode != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>admin/Orders/return_print_multiple",
                cache: false,
                data: {
                    'barcode': barcode,

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
        } else {
            toastr.error('Failed!', "Please enter some value");
        }
    });

    jQuery('#print4').on('click', function(e) {
        var barcode = $('#barcode3').val();
        if (barcode != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>admin/Transaction/return_print_multiple",
                cache: false,
                data: {
                    'barcode': barcode,
                    'godown': 19,
                    'type': 'barcode2',
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
        } else {
            toastr.error('Failed!', "Please enter some value");
        }
    });

    jQuery('#print5').on('click', function(e) {
        var barcode = $('#barcode3').val();
        if (barcode != '') {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>admin/Transaction/return_print_multiple",
                cache: false,
                data: {
                    'barcode': barcode,
                    'godown': 19,
                    'type': 'barcode1',
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
        } else {
            toastr.error('Failed!', "Please enter some value");
        }

    });
</script>