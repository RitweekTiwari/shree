<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white" id="content_body">
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
                  <form  method="post">
                    <div class="form-row">
                      <div class="col-2">
                        <input type="date" name="from" id="from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                      </div>
                      <div class="col-2">

                        <input type="date" name="to" id="to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                      </div>
                      <div class="col-2">

                        <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                          <option value="">-- Select Category --</option>
                          <option value="session.financial_year">session</option>
                          <option value="order_table.order_number">Order Number</option>
                          <option value="order_table.pcs">Record/ Order </option>
                          <option value="order_table.branch_order_number">Branch Ord Nmb</option>
                          <option value="customer_detail.name">Customer Name</option>
                          <option value="order_type.orderType">type</option>
                          <option value="data_category.dataCategory">Order Category</option>

                        </select>
                      </div>
                      <div class="col-2">

                        <input type="text" name="searchValue" id="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                      </div>
                      <input type="hidden" name="type" value="recieve"><input type="hidden" name="search" value="simple">
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
                  <form  method="post">
                    <table class=" remove_datatable">
                      <caption>Advance Filter</caption>
                      <thead>
                        <tr>
                          <th>Date_from</th>
                          <th>Date_to</th>
                          <th>session</th>
                          <th>Order Number</th>
                          <th>Record/ Order</th>
                          <th>Branch Ord Nmb</th>
                          <th>Customer Name</th>
                          <th>Type</th>
                          <th>Order Category</th>
                        </tr>
                      </thead>
                      <tr>
                        <td>
                          <input type="date" name="Afrom" id="Afrom" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                        <td>
                          <input type="date" name="Ato" id="Ato" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>

                        <td><input type="text" name="financial_year" id="financial_year" class="form-control form-control-sm" value="" placeholder="session">
                        </td>

                        <td><input type="text" name="" id="order_number" class="form-control form-control-sm" value="" placeholder="Order number">
                        </td>

                        <td>
                          <input type="text" name="pcs" id="pcs" class="form-control form-control-sm" value="" placeholder="Record/order">
                        </td>
                        <td>
                          <input type="text" name="branch_order_number" id="branch_order_number" class="form-control form-control-sm" value="" placeholder="Branch ord Nmb"></td>
                        <td>
                          <input type="text" name="total_quantity" id="name" class="form-control form-control-sm" value="" placeholder="Customer Name "></td>
                        <td>
                          <input type="text" name="total_amount" id="orderType" class="form-control form-control-sm" value="" placeholder="Order Type "></td>
                          <td>
                            <input type="text" name="dataCategory" id="dataCategory" class="form-control form-control-sm" value="" placeholder=" Order Category"></td>
                      </tr>

                    </table>

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button type="submit" name="search" value="advance" id="advancefilter" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row well">
          &nbsp;&nbsp; &nbsp;&nbsp; <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;
        &nbsp;&nbsp;<a type="button" class="btn btn-info  btn-success" id='clearfilter'  style="color:#fff;">Clear filter</a>
        </div>
        <div class="row well">
          <div class="col-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <form  method="post">
              <div class="form-row">
                    <div class="col-1"></div>
                <div class="col-2"><label>Select Branch </label> </div>

                <div class="col-4">

                  <select id="branch_name" name="branch_name" class="form-control form-control-sm" required>
                    <option value="">-- Select Category --</option>
                    <?php foreach($branch_name as $value):?>
                     <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                   <?php endforeach;?>
                   </select>
                </div>
              <div class="col-2">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" name="search" value="Branch" id="searchBranch" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
              </div>
            </div>
            </form>
          </div>
          <div class="col-6">

            <form action="" method="post">

              <div class="form-row ">
                <div class="col-5">
                  <label>Date From</label>
                  <input type="date" name="date_from" id="date_from" class="form-control form-control-sm" value="">
                </div>
                <div class="col-5">
                  <label>Date To</label>
                  <input type="date" name="date_to" id="date_to" class="form-control form-control-sm" value="">
                </div>
                <div class="col-2">
                  <label>Search</label>
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                  <button type="submit" class="btn btn-info btn-xs" id="dateFilter"> <i class="fas fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <hr>
        <hr>
        <table class="table table-bordered text-center table-responsive" id="orders">
          <thead>
            <tr>
              <th><input type="checkbox" class="sub_chk" id="master"></th>
              <th>SESSION</th>
              <th>ORDER DATE</th>
              <th>ORDER NUMBER</th>
              <th>RECORD / ORDER</th>
              <th>Branch Name</th>
              <th>Branch OD No.</th>

              <th>CUSTOMER NAME</th>
              <th>TYPE</th>
              <th>ORDER CATEGORY</th>

              <th>ACTION</th>
            </tr>
          </thead>

        </table>
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

console.log($('#orders').DataTable().page.info());
    function getlist(filter1){


    var csrf_name = $("#get_csrf_hash").attr('name');
    var csrf_val = $("#get_csrf_hash").val();
    table = $('#orders').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 250,
      "lengthMenu": [[250, 500, 1000, -1], [250, 500, 1000, "All"]],
      select: true,

      dom: 'Bfrtip',
         buttons: [
             'pageLength', {
                 extend: 'excel', footer: true,
                 exportOptions: {
                     columns: ':visible'
                 }
             }, {
                 extend: 'pdf', footer: true,
                 exportOptions: {
                     columns: ':visible'
                 }
             }, {
                 extend: 'print', footer: true,
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
        url: "<?php echo base_url('admin/Orders/get_order_list') ?>",
        type: "post",
        data: {
          filter: filter1,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
         datatype: 'json',
         "dataSrc": function(json) {
           if (json.caption && json.caption == true) {
             // $('#caption').text(json.caption);
             $('#orders').append('<caption style="caption-side: top-right">'+json.caption+'</caption>');
           } else {
             $('#caption').text("FRC Recieve List");
           }
          // if (json.caption && json.caption == true) {

          return json.data;
        },
      },

    });
  }
  $("#searchBranch").click(function(event) {
    event.preventDefault();
    var filter = {
    'branch_name': $('#branch_name').val(),
    'search': 'searchBranch'
    };
    $('#orders').DataTable().destroy();
    getlist(filter);
  });
  $("#dateFilter").click(function(event) {
    event.preventDefault();
    var filter = {
      'from': $('#date_from').val(),
      'to': $('#date_to').val(),
      'search': 'datefilter'
    };
    $('#orders').DataTable().destroy();
    getlist(filter);
  });

  $("#simplefilter").click(function(event) {
    event.preventDefault();
    var filter = {
      'searchByCat': $('#searchByCat').val(),
      'searchValue': $('#searchValue').val(),
      'from': $('#from').val(),
      'to': $('#to').val(),
      'search': 'simple'
    };

    $('#orders').DataTable().destroy();
    getlist(filter);

  });
   $("#clearfilter").click(function(event) {
   $('#orders').DataTable().destroy();
   getlist('');

  });

   $("#advancefilter").click(function(event) {
    event.preventDefault();
    var filter = {
      'from': $('#Afrom').val(),
      'to': $('#Ato').val(),
      'search': 'advance',
      'financial_year': $('#financial_year').val(),
      'order_number': $('#order_number').val(),
      'pcs': $('#pcs').val(),
      'branch_order_number': $('#branch_order_number').val(),
      'name': $('#name').val(),
      'orderType': $('#orderType').val(),
      'dataCategory': $('#dataCategory').val(),


    };
    $('#orders').DataTable().destroy();
     getlist(filter);

  });


});
</script>


<?php include('order_js.php'); ?>
