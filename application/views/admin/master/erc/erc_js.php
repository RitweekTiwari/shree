<script type="text/javascript">
  $(document).ready(function() {
    $('#submit').hide();
    
    $('#descode').on('change', function() {
      var desCode = $('#descode').val();
      var desName = $('#designname').val();
      $.ajax({
        url: "<?php echo base_url('admin/ERC/checkAvailable') ?>",
        type: "POST",
        data: {
          desName: desName,
          desCode: desCode,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(dataResult) {
          if (dataResult == 1) {
            $('#descode').css('border', '1px solid rgb(254, 57, 84)');
            $('#descode').val('');
            $('#descode').focus();
            $('#msg').html('Data already Exists !!');
          } else {
            $('#submit').show();

          }
        }
      });
    });
    $('#descode1').on('change', function() {
      var desCode = $('#descode1').val();
      var desName = $('#designname1').val();
      $.ajax({
        url: "<?php echo base_url('admin/ERC/checkAvailable') ?>",
        type: "POST",
        data: {
          desName: desName,
          desCode: desCode,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(dataResult) {
          if (dataResult == 1) {
            $('#descode1').css('border', '1px solid rgb(254, 57, 84)');
            $('#descode1').val('');
            $('#descode1').focus();
            $('#msg1').html('Data already Exists !!');
          } 
        }
      });
    });



    $(".edit").click(function() {
      var id = $(this).parent().parent().attr("id");
      console.log(id);
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/ERC/getDesign",

        data: {
          id: id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(response) {
          // response = JSON.parse(response);
          $("#erc_id").val(id);
          $("#descode1").val(response['desCode']);
          $("#designname1").val(response['desName']);
          $("#rate1").val(response['rate']);

          $("#edit").modal();
        }
      });
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
            url: "<?= base_url() ?>admin/erc/deleteErc",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {

              //referesh table
              $(".sub_chk:checked").each(function() {
                $(this).parent().parent().remove();
              });


            }
          });
          //for client side

        }
      }
    });

  });
</script>