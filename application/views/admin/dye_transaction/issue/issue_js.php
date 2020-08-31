<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var count = 0;
    var total = 0;

    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
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
            url: "<?= base_url() ?>admin/orders/deleteorder",
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

    $(document).on('change', '.pbc', function(e) {
      var pbc = $(this).val();
      pbc = pbc.toUpperCase();
      $(this).val(pbc);
      var godown = <?php echo $id ?>;
      var id = $(this).parent().parent().attr("id");
      console.log("id=" + id);
      var count1 = 0;
      $("input[name='pbc[]']").each(function(index, element) {
        current = $(this).val();
        if (current == pbc) {
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
          url: "<?php echo base_url('admin/Dye_transaction/getPBC') ?>",
          data: {

            'id': pbc,
            'godown': godown,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success: function(data) {
            data = JSON.parse(data);
            if (data != 0) {

              var date = data[0]['created_date'];
              var d = date.split(" ", 1);
              $("#msg").html("");
              $('#hsn' + id + '').val(data[0]['hsn']);
              $('#fabric' + id + '').val(data[0]['fabricName']);
              $('#qty' + id + '').val(data[0]['current_stock']);
              $('#days' + id + '').val(d);

              $('#unit' + id + '').val(data[0]['stock_unit']);
              $('#remark' + id + '').val(data[0]['remark']);
              var current = 0;
              $(".qty").each(function() {
                current += Number($(this).val());
                console.log("Current=" + current);
              });


              $('#thtotal').html(current)
              console.log("quantity=" + current);
            } else {
              toastr.error('Failed!', "PBC Not Found");

              $('#fabric').val("");
              $('#quantity').val("");
              $('#date').val("");
              $('#challan_no').val("");
              $('#ad_no').val("");
              $('#Cur_quantity').val("");
            }

          }
        });
      }
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

    jQuery('.print_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
      });
      //alert(allVals.length); return false;
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        //$("#loading").show();
        WRN_PROFILE_DELETE = "Are you sure you want to Print this rows?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          //for server side
          var join_selected_values = allVals.join(",");
          // alert (join_selected_values);exit;
          var ids = join_selected_values.split(",");
          var data = [];
          $.each(ids, function(index, value) {
            if (value != "") {
              data[index] = value;
            }
          });
          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/PrintThis/Recieve_Challan_multiprint",
            cache: false,
            data: {
              'ids': data,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
              $("body").html(response);
            }
          });
          //for client side

        }
      }
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
        $("#ToGodownId").val("");
        $("#ToGodown").val("");
        $("#workType").val("");
      }
    });

    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control" readonly value=' + (count + 1) + '></td>'
      element += '<td><input type="text" class="form-control pbc" name="pbc[]" value="" id=pbc' + count + '></td>'
      element += '<td> <input type="text"  class="form-control " id=fabric' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control"  value="" id=hsn' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control qty"  value="" id=qty' + count + '  readonly></td>'
      element += '<td><input type="text" class="form-control" name="color[]" value=""></td>'
      element += '<td><input type="text"  class="form-control unit " readonly id=unit' + count + ' ></td>'
      element += '<td><input type="text" class="form-control "  value="" id=days' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="remark[]" value="" id=remark' + count + ' ></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);
      $('#pbc' + count + '').focus();
    }
  });
</script>