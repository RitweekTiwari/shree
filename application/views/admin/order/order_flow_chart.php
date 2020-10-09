<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div>
            <h4 class="card-title"> All ORDERS List</h4>
            <h5 class="card-subtitle">Overview of all order details information</h5>
          </div>
        </div>
        <div>
          <hr>
          <table class="table-bordered text-center table-responsive " id="orders">
            <thead>
              <th class="">
                OD DATE
              </th>
              <th class="">
                ORDER NO
              </th>
              <th class="">
                BRANCH
              </th>
              <th class="">
                BRANCH OD No.
              </th>
              <th class="">
                CUSTOMER
              </th>
              <th>
                TOTAL
              </th>
              <th>
                BALANCE
              </th>
              <th>
                PENDING
              </th>
              <th>
                CANCEL
              </th>
              <th>
                PG LIST
              </th>
              <?php foreach ($godownlist as  $row) { ?>
                <th>
                  <?php echo $row  ?>
                </th>
              <?php } ?>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var fil ="";
    var table;

    getlist(fil);

    console.log($('#orders').DataTable().page.info());

    function getlist(filter1) {


      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      table = $('#orders').DataTable({
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
          url: "<?php echo base_url('admin/Orders/get_order_chart') ?>",
          type: "post",
          data: {
            filter: filter1,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          "dataSrc": function(json) {
            if (json.caption && json.caption == true) {
              // $('#caption').text(json.caption);
              $('#orders').append('<caption style="caption-side: top-right">' + json.caption + '</caption>');
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