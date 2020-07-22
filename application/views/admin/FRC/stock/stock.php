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
                  <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
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
                          <option value="challan_to">Godown</option>
                          <option value="parent_barcode">PBC</option>
                          <option value="fabricName">fabricName</option>
                          <option value="hsn">HSN</option>
                          <option value="challan_no">Challan no</option>
                          <option value="fabric_type">Fabric Type</option>
                          <option value="color_name">Color </option>
                          <option value="ad_no">Ad no</option>
                          <option value="stock_quantity">Quantity</option>
                          <option value="current_stock">Curr. Qty</option>
                          <option value="stock_unit">Unit</option>
                          <option value="purchase_rate">Rate</option>
                          <option value="total_amount">Total amount</option>
                        </select>
                      </div>
                      <div class="col-2">

                        <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                      </div>
                      <input type="hidden" name="type" value="stock"><input type="hidden" name="search" value="simple">
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
                  <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
                    <table class=" remove_datatable">
                      <caption>Advance Filter</caption>
                      <thead>
                        <tr>
                          <th>Date_from</th>
                          <th>Date_to</th>
                          <th>Fabric_name</th>
                          <th>PbC</th>
                          <th>Challan</th>
                          <th>Godown</th>
                        </tr>
                      </thead>
                      <tr>
                        <td>
                          <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                        <td>
                          <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>

                        <td><input type="text" name="fabricName" class="form-control form-control-sm" value="" placeholder="Fabric Name">
                        </td>

                        <td>
                          <input type="text" name="pbc" class="form-control form-control-sm" value="" placeholder="PBC">
                        </td>
                        <td>
                          <input type="text" name="challan" class="form-control form-control-sm" value="" placeholder="challan"></td>
                        <td colspan='2'>
                          <input type="text" name="challan_to" class="form-control form-control-sm" value="" placeholder="Godown"></td>
                      </tr>
                      <th>Fab Type</th>
                      <th>Curr Qty</th>
                      <th>Color</th>
                      <th>Ad No</th>
                      <th>Unit</th>
                      <th>Rate</th>
                      <th>Total</th>

                      <tr>
                        <td>
                          <input type="text" name="fabric_type" class="form-control form-control-sm" value="" placeholder="Fab Type"></td>
                        <td>
                          <input type="text" name="current_stock" class="form-control form-control-sm" value="" placeholder="Curr Qty"></td>

                        <td>
                          <input type="text" name="Color" class="form-control form-control-sm" value="" placeholder="Color"></td>
                        <td>
                          <input type="text" name="Ad_No" class="form-control form-control-sm" value="" placeholder="Ad No"></td>
                        <td>
                          <input type="text" name="unit" class="form-control form-control-sm" value="" placeholder="Unit"></td>
                        <td>
                          <input type="text" name="rate" class="form-control form-control-sm" value="" placeholder="Rate"></td>
                        <td>
                          <input type="text" name="total" class="form-control form-control-sm" value="" placeholder="Total"></td>
                      </tr>
                    </table>
                    <input type="hidden" name="type" value="stock"><input type="hidden" name="search" value="advance">
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
          <h4 class="card-title">Stock of Plain Fabric</h4>
          <hr>

          <div class="widget-box">
            <div class="widget-content nopadding">
              <div class="row well">
                <div class="col-6">
                  <a type="button" class="btn  pull-left print_all_barcode btn-success" target="_blank" style="color:#fff;"><i class="fa fa-print"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;<a type="button" class="btn  pull-left  btn-warning" id='print_all_barcode1' target="_blank" style="color:#fff;"><i class="fa fa-print"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;<a type="button" class="btn btn-info   btn-success" href='<?php echo base_url('/admin/FRC/show_stock'); ?>' style="color:#fff;">Clear filter</a>
                </div>
                <div class="col-6">

                  <form action="<?php echo base_url('/admin/FRC/show_stock'); ?>" method="post">

                    <div class="form-row ">
                      <div class="col-5">
                        <label>Date From</label>
                        <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo $from ?>">
                      </div>
                      <div class="col-5">
                        <label>Date To</label>
                        <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo $to ?>">
                      </div>
                      <div class="col-2">
                        <label>Search</label>
                        <input type="hidden" name="type" value="stock">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <hr>
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home" aria-selected="true">HOME</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#summary" aria-selected="false">Summary</a></li>

              </ul>

              <div class="tab-content tabcontent-border">
                <div id="home" class="tab-pane active show" role="tabpanel">
                  <table class=" table-bordered  data-table text-center table-responsive  " id="frc">
                    <?php echo $content; ?>
                  </table>
                </div>

                <div id="summary" class="tab-pane fade p-20" role="tabpanel">
                  <a type="button" class="btn  pull-left  btn-info" target="_blank" id='Print_summary' style="color:#fff;"><i class="fa fa-print"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn  pull-left  btn-info" id='Excel' style="color:#fff;">Excel</a>
                  <hr>
                  <?php if (isset($frc_data['summary'])) {; ?>
                    <table class=" table-bordered data-table text-center  table-responsive " id='dt_summary'>
                      <tr>
                        <caption class="text-center text-info" style='caption-side : top'>Summary</caption>
                        <?php foreach ($frc_data['type'] as $fabtype) { ?>
                          <td class="align-top">
                            <table class=" table-bordered  data-table text-center  table-responsive ">
                              <caption class="text-center text-info" style='caption-side : top'><?php echo $fabtype['type'] ?></caption>
                              <thead>
                                <th>Fabric</th>
                                <th>Pcs</th>
                                <th>Quantity</th>
                                <th>Total</th>
                              </thead>
                              <tbody><?php
                                      $pcs = 0;
                                      $qty = 0;
                                      $total = 0;
                                      foreach ($frc_data['summary'] as $value) {
                                        if ($value['fabric_type'] == $fabtype['type']) {
                                          $pcs += $value['pcs'];
                                          $qty += $value['qty'];
                                          $total += $value['total'];
                                      ?>
                                    <tr>
                                      <td><?php echo  $value['fabricName'] ?></td>
                                      <td><?php echo  $value['pcs'] ?></td>
                                      <td><?php echo  $value['qty'] ?></td>
                                      <td><?php echo  $value['total'] ?></td>
                                    </tr>

                                <?php }
                                      } ?>
                              </tbody>
                              <tr>
                                <th>Total</th>
                                <th><?php echo  $pcs ?></th>
                                <th><?php echo  $qty ?></th>
                                <th><?php echo  $total ?></th>
                              </tr>
                            </table>
                          </td>
                          <td></td>


                        <?php } ?>
                      </tr>
                    </table>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>


      <script>
        $(document).ready(function() {
          function printData() {
            var divToPrint = document.getElementById("dt_summary");
            newWin = window.open("");
            newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/dist/css/style.min.css\" type=\"text/css\" media=\"print\"/>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.close();
            newWin.print();

          }

          $('#Print_summary').on('click', function() {
            printData();

          })
          $('#Excel').on('click', function() {

            var htmltable = document.getElementById('dt_summary');
            var html = htmltable.outerHTML;
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));

          })
          <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
          <?php } else if ($this->session->flashdata('error')) {  ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
          <?php } else if ($this->session->flashdata('warning')) {  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
          <?php } else if ($this->session->flashdata('info')) {  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
          <?php } ?>
        });

        jQuery('.print_all_barcode').on('click', function(e) {
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
                url: "<?= base_url() ?>admin/FRC/return_print_multiple",
                cache: false,
                data: {
                  'ids': data,
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
              //for client side

            }
          }
        });
        jQuery('#print_all_barcode1').on('click', function(e) {
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
                url: "<?= base_url() ?>admin/FRC/return_print_multiple",
                cache: false,
                data: {
                  'ids': data,
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

            }
          }
        });
      </script>