<script type="text/javascript">
  $(document).ready(function() {
    var count = 100;
    $('#submit').hide();

    $(".fabric_name").change(function() {
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

          },
        });
      }
    });
    $(document).on('change', '.pbc', function(e) {

      var pbc = $(this).val();
      var button = $(this).parent().parent().attr("row-id");
      console.log(button);
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
          data = JSON.parse(data);
          // console.log(data);
          $('#pbc2-' + button + '').val(pbc);
          $('#qty' + button + '').val(data[0]['stock_quantity']);
          $('#item' + button + '').val(data[0]['fabricName']);
          $('#cqty' + button + '').val(data[0]['current_stock']);
          $('#rate2-' + button + '').val(data[0]['purchase_rate']);



        },
      });

    });

    $(document).on('click', '#add_more', function(e) {
      console.log("Hello");
      var body = $(this).parent().parent().parent();
      var row = $(this).parent().parent().attr('row-id');
      var fab = $(this).parent().parent().find('.fabric').val();
      var len = $(this).parent().parent().find('.length').val();
      count = count + 1;
      var element = ' <tr id=' + count + ' row-id=' + row + '>'
      element += '<td><input type="text" class="form-control pbc" name="pbc" id="pbc1-' + count + '"></td>'
      element += '<td><input type="text" class="form-control fabric" name="fabric" id="fabric' + count + '" value="' +
        fab + '" readonly></td>'
      element += '<td><input type="text" class="form-control length" name="length" id="length' + count + '"  value="' +
        len + '" readonly></td>'
      element += '<td><input type="number" class="form-control pcs" name="pcs" id="pcs' + count + '" value=""></td>'
      element += '<td><input type="text" class="form-control" name="tc" id="tc1-' + count + '" value=""></td>'
      element += '<td><input type="number" class="form-control" name="rate" id="rate1-' + count + '" value="" readonly></td>'
      element += '<td><input type="number" class="form-control" name="value" id="value' + count + '" value="" readonly></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>'

      $(body).append(element);
      element = "";
    });
    $(document).on('click', '.remove', function() {
      $(this).parent().parent().remove();
    });
    $(document).on('change', '.pcs', function(e) {
      var pcs = $(this).val();
      var len = $(this).parent().parent().find('.length').val();

      var button = $(this).parent().parent().attr("row-id");
      var cqty = $('#cqty' + button + '').val();
      var total = cqty - (len * pcs);
      $('#tc1-' + button + '').val(total);
      $('#tc' + button + '').val(total);
      var Tqty = $('#pcs0').val() * len;
      var remain = Tqty - (len * pcs);
      $('#counter').html('<div class="text-danger"><b>Total Qty : </b>' + Tqty + ' &nbsp;<b>Remaining Qty : </b>' + remain + '</div>');
    });


  });
</script>