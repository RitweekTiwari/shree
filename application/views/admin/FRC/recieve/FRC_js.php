<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var count = 0;
    var total = 0;
    var tqty = 0;
    var stotal = 0;
    var Tpcs = 0;
    var summary = [];
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });

    $(document).on('change', '.fabric_name', function(e) {
      var from = $('#fromGodown option:selected').val();
      var to = $('#toGodown option:selected').val();
      var doc = $('#Doc_challan ').val();
      if (from == '' || to == '') {
        alert('Please select a Godown');
        $('#fromGodown ').focus();
      } else if (doc == "") {
        alert('Please enter a DOC Challan');
        $('#Doc_challan ').focus();
      } else {
        var pbc = $(this).val();
        var button_id = $(this).parent().parent().attr("id");
        console.log("id=" + button_id);
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/FRC/getfabric') ?>",
          data: {

            'id': pbc,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success: function(data) {
            data = JSON.parse(data);
            if (data != "") {

              var unit;
              if (data[0]['unit'] == null) {
                unit = 'Null';
              } else {
                unit = data[0]['unit'];
              }

              $("#msg").html("");
              $('#hsn' + button_id + '').val(data[0]['fabHsnCode']);
              $('#fabType' + button_id + '').val(data[0]['fabricType']);

              $('#unit' + button_id + '').val(unit);
            } else {
              $("#msg").html("<h6 class='text-danger'><b>PBC Not Found </b></h6>");
              $('#hsn' + button_id + '').val();
              $('#fabType' + button_id + '').val();

              $('#unit' + button_id + '').val();

            }

          }

        });
      }
    });

    $('#add_more1').on('click', function() {

      addmore();
    });


    $(document).on('click', '.remove', function() {
      var id = $(this).parent().parent().attr("id");
      summary.forEach(myFunction);

      function myFunction(value, index, array) {
        var fabric = $('#fabric' + id + '').val();
        //  console.log('#fabric='+fabric);console.log('#value='+value); 
        if (fabric == array[index][0]) {
          found = 1;
          array[index][1] -= 1;
          array[index][2] -= Number($('#qty' + id + '').val());

          //  console.log('#fabric found'+summary);
        }

      }
      $(this).parent().parent().remove();

    });

    $('.delete_all').on('click', function(e) {
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
            url: "<?= base_url() ?>admin/FRC/delete",
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
        }
      }
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });
    $(document).on('keypress', function(e) {
      if (e.which == 13) {
        event.preventDefault();

        addmore();
        var html =
          '<table class=" table-bordered text-center " style="width:50%"><caption>Summary</caption><thead class="bg-secondary text-white">';
        html += '<tr><th style="width:15%">Fabric</th>';
        html += '<th style="width:10%">PCS</th>';
        html += '<th style="width:10%">Quantity</th>';
        html += '<th style="width:15%">Total</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        if (summary) {


          summary.forEach(myFunction);

          function myFunction(value, index, array) {
            stotal += array[index][3];
            tqty += array[index][2];
            Tpcs += array[index][1];
            html += ' <tr><td>' + array[index][0] + '</td>';
            html += '<td>' + array[index][1] + '</td>';
            html += '<td>' + array[index][2] + '</td>';
            html += '<td>' + array[index][3] + '</td></tr></tbody>';
          }
          html += '<tr class="bg-secondary text-white"><th>Total</th><th>' + Tpcs + '</th><th>' + tqty +
            '</th><th>' + stotal + '</th></tr>';
          html += '</table>';

          $('#summary').html(html);
        }
      }
    });
    $(document).on('change', "input[name='prate[]']", function() {
      var id = $(this).parent().parent().attr("id");

      var q = Number($('#qty' + id + '').val());
      var p = Number($('#pcs' + id + '').val());
      var rate = Number($(this).val());
      var val = rate * q*p;
      $('#value' + id + '').val(val);
      qty = get_total_value()
      $('#th_total').html(qty)
      console.log("th_total=" + qty);
      //  console.log("id="+id);
      tqty = 0;
      stotal = 0;
      Tpcs = 0;
      if (summary == "") {

        var fabric = $('#fabric' + id + ' option:selected').attr("data_name");
        var pcs = 1;
        var qty = Number($('#qty' + id + '').val());
        var amount = Number($('#value' + id + '').val());
        var arr = [fabric, pcs, qty, amount];
        summary.push(arr);
        console.log('fabric=' + fabric);
        console.log('summary=' + summary);
      } else {
        var found = 0;
        summary.forEach(myFunction);

        function myFunction(value, index, array) {
          var fabric = $('#fabric' + id + ' option:selected').attr("data_name");
          //  console.log('#fabric='+fabric);console.log('#value='+value); 
          if (fabric == array[index][0]) {
            found = 1;
            array[index][1] += 1;
            array[index][2] += Number($('#qty' + id + '').val());
            array[index][3] += Number($('#value' + id + '').val());
            //  console.log('#fabric found'+summary);
          }

        }
        if (found == 0) {
          fabric = $('#fabric' + id + ' option:selected').attr("data_name");
          pcs = 1;
          qty = Number($('#qty' + id + '').val());
          amount = Number($('#value' + id + '').val());
          arr = [fabric, pcs, qty, amount];
          summary.push(arr);
          // console.log(summary);
        }

      }



    });



    $(document).on('change', "input[name='pcs[]']", function() {
      var id = $(this).parent().parent().attr("id");

      var rate = Number($('#prate' + id + '').val());

      var q = Number($('#qty' + id + '').val());
      var p = Number($(this).val());
      var val = rate * q * p;
      console.log("value=" + val);
      $('#value' + id + '').val(val);

      var qty = get_total_quntity()
      $('#th_qty').html(qty)
      console.log("quantity=" + qty);

    });

    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control"  value=' + (count + 1) + '  readonly></td>'
      element += '<td> <select name="fabric_name[]" class="form-control fabric_name " id=fabric' + count +
        ' required>'
      element += '<option>Fabric</option>'
      element += '<?php foreach ($febName as $value) : ?>'
      element +=
        '<option value="<?php echo $value->id; ?>" data_name="<?php echo $value->fabricName; ?>"> <?php echo $value->fabricName; ?></option>'
      element += '<?php endforeach; ?>'
      element += '</select></td>'
      element += '<td><input type="text" class="form-control" name="hsn[]" value="" id=hsn' + count +
        ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="fabType[]" value="" readonly id=fabType' +
        count + '></td>'
      element += '<td><input type="text" class="form-control" name="qty[]" value="" id="qty' + count + '"></td>'
      element += '<td><input type="number" class="form-control" name="pcs[]" value="1" id="pcs' + count + '"></td>'
      element += '<td><input type="text" class="form-control" name="unit[]" value="" readonly id=unit' + count +
        '></td>'
      element += '<td> <input type="text" class="form-control" name="color[]" value="" required></td>'
      element += '<td> <input type="text" class="form-control" name="ADNo[]" value="" required></td>'
      element += '<td><input type="text" class="form-control" name="pcode[]" value="" required></td>'
      element += '<td><input type="text" class="form-control" name="prate[]" value="" id="prate' + count + '" required></td>'
      element += '<td><input type="text" class="form-control" name="total[]" readonly value="" id="value' + count +
        '"></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);

    }

    function get_total_quntity() {
      var current = 0;
      $("input[name='pcs[]']").each(function() {
        current += Number($(this).val());
        console.log("Current=" + current);
      });
      return Number(current);
    }

    function get_total_value() {
      var current = 0;
      $("input[name='total[]']").each(function() {
        current += Number($(this).val());
        console.log("Current=" + current);
      });
      return Number(current);
    }

  });
  <?php if ($this->session->flashdata('success')) { ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php } else if ($this->session->flashdata('error')) {  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php } else if ($this->session->flashdata('warning')) {  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php } else if ($this->session->flashdata('info')) {  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php } ?>
</script>