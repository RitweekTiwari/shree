<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home" aria-selected="true">HOME</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#get_pending" aria-selected="false">PENDING
                <span class="badge badge-pill badge-info"><?php echo $order_count->pending ?></span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#get_cancel" aria-selected="false">CANCEL
                <span class="badge badge-pill badge-secondary"><?php echo $order_count->cancel ?></span></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#get_complete" aria-selected="false">Program in P.G List <span class="badge badge-pill badge-success"><?php echo $order_count->done ?></span></a></li>
          </ul>
          <div class="tab-content tabcontent-border">
            <div id="home" class="tab-pane active show" role="tabpanel">
              <p>
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#4099ff,#73b4ff);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-plus"></i>
                          </h1>
                          <a href="<?php echo base_url('admin/Orders/addOrders'); ?>">
                            <h4 class="font-light text-white"> <i class="mdi mdi-cart"></i></h4>
                            <h5 class="text-white">ADD ORDERS</h5>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#fad961,#f76b1c);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-eye"></i>
                          </h1>
                          <a href="<?php echo base_url('admin/Orders/'); ?>">
                            <h4 class="font-light text-white"><i class="mdi mdi-cart"></i></h4>
                            <h5 class="text-white">SHOW ORDERS</h5>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#5b247a,#ea6060);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-chart-bar"></i>
                          </h1>
                          <a href="<?php echo base_url('admin/Orders/order_flow'); ?>">
                            <h4 class="font-light text-white"><i class="mdi mdi-cart"></i></h4>
                            <h5 class="text-white">ORDERS FLOW</h5>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#b1ea4d,#459522);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-information"></i>
                          </h1>
                          <h4 class="font-light text-white"><?php echo $order_count->total; ?></h4>
                          <h5 class="text-white">TOTAL ORDERS</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#f2d50f,#da0641);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-lan-pending"></i>
                          </h1>
                          <h4 class="font-light text-white"><?php echo $order_count->pending; ?></h4>
                          <h5 class="text-white">PENDING ORDERS</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box text-center" style="background: linear-gradient(45deg,#F5515F,#A1051D);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-alert"></i>
                          </h1>
                          <h4 class="font-light text-white"><?php echo $order_count->cancel; ?></h4>
                          <h5 class="text-white">CANCEL ORDERS</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#FF57B9,#A704FD);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-border-outside"></i>
                          </h1>
                          <h4 class="font-light text-white"><?php echo $order_count->inprocess; ?></h4>
                          <h5 class="text-white">INPROCESS ORDERS</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <div class="card card-hover">
                        <div class="box  text-center" style="background: linear-gradient(45deg,#fad961,#f76b1c);">
                          <h1 class="font-light text-white">
                            <i class="mdi mdi-check"></i>
                          </h1>
                          <h4 class="font-light text-white"><?php echo $order_count->done ?></h4>
                          <h5 class="text-white">DONE ORDERS</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </p>
            </div>
            <div id="get_pending" class="tab-pane fade p-20" role="tabpanel">
              <h3>ORDER PENDING</h3>
              <hr>
              <div class="row ">

                <div class="col-md-11 "><button class="btn btn-danger cancel_all" href="#Cancel" data-toggle="modal" data-original-title="Edit"><i class="mdi mdi-delete "></i> Cancel</button> </div>
                <div class="col-md-1 ">
                  <button class="btn btn-primary done_all">Done</button>
                </div>
              </div>

              <p>
                <table class="table table-bordered data-table text-center ">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="master"></th>
                      <th>ORDER DATE</th>
                      <th>ORDER NUMBER</th>
                      <th>CUSTOMER NAME</th>
                      <th>Series Number</th>
                      <th>Order Barcode</th>
                      <th>Fabric Name</th>
                      <th>Hsn</th>
                      <th>Design Name</th>
                      <th>Design Code</th>
                      <th>Stitch</th>
                      <th>Dye</th>
                      <th>Matching</th>
                      <th>Remark</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      <th>Priority</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    foreach ($get_pending as $value) : ?>
                      <tr class="gradeU" id="<?php echo $i ?>">
                        <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['order_product_id'] ?>">
                        </td>
                        <td><?php echo my_date_show($value['order_date']); ?></td>
                        <td><?php echo $value['order_number']; ?></td>
                        <td><?php echo $value['customer_name']; ?></td>
                        <td><?php echo $value['series_number'] ?></td>
                        <td><?php echo $value['order_barcode']; ?></td>
                        <td><?php echo $value['fabric_name']; ?></td>
                        <td><?php echo $value['hsn']; ?></td>
                        <td><?php echo $value['design_name'] ?></td>
                        <td><?php echo $value['design_code'] ?></td>
                        <td><?php echo $value['stitch'] ?></td>
                        <td><?php echo $value['dye'] ?></td>
                        <td><?php echo $value['matching'] ?></td>
                        <td><?php echo $value['remark'] ?></td>
                        <td><?php echo $value['quantity'] ?></td>
                        <td><?php echo $value['unit'] ?></td>
                        <td><?php echo $value['priority'] ?></td>
                      </tr>

                    <?php $i += 1;
                    endforeach; ?>
                  </tbody>
                </table>
              </p>
            </div>
            <div id="get_cancel" class="tab-pane fade p-20" role="tabpanel">
              <h3>CANCEL ORDER</h3>
              <hr>
              <p>
                <table class="table table-bordered data-table text-center ">
                  <thead>
                    <tr>
                      <th>ORDER DATE</th>
                      <th>ORDER NUMBER</th>
                      <th>CUSTOMER NAME</th>
                      <th>Series Number</th>
                      <th>Order Barcode</th>
                      <th>Fabric Name</th>
                      <th>Hsn</th>
                      <th>Design Name</th>
                      <th>Design Code</th>
                      <th>Stitch</th>
                      <th>Dye</th>
                      <th>Matching</th>
                      <th>Remark</th>
                      <th>Quntity</th>
                      <th>Unit</th>
                      <th>Cause of Cancel</th>
                      <th>Date of Cancel</th>
                      <th>Priority</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    foreach ($get_cancel as $value) : ?>
                      <tr class="gradeU" id="<?php echo $i ?>">
                        <td><?php echo my_date_show($value['order_date']); ?></td>
                        <td><?php echo $value['order_number']; ?></td>
                        <td><?php echo $value['customer_name']; ?></td>
                        <td><?php echo $value['series_number'] ?></td>
                        <td><?php echo $value['order_barcode']; ?></td>
                        <td><?php echo $value['fabric_name']; ?></td>
                        <td><?php echo $value['hsn']; ?></td>
                        <td><?php echo $value['design_name'] ?></td>
                        <td><?php echo $value['design_code'] ?></td>
                        <td><?php echo $value['stitch'] ?></td>
                        <td><?php echo $value['dye'] ?></td>
                        <td><?php echo $value['matching'] ?></td>
                        <td><?php echo $value['remark'] ?></td>
                        <td><?php echo $value['quantity'] ?></td>
                        <td><?php echo $value['unit'] ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $value['date'] ?></td>
                        <td><?php echo $value['priority'] ?></td>
                      </tr>
                    <?php $i += 1;
                    endforeach; ?>
                  </tbody>
                </table>
              </p>
            </div>
            <div id="get_complete" class="tab-pane fade p-20" role="tabpanel">
              <h3>Program in P.G List</h3>
              <hr>
              <div class="row ">

                <button class="btn btn-danger cancel_all2" href="#Cancel" data-toggle="modal" data-original-title="Edit"><i class="mdi mdi-delete "></i> Cancel</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-info print_all"><i class="fa fa-print "></i> Print </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-warning deassign">PBC De-assign </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-success " href='<?php echo base_url('admin/Orders/dashboard'); ?>' style="color:#fff;">PBC Assign </a>

              </div>
              <hr>
              <p>
                <table class="table table-bordered data-table text-center ">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="master2"></th>
                      <th>P_BARCODE</th>
                      <th>ORDER DATE</th>
                      <th>ORDER NUMBER</th>
                      <th>CUSTOMER NAME</th>
                      <th>Godown</th>
                      <th>Series Number</th>
                      <th>Order Barcode</th>
                      <th>Fabric Name</th>
                      <th>Hsn</th>
                      <th>Design Name</th>
                      <th>Design Code</th>
                      <th>Stitch</th>
                      <th>Dye</th>
                      <th>Matching</th>
                      <th>Remark</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      <th>Priority</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    foreach ($get_complete as $value) : ?>
                      <tr class="gradeU" id="<?php echo $i ?>">
                        <td><input type="checkbox" class="sub_chk2" data-id="<?php echo $value['order_product_id'] ?>">
                        </td>
                        <td><input type="text" class="form-control pbc" name='pbc' value='<?php echo $value['pbc'] ?>' id="pbc<?php echo $i ?>">
                        </td>
                        <td><?php echo my_date_show($value['order_date']); ?></td>
                        <td><?php echo $value['order_number']; ?></td>
                        <td><?php echo $value['customer_name']; ?></td>
                        <td><?php echo $value['godown']; ?></td>
                        <td><?php echo $value['series_number']; ?></td>
                        <td><?php echo $value['order_barcode']; ?></td>
                        <td id="tdfab<?php echo $i ?>"><?php echo $value['fabric_name']; ?></td>
                        <td><?php echo $value['hsn']; ?></td>
                        <td><?php echo $value['design_name']; ?></td>
                        <td><?php echo $value['design_code']; ?></td>
                        <td><?php echo $value['stitch']; ?></td>
                        <td><?php echo $value['dye']; ?></td>
                        <td><?php echo $value['matching']; ?></td>
                        <td><?php echo $value['remark']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <td><?php echo $value['unit']; ?></td>
                        <td><?php echo $value['priority']; ?></td>
                      </tr>
                    <?php $i += 1;
                    endforeach; ?>
                  </tbody>
                </table>
              </p>
            </div>
          </div>
          <div id="Cancel" class="modal hide">
            <div class="modal-dialog" role="document ">
              <div class="modal-content">
                <form action="<?php echo base_url('admin/Orders/cancel_status/'); ?>" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title">Cause Of Cancel</h5>
                    <button data-dismiss="modal" class="close" type="button">×</button>

                  </div>
                  <div class="modal-body">
                    <div class="widget-content nopadding">
                      <div class="form-group row">
                        <label class="control-label col-sm-3">Cause</label>
                        <div class="col-sm-9">
                          <select name="cause" id="" class="form-control">
                            <option value="">Select Cause</option>
                            <?php foreach ($cause as $row) { ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3">Cancel Date</label>
                        <div class="col-sm-9">
                          <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d') ?>">
                          <input type="hidden" name="ids" id="ids">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="submit" value="Cancel" class="btn btn-primary">
                    <a data-dismiss="modal" class="btn" href="#">Close</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#master').on('click', function(e) {
    if ($(this).is(':checked', true)) {
      $(".sub_chk").prop('checked', true);
    } else {
      $(".sub_chk").prop('checked', false);
    }
  });
  jQuery('.print_all').on('click', function(e) {
    var allVals = [];
    $(".sub_chk2:checked").each(function() {
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
          url: "<?= base_url() ?>admin/Orders/return_print_multiple",
          cache: false,
          data: {
            'ids': data,

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
  $('.cancel_all').on('click', function(e) {
    var allVals = [];
    $(".sub_chk:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });
    //alert(allVals.length); return false;
    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      //$("#loading").show();
      WRN_PROFILE_DELETE = "Are you sure you want to cancel this row?";
      var check = confirm(WRN_PROFILE_DELETE);
      if (check == true) {
        //for server side
        var join_selected_values = allVals.join(",");
        $("#ids").val(join_selected_values);
      }
    }
  });
  $('.cancel_all2').on('click', function(e) {
    var allVals = [];
    $(".sub_chk2:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });
    //alert(allVals.length); return false;
    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      //$("#loading").show();
      WRN_PROFILE_DELETE = "Are you sure you want to cancel this row?";
      var check = confirm(WRN_PROFILE_DELETE);
      if (check == true) {
        //for server side
        var join_selected_values = allVals.join(",");
        $("#ids").val(join_selected_values);
      }
    }
  });
  $('.done_all').on('click', function(e) {
    var allVals = [];
    $(".sub_chk:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });
    //alert(allVals.length); return false;
    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      //$("#loading").show();
      WRN_PROFILE_DELETE = "Are you sure you want to do this row?";
      var check = confirm(WRN_PROFILE_DELETE);
      if (check == true) {
        //for server side
        var join_selected_values = allVals.join(",");
        // alert (join_selected_values);exit;

        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/Orders/done_status') ?>",
          cache: false,
          data: {
            'ids': join_selected_values,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(response) {
            location.reload(true);

          }
        });
      }
    }
  });
  jQuery('.deassign').on('click', function(e) {
    var allVals = [];
    $(".sub_chk2:checked").each(function() {
      allVals.push($(this).attr('data-id'));
    });
    //alert(allVals.length); return false;
    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      //$("#loading").show();
      WRN_PROFILE_DELETE = "Are you sure you want to Deassign this?";
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
        var button_id = $(this).parent().parent().attr('id');
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>admin/Orders/deassign",
          cache: false,
          data: {
            'ids': data,

            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(response) {
            if (response == 1) {
              toastr.success('Success!', "De-Assigned successfully");
              Location.reload();
            } else {
              toastr.error('Failed!', response);
            }
          }
        });
        //for client side

      }
    }
  });
  $(document).on('change', '.pbc', function(e) {
    var pbc = $(this).val();


    pbc = pbc.toUpperCase();
    $(this).val(pbc);
    var button_id = $(this).parent().parent().attr('id');
    var id = $(this).parent().parent().find('.sub_chk2').attr('data-id');
    console.log(button_id);
    var fabric = $('#tdfab' + button_id + '').html();
    var csrf_name = $("#get_csrf_hash").attr('name');
    var csrf_val = $("#get_csrf_hash").val();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('admin/orders/assignPbc') ?>",
      data: {

        'id': pbc,
        'fabric': fabric,
        'order_product_id': id,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
      },

      success: function(data) {
        if (data == 0) {
          toastr.error('Failed!', "fabric did not match");
        } else if (data == 1) {
          toastr.success('Success!', "Assigned successfully");
          button_id = Number(button_id) + 1;
          $('#pbc' + button_id + '').val('');
          $('#pbc' + button_id + '').focus();
        } else if (data == 2) {
          toastr.error('Failed!', "PBC Not Found");
        } else {
          toastr.error('Failed!', data);
        }


      }
    });



  });
  $('#master2').on('click', function(e) {
    console.log("master2");
    if ($(this).is(':checked', true)) {
      $(".sub_chk2").prop('checked', true);
    } else {
      $(".sub_chk2").prop('checked', false);
    }
  });
</script>