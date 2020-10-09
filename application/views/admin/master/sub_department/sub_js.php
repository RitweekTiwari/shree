<script type="text/javascript">
  $(document).ready(function() {

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });

    $(".subDeptName").on('focusout', function() {


      var Name = $(this).val();
      if (/^[a-zA-Z0-9- ,.()/]*$/.test(Name) == false) {
        $(".subDeptName").css("border", "2px solid #F47C72");
        $(".submit").attr("disabled", "TRUE");
        $("#name-error").html('Special Characters allowed(- ,()/)');
      } else {
        $(".subDeptName").css("border", "1px solid #9eea93");
        $(".submit").removeAttr("disabled", "False");
        $("#name-error").html('');

        // alert(fabricName);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/Sub_department/sub_name_exist') ?>",
          data: {
            'name': Name,
            'col': 'subDeptName',
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          success: function(data) {
            if (data == true) {
              $(".subDeptName").css("border", "2px solid #F47C72");
              $(".submit").attr("disabled", "TRUE");
              $("#name-error").html('Sort Name Already Exist.');
            } else {
              $(".subDeptName").css("border", "1px solid #DDDDDD");
              $(".submit").removeAttr("disabled", "False");
              $("#name-error").html('');
            }
          }
        });
      }
    });
    $(".sortname").on('focusout', function() {


      var Name = $(this).val();
      if (/^[a-zA-Z0-9- ,.()/]*$/.test(Name) == false) {
        $(".sortname").css("border", "2px solid #F47C72");
        $(".submit").attr("disabled", "TRUE");
        $("#name-error").html('Special Characters allowed(- ,()/)');
      } else {
        $(".sortname").css("border", "1px solid #9eea93");
        $(".submit").removeAttr("disabled", "TRUE");
        $("#name-error").html('');

        // alert(fabricName);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/Sub_department/sub_name_exist') ?>",
          data: {
            'name': Name,
            'col': 'sortname',
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          success: function(data) {
            if (data == true) {
              $("#sortname").css("border", "2px solid #F47C72");
              $(".submit").attr("disabled", "TRUE");
              $("#name-error").html('Sort Name Already Exist.');
            }
          }
        });
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
            url: "<?= base_url() ?>admin/Sub_department/deletesub_department",
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
  });
</script>