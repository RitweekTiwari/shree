<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var count = 0;
    var total = 0;
    var add = 0;
    $('#fresh_form').hide();
    $('#submit_button').hide();
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    $(document).on('change', '#toParty', function(e) {
      var cust = $(this).val();
      if (cust != "") {
        $('#fresh_form').show();
      } else {
        $('#fresh_form').hide();
      }
    });
    $(document).on('change', '#obc0', function(e) {
      var cust = $(this).val();
      if (cust != "") {
        $('#submit_button').show();
      } else {
        $('#submit_button').hide();
      }
    });

    $(document).on('blur', '.obc', function(e) {
      var order = $(this).val();
      order = order.toUpperCase();
      $(this).val(order);
      console.log(order);
      var button_id = $(this).parent().parent().attr("id");
      var count1 = 0;
      $("input[name='obc[]']").each(function(index, element) {
        current = $(this).val();
        if (current == order) {
          count1 += 1;

        }
      });
      if (count1 > 1) {
        $(this).val("");
        $(this).focus();
        $(this).css("border-color", "red");
        toastr.error('Failed!', "Already Entered");

      } else {
        $(this).css("border-color", "");

        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/transaction/getOrderDetails') ?>",
          data: {

            'id': order,
            'godown': <?php echo $id ?>,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success: function(data) {
            data = JSON.parse(data);
            if (data != 0) {
              // One day Time in ms (milliseconds) 
              var one_day = 1000 * 60 * 60 * 24
              var present_date = new Date();

              // 0-11 is Month in JavaScript 
              var christmas_day = new Date(data['order'][0]['order_date']);

              // To Calculate the result in milliseconds and then converting into days 
              var Result = Math.round(present_date.getTime() - christmas_day.getTime()) / (one_day);

              // To remove the decimals from the (Result) resulting days value 
              var Final_Result = Result.toFixed(0);
              Final_Result = 30 - Final_Result;
              fabric = data['order'][0]['fabric_name'];
              $(".msg").html("");
              $('#days' + button_id + '').val(Final_Result);
              $('#pbc' + button_id + '').val(data['order'][0]['pbc']);
              $('#orderNo' + button_id + '').val(data['order'][0]['order_number']);
              $('#design' + button_id + '').val(data['order'][0]['design_name']);
              $('#DesignCode' + button_id + '').val(data['order'][0]['design_code']);
              $('#stitch' + button_id + '').val(data['order'][0]['stitch']);
              $('#dye' + button_id + '').val(data['order'][0]['dye']);
              $('#matching' + button_id + '').val(data['order'][0]['matching']);
              $('#qty' + button_id + '').val(data['order'][0]['finish_qty']);
              $('#fabric' + button_id + '').val(fabric);
              $('#image' + button_id + '').val(data['order'][0]['image']);
              $("#preview").attr('src', '<?php echo base_url('upload/') ?>' + data['order'][0]['image']);
              $('#hsn' + button_id + '').val(data['order'][0]['hsn']);
              $('#unit' + button_id + '').val(data['order'][0]['unit']);

              if (data['order'][0]['trans_meta_id']) {
                $('#trans_id' + button_id + '').val(data['order'][0]['trans_meta_id']);
              } else {
                $('#trans_id' + button_id + '').val("");
              }
              if (fabric != "") {
                $('#submit_button').show();
              } else {
                $('#submit_button').hide();
              }
              var current = 0;
              $("input[name='quantity[]']").each(function() {
                current += Number($(this).val());
                console.log("Current=" + current);
              });


              $('#thtotal').html(current)
              console.log("quantity=" + current);
            } else {
              toastr.error('Failed!', "OBC Not Found");

              $('#designName' + button_id + '').val("");
              $('#designCode' + button_id + '').val('');
              $('#stitch' + button_id + '').val('');
              $('#dye' + button_id + '').val('');
              $('#matching' + button_id + '').val('');
              $('#image' + button_id + '').val('');
            }

          }
        });
      }
    });


    $("body").keypress(function(e) {
      if (e.which == 13) {
        event.preventDefault();

        addmore();


      }
    });
    $('#add_more').on('click', function() {

      addmore();


    });


    $(document).on('click', '.remove', function() {
      $(this).parent().parent().remove();
      count = count - 1;
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
            url: "<?= base_url() ?>admin/Transaction/delete",
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


    $(document).on('change', "#FromParty", function() {
      var party = $(this).val();


      if (party != "") {
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/transaction/get_godown') ?>",
          data: {
            'party': party,

            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',

          success: function(data) {
            data = JSON.parse(data);

            $("#FromGodownId").val(data[0]['id']);
            $("#FromGodown").val(data[0]['godown']);
          }

        });
      } else {
        $("#FromGodown").val('');
        $("#FromGodownId").val('');
      }
    });
    $(document).on('change', "#toParty", function() {
      var party = $(this).val();


      if (party != "") {
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/transaction/get_godown') ?>",
          data: {
            'party': party,

            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',

          success: function(data) {
            data = JSON.parse(data);
            $("#ToGodownId").val(data[0]['id']);
            $("#ToGodown").val(data[0]['godown']);
            $("#workType").val(data[0]['job']);
          }

        });
      } else {
        $("#ToGodown").val('');
        $("#workType").val('');
        $("#ToGodownId").val('');
      }
    });

    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control" readonly value=' + (count + 1) + '></td>'
      element += '<td><input type="text" class="form-control pbc"  value="" id=pbc' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control obc" name="obc[]" id=obc' + count + '></td>'
      element += '<td><input type="text" class="form-control "   value="" id=orderNo' + count + ' readonly></td>'
      element += '<td><input type="text" name="fabric_name[]" class="form-control " id=fabric' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=hsn' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="design[]" value="" id=design' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=DesignCode' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " value="" id=dye' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=matching' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control"  value="" name="quantity[]" id=qty' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control unit " id=unit' + count + ' readonly>'
      element += '<td><input type="text" class="form-control" value="" id=image' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=days' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control"  value="" id=remark' + count + ' readonly><input type="hidden" name="trans_id[]" id=trans_id' + count + ' ></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);
      $('#obc' + count + '').focus();
    }
  });
</script>