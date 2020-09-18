<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var count = 0;
    var total = 0;
    $('#fresh_form').hide();
    $('#submit_button').hide();
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });


    $('#add_more').on('click', function() {

      addmore();
    });


    $(document).on('click', '.remove', function() {
      $(this).parent().parent().remove();
      count = count - 1;
    });





    $(document).on('blur', '.obc', function(e) {
      var order = $(this).val();
      order = order.toUpperCase();
      var godown = <?php echo $id ?>;
      var plain = [];
      <?php foreach ($plain as $row) { ?>
        plain.push(<?php echo $row; ?>);
      <?php } ?>
      //console.log(plain);
      if (plain.includes(godown)) {
        var url = "<?php echo base_url('admin/transaction/get_plain_OrderDetails') ?>";
      } else {
        var url = "<?php echo base_url('admin/transaction/getOrderDetails') ?>";
      }

      $(this).val(order);
      var button_id = $(this).parent().parent().attr("id");
      console.log(button_id);
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
        var category = $('#category').val();
        var rate_from = $('#rate_from').val();
        var worker = $('#FromParty').val();
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: url,
          data: {

            'id': order,
            'category': category,
            'worker': worker,
            'rate_from': rate_from,
            'godown': godown,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success: function(data) {
            data = JSON.parse(data);
            if (data != "") {
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
              image = data['order'][0]['image'];
              $('#days' + button_id + '').val(Final_Result);
              $('#pbc' + button_id + '').val(data['order'][0]['pbc']);
              $('#orderNo' + button_id + '').val(data['order'][0]['order_number']);
              $('#design' + button_id + '').val(data['order'][0]['design_name']);
              $('#DesignCode' + button_id + '').val(data['order'][0]['design_code']);
              $('#stitch' + button_id + '').val(data['order'][0]['stitch']);
              $('#dye' + button_id + '').val(data['order'][0]['dye']);
              $('#matching' + button_id + '').val(data['order'][0]['matching']);

              if (godown == 19) {
                var qty = data['order'][0]['finish_qty'];
                $('#qty' + button_id + '').val(qty);

              } else {
                var qty = data['order'][0]['quantity'];
                $('#qty' + button_id + '').val(qty);

              }
              if (data['order'][0]['trans_meta_id']) {
                $('#trans_id' + button_id + '').val(data['order'][0]['trans_meta_id']);
              } else {
                $('#trans_id' + button_id + '').val("");
              }
              $('#fabric' + button_id + '').val(fabric);
              $('#image' + button_id + '').val(image);
              if (image == "Null" || Image == "") {
                $("#preview").attr('src', '<?php echo base_url('upload/') ?>' + data['order'][0]['image']);
              }

              $('#hsn' + button_id + '').val(data['order'][0]['hsn']);
              $('#unit' + button_id + '').val(data['order'][0]['unit']);
              if (typeof data['rate'] !== 'undefined') {
                var rate = Number(data['rate'][0]['rate']);
                if (rate != 'Null') {
                  $('#rate' + button_id + '').val(rate);
                  $('#value' + button_id + '').val(Math.round((rate * qty + Number.EPSILON) * 100) / 100);
                } else {
                  $('#rate' + button_id + '').val(0.00);
                  $('#value' + button_id + '').val(0.00);
                }
              }


              $('#job' + button_id + '').html($('#jobwork_temp').html());
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

              $('#thtotal').html(current);

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

    $(document).on('change', ".job", function() {
      var rate = Number($(this).val());
      var id = $(this).parent().parent().attr("id");
      var qty = Number($('#qty' + id + '').val());
      $('#rate' + id + '').val(rate);
      $('#value' + id + '').val(rate * qty);
    });

    $(document).on('change', "#toParty", function() {
      var party = $(this).val();


      if (party != "") {
        $('#fresh_form').show();
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

          }

        });
      } else {
        $('#fresh_form').hide();
        $("#ToGodownId").val("");
        $("#ToGodown").val("");

      }
    });

    $("body").keypress(function(e) {
      if (e.which == 13) {
        event.preventDefault();
        addmore();
      }
    });

    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control" readonly value=' + (count + 1) + '></td>'
      element += '<td><input type="text" class="form-control pbc" name="pbc[]" value="" id=pbc' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control obc" name="obc[]" value="" id=obc' + count + '></td>'
      element += '<td><input type="text" class="form-control " name="orderNo[]" value="" id=orderNo' + count + ' readonly></td>'
      element += '<td><input type="text" name="fabric_name[]" class="form-control " id=fabric' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="hsn[]" value="" id=hsn' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="design[]" value="" id=design' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="designCode[]" value="" id=DesignCode' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="dye[]" value="" id=dye' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="matching[]" value="" id=matching' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="quantity[]" value="" id=qty' + count + ' readonly></td>'
      element += '<td><input type="text" name="unit[]" class="form-control unit " id=unit' + count + ' readonly>'
      element += '<td><select type="text" class="form-control job" name="job[]" value="" id=job' + count + ' ></select></td>'
      element += '<td><input type="text" class="form-control " name="rate[]" value="" id=rate' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="value[]" value="" id=value' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="image[]" value="" id=image' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control " name="days[]" value="" id=days' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="remark[]" value="" id=remark' + count + ' readonly><input type="hidden" name="trans_id[]" id=trans_id' + count + ' ></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);
      $('#obc' + count + '').focus();
    }
  });
</script>