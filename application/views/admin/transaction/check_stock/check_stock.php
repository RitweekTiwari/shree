<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-body" id="Print">
                <h4 class="card-title">STOCK CHECK</h4>

                <hr>
                <div class="row ">


                    <div class="col-md-4 "><input type="text" id="obc" class="form-control" placeholder="OBC Recieve"> </div>
                </div>

                <hr>

                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="widget-content nopadding">


                            <table class=" table-bordered  text-center " id="list">

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
                                        <th>Rate</th>
                                        <th>Value</th>
                                        <th>Unit</th>

                                    </tr>
                                </thead>
                                <tfoot>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>



                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>

                <div>
                    <button type="submit" id="Recieve" class="btn btn-success btn-md">Recieve</button>
                </div>

            </div>
        </div>
        <div id='summary'></div>
    </div>
</div>


<script>
    $(document).ready(function() {
        getlist();
        $(document).on('click', '#Recieve', function(e) {
            var x = confirm("Do you want to print this");
            var print = "";
            if (x == true) {
                print = 1;
            } else {
                print = 0;
            }
            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/stock/save_stock') ?>",
                data: {

                    'print': print,
                    'godown': <?php echo $id; ?>,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                beforeSend: function() {
                    $('input[name="phone_no"]').parent().find('label').append('<span><img width="100" height="100" src="<?php echo base_url('optimum/loading.svg') ?>" /></span>');
                },
                success: function(data) {
                    if (data != 0) {
                        var w = window.open('about:blank');
                        w.document.open();
                        w.document.write(data);
                        w.document.close();
                    }


                }
            });
        });
        var table;

        $(document).on('change', '#obc', function(e) {
            var obc = $('#obc').val();

            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/stock/recieve_obc') ?>",
                data: {

                    'obc': obc,
                    'type':'obc',
                    'godown': <?php echo $id; ?>,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },

                success: function(data) {
                    if (data == 0) {
                        toastr.error('Failed!', "OBC did not match");
                    } else if (data == 1) {
                        toastr.success('Success!', "Recieved successfully");
                        $('#obc').val("");
                        $('#obc').focus();
                        table.ajax.reload();
                    } else if (data == 2) {
                        toastr.error('Failed!', "Something went wrong..Status not updated");
                    } else {
                        toastr.error('Failed!', data);
                    }


                }
            });
        });

        function getlist() {
            table = $('#list').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url('admin/stock/getBill/') . $id ?>",
                    type: "GET",
                    "dataSrc": function(json) {
                        if (json.recieved && json.recieved == true) {
                            $('#Recieve').show();
                        } else {
                            $('#Recieve').hide();
                        }
                        // You can also modify `json.data` if required
                        return json.data;
                    },
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    qty = api
                        .column(9)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    value = api
                        .column(11)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Update footer
                    $(api.column(9).footer()).html(
                        qty
                    );
                    $(api.column(11).footer()).html(
                        value
                    );
                },
                "createdRow": function(row, data, dataIndex) {
                    if (data[13] == 0) {
                        $(row).addClass('bg-secondary text-white');
                    }
                },
                "columnDefs": [{
                        "targets": [13],
                        "visible": false,
                        "searchable": false
                    },

                ],

                scrollY: 500,
                scrollX: false,
                scrollCollapse: true,
                paging: false

            });
        }

    });
</script>