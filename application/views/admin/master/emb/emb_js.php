<script type="text/javascript">
  $(document).ready(function() {
    $('#update').hide();
    $('#desname').on('change', function() {
      var desName = $(this).find(":selected").text();
      // alert(desName);
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/EMB/EmbRate",
        cache: false,
        data: {
          'desName': desName,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success: function(response) {
          $('#rate').val(response);
        }
      });
    });


    $("#upbtn").on('click', function() {
      var form = $("form").serializeArray();
      console.log(form);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/EMB/update_embmeta') ?>",
        data: {
          'form': form,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          if (data = 1) {
            toastr.success('Success!', " Update Successfully");
            $('#update').hide();
            $('#submit').show();
            $('clear').val("");
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });
    $('#clear').on('click', function() {
      $('.clear').val("");
    });

    $('.find_id').on('click', function() {

      var id = $(this).prop('id');
      $('#embid').val(id);
      // console.log(id);
      // alert(id);
      $('#update').show();
      $('#submit').hide();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/EMB/edit_part",
        cache: false,
        data: {
          'id': id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          data = JSON.parse(data);
          // console.log(data);
          var des = data[0].designName;
          console.log(des);
          $('#desname').select2().val(des).trigger("change.select2");



          data.forEach(value);

          function value(item, index, arr) {

            var worker_value = arr[index].workerName;
            $('#rate' + worker_value + '').val(arr[index].rate);
            $('#embid' + worker_value + '').val(arr[index].metaid);
          }
        }
      });
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
            url: "<?= base_url() ?>admin/EMB/deletejob",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function() {

            }
          });
          //for client side

        }
      }
    });



  });
</script>