<script type="text/javascript">
  $(document).ready(function() {

    var count = 0;
    var total = 0;

    $('#submit_button').hide();
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });


    $(document).on('blur', '.obc', function(e) {
      var order = $(this).val();
      order = order.toUpperCase();
      var godown = <?php echo $id ?>;

      $(this).val(order);
      console.log(order);
      var button_id = $(this).parent().parent().attr("id");
      console.log(button_id);
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/transaction/getOrderDetails') ?>",
        data: {

          'id': order,
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
            var christmas_day = new Date(data[0]['order_date']);

            // To Calculate the result in milliseconds and then converting into days 
            var Result = Math.round(present_date.getTime() - christmas_day.getTime()) / (one_day);

            // To remove the decimals from the (Result) resulting days value 
            var Final_Result = Result.toFixed(0);
            Final_Result = 30 - Final_Result;
            fabric = data[0]['fabric_name'];

            $('#days' + button_id + '').val(Final_Result);
            $('#pbc' + button_id + '').val(data[0]['pbc']);
            $('#orderNo' + button_id + '').val(data[0]['order_number']);
            $('#design' + button_id + '').val(data[0]['design_name']);
            $('#DesignCode' + button_id + '').val(data[0]['design_code']);
            $('#stitch' + button_id + '').val(data[0]['stitch']);
            $('#dye' + button_id + '').val(data[0]['dye']);
            $('#matching' + button_id + '').val(data[0]['matching']);
            $('#qty' + button_id + '').val(data[0]['quantity']);
            $('#fqty' + button_id + '').val(data[0]['finish_qty']);
            var tc = Number(data[0]['finish_qty'] - data[0]['quantity']).toFixed(2);
            $('#tc' + button_id + '').val(tc);
            $('#fabric' + button_id + '').val(fabric);
            $('#id' + button_id + '').val(data[0]['trans_meta_id']);
            $('#hsn' + button_id + '').val(data[0]['hsn']);
            $('#unit' + button_id + '').val(data[0]['unit']);
            if (fabric != "") {
              $('#submit_button').show();
            } else {
              $('#submit_button').hide();
            }
          } else {
            $(".msg").html("<h6 class='text-danger'><b>Barcode Not Found !!!!</b></h6>");
            $('#days' + button_id + '').val('');
            $('#pbc' + button_id + '').val('');
            $('#orderNo' + button_id + '').val('');
            $('#design' + button_id + '').val('');
            $('#DesignCode' + button_id + '').val('');
            $('#stitch' + button_id + '').val('');
            $('#dye' + button_id + '').val('');
            $('#matching' + button_id + '').val('');
            $('#qty' + button_id + '').val('');
            $('#fqty' + button_id + '').val('');
            $('#fabric' + button_id + '').val('');

            $('#hsn' + button_id + '').val('');
            $('#unit' + button_id + '').val('');
          }

        }
      });
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
    $(document).on('change', '.qty', function() {
      var id = $(this).parent().parent().attr("id");
      var qty = Number($('#qty' + id + '').val());
      var fqty = Number($('#fqty' + id + '').val());
      var tc = Number(fqty - qty).toFixed(2);
      $('#tc' + id + '').val(tc);
    });






    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control pbc"  value="" id=pbc' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control obc" name="obc[]" id=obc' + count + '></td>'

      element += '<td><input type="text" class="form-control " value="" id=orderNo' + count + ' readonly></td>'
      element += '<td><input type="text"  class="form-control " id=fabric' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=hsn' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=design' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=DesignCode' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=dye' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control "  value="" id=matching' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" value="" id=qty' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control qty" name="fquantity[]" value="" id=fqty' + count + ' ></td>'
      element += '<td><input type="text" class="form-control" name="tc[]" value="0" id=tc' + count + ' readonly></td>'
      element += '<td><input type="text"  class="form-control unit " id=unit' + count + ' readonly>'
      element += '<td><input type="text" class="form-control "  value="" id=days' + count + ' readonly> <input type="hidden" name="id[]" id=id' + count + '></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);
      $('#obc' + count + '').focus();
    }
  });
</script>