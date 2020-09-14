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
                  <form>
                    <div class="form-row">
                      <div class="col-2">
                        <input type="date" name="date_from" id="sfrom" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                      </div>
                      <div class="col-2">
                        <input type="date" name="date_to" id="sto" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                      </div>
                      <div class="col-2">
                        <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                          <option value="">-- Select Category --</option>
                          <option value="sb1.subDeptName">Party Name</option>
                          <option value="challan_out">Challan Out</option>

                        </select>
                      </div>
                      <div class="col-2">
                        <input type="text" name="searchValue" id="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                      </div>
                      <input type="hidden" name="search" value="simple">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" name="search" value="simple" id="simplefilter" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
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
                  <form>
                    <table class=" remove_datatable">
                      <caption>Advance Filter</caption>
                      <thead>
                        <tr>
                          <th>Date_from</th>
                          <th>Date_to</th>
                          <th>Party Name</th>
                          <th>DOC Challan</th>
                          <th>Challan No</th>
                        </tr>
                      </thead>
                      <tr>
                        <td><input type="date" name="date_to" id="ato" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>
                        <td>
                          <input type="date" name="date_to" id="afrom" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>
                        <td><input type="text" name="subDeptName" id="subDeptName" class="form-control form-control-sm" value="" placeholder="Party Name">
                        </td>
                        <td>
                          <input type="text" name="challan_out" id="challan_out" class="form-control form-control-sm" value="" placeholder="Doc out"></td>

                        <!-- <td>
                          <input type="text" name="challan_in" id="challan_in" class="form-control form-control-sm" value="" placeholder="challan no"></td> -->
                      </tr>
                    </table>

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button type="submit" name="search" value="advance" id="advance" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

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
          <h4 class="card-title">Material In List</h4>
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
                        <input type="date" name="date_from" id="date_from" class="form-control" value="<?php echo date('Y-04-01') ?>">
                      </div>
                      <div class="col-5">
                        <label>Date To</label>
                        <input type="date" name="date_to" id="date_to" class="form-control" value="<?php echo date('Y-m-d') ?>">
                      </div>

                      <div class="col-2">
                        <label>Search</label>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" class="btn btn-info" id="datefilter"> <i class="fas fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <hr>
              <table class="table table-bordered  text-center table-responsive" id="dye_in">
                <thead>
                  <tr class="odd" role="row">
                    <th><input type="checkbox" class="sub_chk" id="master"></th>
                    <th>Date</th>
                    <th>Party name </th>
                    <th> Challan Out </th>
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
  $(document).ready(function() {
    var fil = '';
    var table;
    getlist(fil);

    function getlist(filter1) {
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      table = $('#dye_in').DataTable({
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
          url: "<?php echo base_url('admin/Dye_transaction/showDyeOutListdata/' . $id) ?>",
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