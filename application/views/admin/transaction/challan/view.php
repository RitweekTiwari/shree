<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-body" id="Print">
                <h4 class="card-title">Challan Receive Detail</h4>

                <hr>
                <div class="row ">


                    <div class="col-md-4 "><input type="text" id="obc" class="form-control" placeholder="OBC Recieve"> </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">

                        <table class="table-box">
                            <tr>
                                <td><label>From</label></td>
                                <td>
                                    <div class="col-md-12">
                                        <label>Job Work Party Name</label>
                                        
                                        <select name="FromParty" class="form-control" id="toParty" readonly>
                                        <?php foreach ($branch_data as $value) : ?>
                                        <option value="<?php echo $value->id ?>" <?php if($value->id==$trans_data[0]['fromParty']){echo"selected";} ?>> <?php echo $value->name; ?></option>
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
                              <option value="<?php echo $value->id ?>" <?php if($value->id==$job2){echo"selected";} ?>> <?php echo $value->name; ?></option>
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
                                            <td><input type="text" class="form-control " name="challan" value="<?php echo $trans_data[0]['challan_in']; ?>" readonly></td>
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


                            <table class=" table-bordered  text-center " id="list">

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
                                        <th>Remark</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
                <hr>

                <div id="Recieve">
                    <form action="<?php echo base_url('admin/Transaction/recieve/')  ?>" method="post">
                        <input type="hidden" name="trans_id" value="<?php echo $trans_data[0]['transaction_id']; ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" name="submit" class="btn btn-success btn-md">Recieve</button>
                    </form>
                </div>

            </div>
        </div>
 <div id='summary'></div>
    </div>
</div>


<script>
    $(document).ready(function() {
        getlist();

        var table;
        $(document).on('change', '#obc', function(e) {
            var obc = $('#obc').val();

            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/transaction/recieve_obc') ?>",
                data: {
                    'trans_id': <?php echo $trans_data[0]['transaction_id']; ?>,
                    'obc': obc,
                    'godown': <?php echo $godown; ?>,
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
                    url: "<?php echo base_url('admin/transaction/getChallan/') . $id ?>",
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


                "createdRow": function(row, data, dataIndex) {
                    if (data[15] == `pending`) {
                        $(row).addClass('bg-secondary text-white');
                    }
                },
                "columnDefs": [{
                        "targets": [15],
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