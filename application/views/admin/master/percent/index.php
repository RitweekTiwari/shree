<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4 text-right">
          <a href="#addnew" class="btn btn-primary addNewbtn" data-toggle="modal">Add New</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form id="PercentFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="fabric.fabricName">fabric</option>
                    <option value="grade.grade">Grade</option>
                    <option value="gpercent.percent">percent</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="searchValue" placeholder="Search" id="searchByValue" class="form-control">
                </div>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                <h5>Grade List</h5>
              </div>
              <hr>
              <div class="row well">
                <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-info " id='printAll'><i class="fa fa-print "></i> Print </button>&nbsp;&nbsp;&nbsp;&nbsp;

                <button id="btn-show-all-children" class="btn btn-success " type="button">Expand/Collapse</button>
              </div>
              <hr>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered " id="gradepercent">
                  <thead>
                    <tr>
                      <th></th>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th> Fabric </th>
                      <th>grade</th>
                      <th>Action</th>
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
</div>

<!-- add modal wind-->
<div id="addnew" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form id="submitpercent">
        <div class="modal-header">
          <h5 class="modal-title">Add Grade Percent</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Fabric Name</label>
              <div class="col-sm-9" id="fabric">
                <select name="fabric" class="form-control select2"  required>
                  <option value="">-- Select Fabric --</option>
                  <?php foreach ($fabric_data as $value) : ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['fabricName'] ?></option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>
            <?php $i = 0;
            foreach ($grade_data as $value) : ?>
              <div class="form-group row">
                <label class="control-label col-sm-3">Grade </label>
                <div class="col-sm-3">
                  <select name="grade[]" class="form-control " id="grade<?php echo $value['id'] ?>" readonly>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['grade'] ?></option>
                  </select>
                </div>

                <label class="control-label col-sm-3">Percent</label>
                <div class="col-sm-3">
                  <input type="number" min="0" <?php if ($i == 0) {
                                                  echo "value=100 readonly";
                                                } ?> id="percent<?php echo $value['id'] ?>" class="form-control" name="percent[]">
                  <input type="hidden" id="id<?php echo $value['id'] ?>" name="id">
                </div>
              </div>
            <?php $i++;
            endforeach; ?>
          </div>
        </div>
        <div class="modal-footer">
          <div class=" float-right" id="submit">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="submit" class="btn btn-primary">
          </div>

          <div class=" float-right" id="update">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="button" class="btn btn-primary" value="Update" id="upbtn">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end add modal wind-->
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

      var divToPrint = document.getElementById("gradepercent");
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
      dt = $('#gradepercent').DataTable({
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


        ],

        "destroy": true,
        // scrollY: 500,
        paging: true,


        "ajax": {
          url: "<?php echo base_url('admin/GradePercent/get_gradeP_list') ?>",
          type: "post",
          data: {
            filter: filter1,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          "dataSrc": function(json) {
            // console.log(json.data);
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
            "data": "fabricName"
          },
          {
            "data": "grade",

          },

          {
            "data": "action",

          }
        ],
        "columnDefs": [{
          "targets": [4],
          "visible": false,
          "searchable": false
        }, ]
      });
    }
    // Handle click on "Expand All" button
    $('#btn-show-all-children').on('click', function() {
      // Expand row details
      dt.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    });

    function format(d) {
      var html = '';
      //sconsole.log(d.worker);

      d.grade.forEach(myFunction);

      function myFunction(item, index, arr) {
        //console.log(arr[index].worker);
        html += '<b> ₹ ' + arr[index].grade + '</b>&nbsp;&nbsp; :&nbsp;&nbsp; ' + arr[index].percent + '&nbsp;&nbsp; ,&nbsp;&nbsp;   ';
      }

      return html;
    }
    // Array to track the ids of the details displayed rows
    var detailRows = [];
    $('#gradepercent tbody').on('click', 'tr td.details-control', function() {
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
        window.location = "<?php echo base_url() ?>admin/GradePercent/delete/" + id;
      }

    }
  }
</script>
<?php include('percent_js.php'); ?>
