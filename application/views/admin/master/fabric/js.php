<script type="text/javascript">
  $(document).ready(function() {
    $("#update").hide();
    $("#cancle").hide();
    $("#details").hide();
    $("#addbtn").hide();
    count = 0;
    var fil = '';
    var table;
    var dt = '';
    getlist(fil);
    $("#printAll").on("click", function() {

      //Open all of the child rows
      $("td.details-control").click();

      //Wait for all the ajax requests to finish, then launch the print window

      var divToPrint = document.getElementById("fabric");
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
      dt = $('#fabric').DataTable({
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
        scrollY: 500,
        paging: true,


        "ajax": {
          url: "<?php echo base_url('admin/Fabric/get_fabric_list') ?>",
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
            "data": "fabricName"
          },

          {
            "data": "fabHsnCode"
          },
          {
            "data": "fabricType",

          },
          {
            "data": "fabricCode",

          },
          {
            "data": "fabricUnit",

          },
          {
            "data": "purchase",

          },
          {
            "data": "fabricId",

          },

          {
            "data": "action",

          }
        ],
        "columnDefs": [{
          "targets": [8],
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
      d.fabricId.forEach(myFunction);

      function myFunction(item, index, arr) {
        //console.log(arr[index].worker);
        html += '<b> Fabric Name</b> :&nbsp;&nbsp;' + arr[index].fabricId + '&nbsp;&nbsp; ,  <b>Segment Name</b> :&nbsp;&nbsp; ' + arr[index].segmentName + '&nbsp;&nbsp; , <b>Length</b>: &nbsp;&nbsp;' + arr[index].length + '&nbsp;&nbsp; , <b>Width</b> : &nbsp;&nbsp; ' + arr[index].width + '&nbsp;&nbsp;, <b>max</b>: &nbsp;&nbsp;' + arr[index].max + '&nbsp;&nbsp; , <b>min</b> : &nbsp;&nbsp; ' + arr[index].min + '  &nbsp;&nbsp;<br><br>   ';
      }

      return html;
    }
    // Array to track the ids of the details displayed rows
    var detailRows = [];
    $('#fabric tbody').on('click', 'tr td.details-control', function() {
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

    $("#searchBranch").click(function(event) {
      event.preventDefault();
      var filter = {
        'branch_name': $('#branch_name').val(),
        'search': 'searchBranch'
      };
      $('#fabric').DataTable().destroy();
      getlist(filter);
    });

    $("#clearfilter").click(function(event) {
      $('#fabric').DataTable().destroy();
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
            url: "<?= base_url() ?>admin/Fabric/deletefabric",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
              if (response == 1)
                $('#fabric').DataTable().ajax.reload();
              else
                toastr.error('Error!', "Fabric is used in Stock. Cannot Delete");

            }
          });
          //for client side
        }
      }
    });
    $('#addbtn').click(function() {
      var fabcount = 0;
      var rowobj = '<div class="row">'
      rowobj += '<div class="col-sm-1">'

      rowobj += '<input type="text" class="form-control" name="segmentName[]" value=""> </div > '
      rowobj += '<div class="col-sm-5"> <select name = "fabricId[]" class = "form-control clear fabric" multiple >'
      rowobj += '<option> --Select -- </option> <option value = "0" > Self </option>'
      rowobj += '<?php foreach ($fabric_data as $value) : ?> <option value = "<?php echo $value->id ?>" > <?php echo $value->fabricName ?> </option><?php endforeach; ?>'
      rowobj += '<input type = "hidden" id = "id<?php echo $value->id ?>"name = "id" ></select>'

      rowobj += '</div>'

      rowobj += '<div class="col-sm-1"> <input type = "number" class = "form-control" name = "length[]" value = "-1" step = "0.01" ></div>'

      rowobj += '<div class = "col-sm-1" > <input type = "number" class = "form-control" name = "width[]" value = "-1" step = "0.01" > </div>'
      rowobj += '<div class = "col-sm-1" > <input type = "number" class = "form-control" name = "max[]"  value = "-1" step = "0.01" ></div>'

      rowobj += '<div class = "col-sm-1" >'
      rowobj += '<input type = "number" class = "form-control" name = "min[]" value = "-1" step = "0.01" > </div>'
      rowobj += '<div class = "col-sm-1" > <button type = "button" name = "remove" class = "btn btn-danger btn-sm btn_remove" > X </button> </div >'

      rowobj += '</div> <br> '
      $('#fresh_field').append(rowobj);
      count = count + 1;
      $(".fabric").select2();
    });
    $(document).on('click', '.btn_remove', function() {
      $(this).parent().parent().remove();
    });


    $("#fabric_name").on('focusout', function() {


      var fabricName = $(this).val();
      if (/^[a-zA-Z0-9- ,()/]*$/.test(fabricName) == false) {
        $("#fabric_name").css("border", "2px solid #F47C72");
        $("#fabric_btn").attr("disabled", "TRUE");
        $("#fabric-error").html('Special Characters allowed(- ,()/)');
      } else {
        $("#fabric_name").css("border", "1px solid #DDDDDD");
        $("#fabric_btn").removeAttr("disabled", "TRUE");
        $("#fabric-error").html('');

        // alert(fabricName);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/Fabric/fabricExist') ?>",
          data: {
            'fabricName': fabricName,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          success: function(data) {
            if (data == true) {
              $("#fabric_name").css("border", "2px solid #F47C72");
              $("#fabric_btn").attr("disabled", "TRUE");
              $("#fabric-error").html('Fabric Name Already Exist.');
            }
          }
        });
      }
    });

    $(document).on('click', '.find_id', function() {
      var id = $(this).prop('id');
      var html = '';

      $("#addbtn").show();
      $('#update').show();
      $('#cancle').show();
      $('.edit_details').hide();
      $('#submit').hide();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Fabric/get_edit_data",
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
            $('#fabric_name').val(data[0].fabricName);
            $('#fabHsnCode').val(arr[0].fabHsnCode);
            $('#fabricType').val(arr[0].fabricType);
            $('#fabricCode').val(arr[0].fabricCode);
            $('#fabricUnit').val(arr[0].fabricUnit);
            $('#fabricid').val(arr[0].id);
            var counter = 0;
            (arr[0].fabricdetails).forEach(value1);

            function value1(item, index, arr) {
              if (arr[index].fdid != '') {

                html += ' <div class="row"> <div class="col-sm-2"> <label>SEGMENT </label>';
                html += '<input type="text" class="form-control seg" name="segmentName1[]" id="rem' + arr[index].fdid + '" value=' + arr[index].segmentName + ' ></div>';
                html += '<input type="hidden" class="form-control" name="fdid1[]"   value=' + arr[index].fdid + ' >';
                html += '<div class="col-sm-2"><label> FABRIC </label> ';
                html += ' <select name="fabricId1[]" class="form-control select2" id="fabricId' + index + '">';

                html += '<option value=' + arr[index].fabricId + ' >' + arr[index].fName + '</option>';

                html += '</select></div><div class="col-sm-1"><label> LENGTH </label>';
                html += '  <input type="number" class="form-control" name="length1[]" value=' + arr[index].length + ' > </div>';
                html += '<div class="col-sm-1"><label> WIDTH </label>';
                html += '<input type="number" class="form-control" name="width1[]" value=' + arr[index].width + ' ></div>';
                html += '<div class="col-sm-1"><label> Max </label>';
                html += '<input type="number" class="form-control" name="max1[]" value=' + arr[index].width + ' ></div>';
                html += '<div class="col-sm-1"><label> Min </label>';
                html += '<input type="number" class="form-control" name="min1[]" value=' + arr[index].width + ' ></div>';
                html += '<div class="col-sm-1">';
                html += '<label>Action</label>';
                html += '<button type="button" name="add" value=' + arr[index].fdid + ' class="btn btn-danger btn_remove removedata">X</button></div>  </div> ';
                counter = counter + 1;
                $('#extra-details').html(html);
                // $('.read').attr('readonly', true);
                // $('#find_id').prop("id","newId");
                // $("#fabric_name").removeAttr("id");
                // $("#fabric-error").removeAttr("id");
                //  $('#find_id').prev("fabric_name").attr("id","newId");
              } else {
                $('#extra-details').html("<div class='text-center text-info'>NO Previous Data found !!</div>");
              }
            }
            count = counter;
          }
        }
      });
    });

    $("#update_btn").on('click', function() {
      event.preventDefault();
      var form = $("form").serializeArray();

      //console.log(form);
      $.ajax({
        url: "<?php echo base_url('admin/Fabric/edit') ?>",
        type: "POST",
        'data': form,

        success: function(data) {
          if (data = 1) {
            toastr.success('Success!', " Update Successfully");
            $('#fabric').DataTable().ajax.reload();
            $('.clear').val("");
            $('#extra-details').html('');
            $('#fresh_field').html('');
            $("#update").hide();
            $("#addbtn").hide();
            $('.edit_details').show();
            $('#cancle').hide();
            $('#submit').show();

            // $('.read').attr('readonly', false);
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });
    $("#cancle").on('click', function() {
      $('.clear').val("");
      $('#extra-details').html('');
      $('#details').hide();
      $("#update").hide();
      $('.edit_details').show();
      $('#submit').show();
      $('#cancle').hide();
      $("#addbtn").hide();
      // $('.read').attr('readonly', false);
    });

    $("#radio1").click(function() {
      var radio1 = $('#radio1').val();
      var fabric_name = $('#fabric_name').val();
      var fabHsnCode = $('#fabHsnCode').val();
      var fabricType = $('#fabricType').val();
      var fabricCode = $('#fabricCode').val();
      var fabricUnit = $('#fabricUnit').val();
      if (radio1 == 'Yes' && fabric_name != '' && fabHsnCode != '' && fabricType != '' && fabricCode != '' && fabricUnit != '') {
        $("#details").show();
        $("#addbtn").show();
      } else {
        toastr.error('Error!', " fill all Element");
      }
    });

    $("#radio2").click(function() {
      var radio2 = $('#radio2').val();
      // alert(radio2);
      if (radio2 == 'No') {
        $("#details").hide();
        $("#addbtn").hide();
      }
    });
    $(document).on('click', '.removedata', function() {
      var id = $(this).val();
      var row = $(this).parent();
      console.log(row);
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Fabric/getfdid",

        data: {
          id: id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(response) {
          if (response) {
            $('#fabric').DataTable().ajax.reload();
            row.remove();
            toastr.success('Success!', " deleted Successfully");

          }
        }
      });
    });



  });
</script>