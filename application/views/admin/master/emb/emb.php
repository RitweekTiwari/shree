<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
        <!-- add modal wind-->

        <div class="card container">
          <div class="card-body" id="result">
            <form class="form-horizontal" method="post" action="<?php echo base_url('admin/EMB/add_emb') ?>" name="basic_validate" novalidate="novalidate">
              <div class="card-header">
                <h5 class="card-title">Add Detail</h5>
              </div>

              <div class="form-group row">
                <label class="control-label col-sm-6">Design</label>
                <label class="control-label col-sm-6">EMB Rate</label>
                <div class="col-sm-6">

                  <select name="design" class="form-control select2 clear" id="desname">
                    <option value="">Select Design</option>
                    <?php foreach ($erc as $value) : ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['designName'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-sm-6">
                  <input type="text" name="embrate" class="form-control clear" value="" id="rate" readonly>
                </div>
              </div>

              <hr>
              <div class="row">
                <label class="col-md-4">Job Worker</label><label class="col-md-2">Rate</label> <label class="col-md-4">Job Worker</label><label class="col-md-2">Rate</label>
                <?php foreach ($worker as $value) : ?>
                  <div class="col-md-4">
                    <select name="job[]" class="form-control" readonly>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <input type="hidden" id="embid<?php echo $value['id'] ?>" name="embid">
                    <input type="number" class="form-control clear" name="rate[]" min="0" value="0" step="0.01" id="rate<?php echo $value['id'] ?>">
                  </div>

                <?php endforeach; ?>
              </div>
              <hr>
              <input type="button" class="btn btn-primary" value="Clear" id="clear">
              <div class=" float-right" id="submit">

                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="submit" class="btn btn-primary">

              </div>
              <div class=" float-right" id="update">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="button" class="btn btn-primary" value="Update" id="upbtn">
              </div>

            </form>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-12">
          <div class="card">

          </div>
          <div class="row">
            <div class="col-8">
              <div class="card">
                <div class="card-body">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                      <h5>Emb List</h5>
                    </div>
                    <hr>
                    <div class="row well">
                      <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <button class="btn btn-info " id='printAll'><i class="fa fa-print "></i> Print </button>
                    </div>
                    <hr>
                    <div class="widget-content nopadding">
                      <table class="table table-striped table-bordered " id="example">
                        <thead>
                          <tr>
                            <th></th>
                            <th><input type="checkbox" class="sub_chk" id="master"></th>

                            <th>Sno</th>
                            <th>Emb rate</th>
                            <th>Design</th>
                            <th>worker</th>
                            <th>action</th>

                          </tr>
                        </thead>

                      </table>


                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-4">

              <div class="card">
                <div class="card-body">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                      <h5>Emb Design List</h5>
                    </div>

                    <div class="widget-content nopadding">
                      <table class="table table-striped table-bordered data-table" id="">
                        <thead>
                          <tr>
                            <th>S/No</th>
                            <th>Design</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($erc > 0) {
                            $id = 1;
                            foreach ($erc as $value) { ?>
                              <tr>
                                <td><?php echo $id ?></td>
                                <td> <?php echo $value['designName'] ?></td>

                              </tr>
                          <?php $id = $id + 1;
                            }
                          } ?>
                    </div>
                  </div>
                  <!-- End Edit modal wind-->

                  </tbody>
                  </table>


                </div>
              </div>
            </div>
          </div>
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
    var dt = '';
    getlist(fil);

    $("#printAll").on("click", function() {

      //Open all of the child rows
      $("td.details-control").click();

      //Wait for all the ajax requests to finish, then launch the print window

      var divToPrint = document.getElementById("example");
      newWin = window.open("");
      newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/dist/css/style.min.css\" type=\"text/css\" media=\"print\"/>");
      newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css\" type=\"text/css\" media=\"print\"/>");

      newWin.document.write(divToPrint.outerHTML);
      newWin.document.close();
      newWin.print();
    });

    function getlist(filter1) {


      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      dt = $('#example').DataTable({
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
          
        ],

        "destroy": true,
        scrollY: 500,
        paging: true,


        "ajax": {
          url: "<?php echo base_url('admin/Emb/get_emb_list') ?>",
          type: "post",
          data: {
            filter: filter1,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          "dataSrc": function(json) {
            if (json.caption && json.caption == true) {
              // $('#caption').text(json.caption);
              $('#example').append('<caption style="caption-side: top-right">' + json.caption + '</caption>');
            } else {
              $('#caption').text("Emb List");
            }
            // if (json.caption && json.caption == true) {

            return json.data;
          },

        },
        "columns": [{
            "class": "details-control",
            "orderable": false,
            "data": null,
            "defaultContent": ""
          },
          {
            "data": "id"
          },
          {
            "data": "sno"
          },
          {
            "data": "emb_rate"
          },

          {
            "data": "design"
          },
          {
            "data": "worker",

          },
          {
            "data": "action",

          }
        ],
        "columnDefs": [{
            "targets": [5],
            "visible": false,
            "searchable": false
          },

        ]
      });
    }

    function format(d) {
      var html = '';
      //sconsole.log(d.worker);
      d.worker.forEach(myFunction);

      function myFunction(item, index, arr) {
        //console.log(arr[index].worker);
        html += arr[index].worker + ' : ' + arr[index].rate + '<br>   ';
      }

      return html;
    }
    // Array to track the ids of the details displayed rows
    var detailRows = [];
    $('#example tbody').on('click', 'tr td.details-control', function() {
      var tr = $(this).closest('tr');
      var row = dt.row(tr);
      var idx = $.inArray(tr.attr('id'), detailRows);

      if (row.child.isShown()) {
        tr.removeClass('details');
        row.child.hide();

        // Remove from the 'open' array
        detailRows.splice(idx, 1);
      } else {
        tr.addClass('details');
        row.child(format(row.data())).show();

        // Add to the 'open' array
        if (idx === -1) {
          detailRows.push(tr.attr('id'));
        }
      }
    });

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on('draw', function() {
      $.each(detailRows, function(i, id) {
        $('#' + id + ' td.details-control').trigger('click');
      });
    });
  });

  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/EMB/delete/" + id;
      }

    }
  }
</script>

<style>
  #DataTables_Table_0_previous {
    display: none;
  }

  #DataTables_Table_0_paginate {
    display: none;
  }

  select {
    width: 120px;
    height: 35px;
    box-sizing: border-box;
    border-color: #e9ecef;
  }
</style>

<?php include('emb_js.php'); ?>