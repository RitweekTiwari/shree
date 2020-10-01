<script type="text/javascript">
  $(document).ready(function() {
    var count = 100;
    var Tcqty = 0;
    var Ttc = 0;
    var Tpcs = 0;
    var Ttotal = 0;
    var Tval = 0;
    var is_new = 0;
    $('#submit').hide();

    $(".fabric_name").change(function() {
      var from = $('#fromGodown option:selected').val();
      var to = $('#toGodown option:selected').val();
      var doc = $('#Doc_challan ').val();
      Tcqty = 0;
      Ttc = 0;
      Tval = 0;
      Tpcs = 0;
      Ttotal = 0;
      if (from == '' || to == '') {
        alert('Please select a Godown');
        $('#fromGodown ').focus();
      } else if (doc == "") {
        alert('Please enter a DOC Challan');
        $('#Doc_challan ').focus();
      } else {
        var id = $(this).val();

        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>admin/Segment/get_segment",
          cache: false,
          data: {
            'id': id,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          success: function(data) {
            $("#list").html(data);
            $('#submit').show();
          },
        });
      }
    });
    $(document).on('change', '.pbc', function(e) {

      var pbc = $(this).val();
      var button = $(this).parent().parent().attr("row-id");
      var body_id = $(this).parent().parent().parent().attr("row-id");

      if (is_new != body_id) {
        Ttotal = 0;
        is_new = body_id;
      }
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Segment/get_pbc",
        cache: false,
        data: {
          'id': pbc,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          if (data != 0) {


            data = JSON.parse(data);
            // console.log(data);
            fabric = $('#fabric' + button + '').val();
            if (fabric == data[0]['fabricName']) {

              $('#pbc2-' + button + '').val(pbc);
              $('#qty' + button + '').val(data[0]['stock_quantity']);
              $('#item' + button + '').val(data[0]['fabricName']);

              $('#rate2-' + button + '').val(data[0]['purchase_rate']);
              $('#rate1-' + button + '').val(data[0]['purchase_rate']);
              var length = Number($('#length' + button + '').val());
              console.log("length= " + length);
              if (length != 0) {
                var net_pcs = Math.floor(data[0]['current_stock'] / length);
              }

              console.log("net_pcs= " + net_pcs);
              $('#pcs' + button + '').val(Number(net_pcs));
              var cqty = $('#qty' + button + '').val();
              var total = cqty - (length * net_pcs);
              var value = (total + (length * net_pcs)) * data[0]['purchase_rate'];
              $('#cqty' + button + '').val(Math.round((total + Number.EPSILON) * 100) / 100);
              $('#value' + button + '').val(value);
              $('#tc1-' + button + '').val(0);
              $('#tc' + button + '').val(Math.round((total + Number.EPSILON) * 100) / 100);

              $('#seg2-th_qty' + body_id + '').text(Math.round((get_total_qty(body_id) + Number.EPSILON) * 100) / 100);

              $('#seg1-th_tc' + body_id + '').text(Math.round((get_total_tc(body_id) + Number.EPSILON) * 100) / 100);

              $('#seg1-th_pcs' + body_id + '').text(Math.round((get_total_pcs(body_id) + Number.EPSILON) * 100) / 100);
              $('#seg1-th_val' + body_id + '').text(Math.round((get_total_val(body_id) + Number.EPSILON) * 100) / 100);

              value = get_main_val();
              $('#total_main').val(Math.round((value + Number.EPSILON) * 100) / 100);
              var pcs = $('#pcs_main').val();

              $('#rate_main').val(Math.round((value / pcs + Number.EPSILON) * 100) / 100);

              $('#seg1-th_qty' + body_id + '').text(Math.round((get_total(body_id) + Number.EPSILON) * 100) / 100);
            } else {
              toastr.error("Error", "Fabric did not match");
            }
          } else {
            toastr.error("Error", "PBC Not found");
          }
        },
      });

    });

    $(document).on('click', '#add_more', function(e) {
      console.log("Hello");
      var body = $(this).parent().parent().parent();
      var body_id = $(this).parent().parent().parent().attr("row-id");
      var row = $(this).parent().parent().attr('row-id');
      var fab = $('#segment1-' + row + '').find('.fabric' + row + '').val();
      var len = $('#segment1-' + row + '').find('.length' + row + '').val();
      count = count + 1;
      var element = ' <tr id=segment1-tr-' + count + ' class="segment1-tr-' + body_id + '" row-id=' + count + '>'
      element += '<td><input type="text" class="form-control pbc " name="pbc[]" id="pbc1-' + count + '"></td>'
      element += '<td><input type="text" class="form-control " name="fabric[]" id="fabric' + count + '" value="' +
        fab + '" readonly></td>'
      element += '<td><input type="text" class="form-control length' + body_id + '" name="length[]" id="length' + count + '"  value="' +
        len + '" readonly></td>'
      element += '<td><input type="text" class="form-control pcs pcs' + body_id + '" name="pcs[]" id="pcs' + count + '" ></td>'
      element += '<td><input type="text" class="form-control tc tc1-' + body_id + '" name="tc[]" id="tc1-' + count + '" ></td>'
      element += '<td><input type="text" class="form-control rate1-' + body_id + '" name="rate[]" id="rate1-' + count + '"  readonly></td>'
      element += '<td><input type="text" class="form-control value value' + body_id + '" name="value[]" id="value' + count + '"  readonly></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>'

      $(body).append(element);
      element = "";
      var element = ' <tr id=segment2-tr-' + count + ' row-id=' + count + ' >'
      element += '<td><input type="text" class="form-control pbc' + count + '" name="pbc1[]" id="pbc2-' + count + '" readonly></td>'
      element += '<td><input type="text" class="form-control "  id="item' + count + '" readonly></td>'
      element += '<td><input type="text" class="form-control qty' + body_id + '"  id="qty' + count + '" readonly></td>'
      element += '<td><input type="number" class="form-control cqty' + body_id + '" name="cqty1[]" id="cqty' + count + '" readonly></td>'
      element += '<td><input type="text" class="form-control "  id="tc' + count + '" readonly></td>'
      element += '<td><input type="number" class="form-control"  id="rate2-' + count + '"  readonly></td>'
      element += '</tr>'

      $('#segment2-' + row + '').append(element);

    });

    $(document).on('click', '.remove', function() {
      var row = $(this).parent().parent().attr('row-id');
      var body_id = $(this).parent().parent().parent().attr("row-id");

      $('#seg2-th_qty' + body_id + '').text(Math.round((get_total_qty(body_id) + Number.EPSILON) * 100) / 100);





      $('#seg1-th_qty' + body_id + '').text(Math.round((get_total(body_id) + Number.EPSILON) * 100) / 100);


      $(this).parent().parent().remove();
      $('#segment2-tr-' + row + '').remove();
      $('#seg1-th_tc' + body_id + '').text(Math.round((get_total_tc(body_id) + Number.EPSILON) * 100) / 100);

      $('#seg1-th_pcs' + body_id + '').text(Math.round((get_total_pcs(body_id) + Number.EPSILON) * 100) / 100);
      $('#seg1-th_val' + body_id + '').text(Math.round((get_total_val(body_id) + Number.EPSILON) * 100) / 100);
      var value = get_main_val();
      $('#total_main').val(Math.round((value + Number.EPSILON) * 100) / 100);
      var pcs = $('#pcs_main').val();

      $('#rate_main').val(Math.round((value / pcs + Number.EPSILON) * 100) / 100);
    });

    $(document).on('change', '.tc , .pcs', function() {
      var row = $(this).parent().parent().attr('row-id');
      var body_id = $(this).parent().parent().parent().attr("row-id");
      var length = Number($('#length' + row + '').val());
      console.log("length = " + length);
      var net_pcs = Number($('#pcs' + row + '').val());
      console.log("net_pcs = " + net_pcs);
      var tc = Number($('#tc1-' + row + '').val());
      console.log("tc = " + tc);
      var rate = Number($('#rate1-' + row + '').val());
      console.log("rate = " + rate);
      var value = (tc + (length * net_pcs)) * rate;
      $('#value' + row + '').val(value);
      var tc2 = Number($('#tc' + row + '').val());
      var net = tc2 - tc;
      if (net >= 0) {
        $('#cqty' + row + '').val(net);
        $('#tc' + row + '').val(net);
      } else {
        toastr.error("Error", "Invalid Quantity");
        $(this).val(0);
        $(this).focus();
      }
      $("body").keypress(function(e) {
        if (e.which == 13) {
          event.preventDefault();


        }
      });
      value = get_main_val();
      $('#total_main').val(Math.round((value + Number.EPSILON) * 100) / 100);
      var pcs = $('#pcs_main').val();

      $('#rate_main').val(Math.round((value / pcs + Number.EPSILON) * 100) / 100);
      $('#seg2-th_qty' + body_id + '').text(Math.round((get_total_qty(body_id) + Number.EPSILON) * 100) / 100);

      $('#seg1-th_tc' + body_id + '').text(Math.round((get_total_tc(body_id) + Number.EPSILON) * 100) / 100);

      $('#seg1-th_pcs' + body_id + '').text(Math.round((get_total_pcs(body_id) + Number.EPSILON) * 100) / 100);
      $('#seg1-th_val' + body_id + '').text(Math.round((get_total_val(body_id) + Number.EPSILON) * 100) / 100);


      $('#seg1-th_qty' + body_id + '').text(Math.round((get_total(body_id) + Number.EPSILON) * 100) / 100);



    });

    function get_total_qty(button) {
      var Tcqty = 0;
      $('.qty' + button + '').each(function() {
        Tcqty += Number($(this).val());

      });
      return Tcqty;
    }

    function get_total_pcs(button) {
      var Tpcs = 0;
      $('.pcs' + button + '').each(function() {
        Tpcs += Number($(this).val());

      });
      return Tpcs;
    }

    function get_total_val(button) {
      var Tval = 0;
      $('.value' + button + '').each(function() {
        Tval += Number($(this).val());

      });
      return Tval;
    }

    function get_total(button) {
      var Total = 0;
      $('.segment1-tr-' + button + '').each(function() {
        pcs = Number($(this).find('.pcs' + button + '').val());
        length = Number($(this).find('.length' + button + '').val());
        Total += pcs * length;
      });
      return Total;
    }

    function get_main_val() {
      var Total = 0;
      $('.value').each(function() {

        Total += Number($(this).val());
      });
      return Total;
    }

    function get_total_tc(button) {
      var Ttc = 0;
      $('.tc1-' + button + '').each(function() {
        Ttc += Number($(this).val());

      });
      return Ttc;
    }
  });
</script>