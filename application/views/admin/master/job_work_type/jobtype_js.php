<script type="text/javascript">
  $(document).ready(function() {
    $("#update").hide();
    $("#cancle").hide();
    var fil = '';
    var table;
    var dt = '';
    getlist(fil);

    $("#printAll").on("click", function() {

      //Open all of the child rows
      $("td.details-control").click();

      //Wait for all the ajax requests to finish, then launch the print window

      var divToPrint = document.getElementById("jobWorklist");
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
      dt = $('#jobWorklist').DataTable({
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
          url: "<?php echo base_url('admin/Job_work_type/get_jobworklist') ?>",
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
            "data": "type",

          },
          {
            "data": "jobconstant",

          },
          {
            "data": "action",

          }
        ],
        "columnDefs": [{
          "targets": [3],
          "visible": false,
          "searchable": false
        }]
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
      d.jobconstant.forEach(myFunction);

      function myFunction(item, index, arr) {
        //console.log(arr[index].worker);
        html += '<b> Unit </b> :&nbsp;&nbsp;' + arr[index].unit + '&nbsp;&nbsp; ,  <b>Job</b> :&nbsp;&nbsp; ' + arr[index].job + '&nbsp;&nbsp; , <b>Rate</b>: &nbsp;&nbsp;' + arr[index].rate + '&nbsp;&nbsp; <br><br>   ';
      }
      return html;
    }

    // Array to track the ids of the details displayed rows
    var detailRows = [];
    $('#jobWorklist tbody').on('click', 'tr td.details-control', function() {
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
    $("#clearfilter").click(function(event) {
      $('#jobWorklist').DataTable().destroy();
      getlist('');
    });

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });

    jQuery('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
      });
      //alert(allVals.length); return false;
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        //$("#loading").show();
        WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          //for server side
          var join_selected_values = allVals.join(",");
          // alert (join_selected_values);exit;

          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/Job_work_type/deletejob",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
              //referesh table
              $(".sub_chk:checked").each(function() {
                var id = $(this).attr('data-id');
                $('#tr_' + id).remove();
              });


            }
          });
          //for client side

        }
      }
    });

    $("#submitjob").on('submit', function() {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        url: "<?php echo base_url('admin/Job_work_type/addType') ?>",
        'type': 'POST',
        'data': form,

        success: function(data) {
          console.log(data);
          if (data = true) {
            toastr.success('Success!', " add Successfully");
            $('#details').html('');
            $('#fresh_field').html('');
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });


    $(document).on('click', '.find_id', function() {
      var id = $(this).prop('id');
      var html = '';
      $('#details').show();
      $('#update').show();
      $('#cancle').show();

      $('#submit').hide();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Job_work_type/get_edit_data",
        cache: false,
        data: {
          'id': id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          data = JSON.parse(data);
          //  console.log(json.data1);
          data.forEach(value);

          function value(item, index, arr) {
            var id = arr[index].id;

            //console.log(arr[index].fabricId);
            $('#type').val(data[0].type);

            $('#jobworkId').val(arr[0].id);

            (arr[0].bojconstant).forEach(value1);

            function value1(item, index, arr) {
              if (arr[index].jobId != '') {

                html += '<div class="col-md-3"><label>Job</label>';
                html += '<input type="text" class="form-control" name="job[]" id="rem' + arr[index].jcid + '" value=' + arr[index].job + '>';

                html += '<input type="hidden" class="form-control" name="jcid[]"   value=' + arr[index].jcid + ' ></div>';
                html += '<div class="col-sm-3"><label> Rate </label> ';
                html += ' <input type="text" class="form-control" name="rate[]" value=' + arr[index].rate + '>  </div>';
                html += '<div class="col-sm-4"><label> Choose Unit </label>';
                html += '<select name="unit[]" class="form-control">';
                html += '<option value=' + arr[index].unit + '>' + arr[index].unitSymbol + '</option>';
                html += '</select></div>';
                html += '<div class="col-sm-2">';
                html += '<label>Action</label><br>';
                html += '<button type="button" name="add" value=' + arr[index].jcid + ' class="btn btn-danger removedata">-</button></div>';

                $('#extra-details').html(html);

              } else {
                $('#extra-details').html("<div class='text-center text-info'>NO Previous Data found !!</div>");
              }
            }
          }
        }
      });
    });
    $("#update_btn").on('click', function() {
      event.preventDefault();
      var form = $("form").serializeArray();

      //console.log(form);
      $.ajax({
        url: "<?php echo base_url('admin/Job_work_type/edit') ?>",
        type: "POST",
        'data': form,

        success: function(data) {
          if (data = 1) {
            toastr.success('Success!', " Update Successfully");
            $('#jobWorklist').DataTable().ajax.reload();
            $('.clear').val("");
            $('#extra-details').html('');
            
            $('#fresh_field').html('');
            $("#update").hide();
            $('#cancle').hide();
            $('#submit').show();

          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });
    $("#cancle").on('click', function() {
      $('.clear').val("");
      $('#extra-details').html('');
     
      $("#update").hide();

      $('#submit').show();
      $('#cancle').hide();
    });

    $(document).on('click', '.removedata', function() {
      var id = $(this).val();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Job_work_type/getfdid",

        data: {
          id: id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(response) {
          if (response) {
            toastr.success('Success!', " deleted Successfully");
            $('#rem' + id + '').html('');
          }
        }
      });
    });

    $('#add_fresh').click(function() {
      var rowobj = $("#addNewRow").html();
      $('#fresh_field').append(rowobj);
    });
    $(document).on('click', '.btn_remove', function() {
      $(this).parent().parent().remove();
    });



  });
</script>