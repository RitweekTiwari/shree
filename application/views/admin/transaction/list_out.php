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
                  <form action="<?php echo base_url('/admin/Transaction/filter1'); ?>" method="post">
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
                          <option value="sort_name">Party Name</option>
                          <option value="challan_no">Challan no</option>
                          <option value="fabric_type">Fabric Type</option>
                          <option value="total_quantity">Quantity</option>
                          <option value="unitName">Unit</option>
                          <option value="total_amount">Total amount</option>
                        </select>
                      </div>
                      <div class="col-2">
                        <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                      </div>
                      <input type="hidden" name="type" value="return"><input type="hidden" name="search" value="simple">
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
                  <form action="<?php echo base_url('/admin/Transaction/filter1'); ?>" method="post">
                    <table class=" remove_datatable">
                      <caption>Advance Filter</caption>
                      <thead>
                        <tr>
                          <th>Date_from</th>
                          <th>Date_to</th>
                          <th>Party Name</th>
                          <th>challan No</th>
                          <th>Fabric Type</th>
                          <th>Quantity</th>
                          <th>Unit</th>
                          <th>Total Amount</th>
                        </tr>
                      </thead>
                      <tr>
                        <td><input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>
                        <td>
                          <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>
                        <td><input type="text" name="sort_name" class="form-control form-control-sm" value="" placeholder="Party Name">
                        </td>
                        <td>
                          <input type="text" name="challan" class="form-control form-control-sm" value="" placeholder="challan"></td>




                        <td>
                          <input type="text" name="fabric_type" class="form-control form-control-sm" value="" placeholder="Fab Type"></td>
                        <td>
                          <input type="text" name="total_quantity" class="form-control form-control-sm" value="" placeholder="Curr Qty"></td>

                        <td>
                          <input type="text" name="unitName" class="form-control form-control-sm" value="" placeholder="Unit"></td>

                        <td>
                          <input type="text" name="total_amount" class="form-control form-control-sm" value="" placeholder="Total"></td>
                      </tr>
                    </table>
                    <input type="hidden" name="type" value="return"><input type="hidden" name="search" value="advance">
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
          <h4 class="card-title">Material Out List</h4>
          <hr>

          <div class="widget-box">
            <div class="widget-content nopadding">
              <div class="row well">
                <div class="col-6"> &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;<a type="button" class="btn btn-info pull-left print_all btn-success" style="color:#fff;"><i class="fa fa-print"></i></a>
                </div>
                <div class="col-6">
                  <form id="frc_dateFilter">

                    <div class="form-row ">
                      <div class="col-5">
                        <label>Date From</label>
                        <input type="date" name="date_from" class="form-control" value="<?php echo date('Y-04-01') ?>">
                      </div>
                      <div class="col-5">
                        <label>Date To</label>
                        <input type="date" name="date_to" class="form-control" value="<?php echo date('Y-m-d') ?>">
                      </div>
                      <input type="hidden" name="type" value="return">
                      <div class="col-2">
                        <label>Search</label>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <hr>
              <table class=" table-bordered  text-center " id="list">
                <thead class="">
                  <tr class="odd" role="row">
                    <th><input type="checkbox" class="sub_chk" id="master"></th>
                    <th>Date</th>

                    <th>Party name</th>
                    <th>Type </th>
                    <th>Challan no</th>


                    <th>View </th>


                  </tr>
                </thead>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


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
          url: "<?= base_url() ?>admin/Transaction/viewChallanOut",
          cache: false,
          data: {
            'challan_id': data,
            'type': 'table',
            'godown': <?php echo $id ?>,
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
  $(document).ready(function() {
    var fil = '';
    var table;
    getlist(fil);

    function getlist(filter1) {
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      table = $('#list').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 250,
        "lengthMenu": [
          [250, 500, 1000, -1],
          [250, 500, 1000, "All"]
        ],
        select: true,

        dom: 'Bfrtip',
        buttons: [
          'pageLength', {
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

        "destroy": true,
        scrollY: 500,
        paging: true,


        "ajax": {
          url: "<?php echo base_url('admin/transaction/showOutListdata/' . $id) ?>",
          type: "post",
          data: {
            filter: filter1,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          "dataSrc": function(json) {
            return json.data;
          },
        },
      });
    }
    $("#datefilter").click(function(event) {
      event.preventDefault();
      var filter = {
        'from': $('#date_from').val(),
        'to': $('#date_to').val(),
        'search': 'datefilter'
      };

      $('#dye_in').DataTable().destroy();
      getlist(filter);

    });

    $("#simplefilter").click(function(event) {
      event.preventDefault();
      var filter = {
        'searchByCat': $('#searchByCat').val(),
        'searchValue': $('#searchValue').val(),
        'challan_from': $('#sfrom').val(),
        'challan_to': $('#sto').val(),
        'search': 'simple'
      };

      $('#dye_in').DataTable().destroy();
      getlist(filter);

    });
    $("#clearfilter").click(function(event) {
      $('#dye_in').DataTable().destroy();
      getlist('');

    });

    $("#advance").click(function(event) {
      event.preventDefault();
      var filter = {
        'search': 'advance',
        'subDeptName': $('#subDeptName').val(),
        'challan_out': $('#challan_out').val(),
        // 'challan_in': $('#challan_in').val(),
        'challan_from': $('#afrom').val(),
        'challan_to': $('#ato').val(),
      };
      $('#dye_in').DataTable().destroy();
      getlist(filter);

    });

  });
</script>