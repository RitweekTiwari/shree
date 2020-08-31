<script type="text/javascript">
  $(document).ready(function() {
    $('#update').hide();
    $("#submitpercent").on('submit', function() {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        url: "<?php echo base_url('admin/GradePercent/addGradepercent') ?>",
        'type': 'POST',
        'data': form,

        success: function(data) {

          if (data = true) {
            toastr.success('Success!', " add Successfully");
            $('#gradepercent').DataTable().ajax.reload();
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });

    $(document).on('click', '.find_id', function() {
      var id = $(this).prop('id');
      // $('#id').val(id);

      $('#update').show();
      $('#submit').hide();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/GradePercent/get_edit_data",
        cache: false,
        data: {
          'id': id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          data = JSON.parse(data);
          // console.log(data);
          var des = data[0].fabricName;
          //console.log(des);
          $('#fabric').select2().val(des).trigger("change.select2");
          data.forEach(value);

          function value(item, index, arr) {
            //  console.log(arr[index].percent);
            var grade = arr[index].gradeId;
            $('#percent' + grade + '').val(arr[index].percent);
            $('#id' + grade + '').val(arr[index].metaid);
          }
        }
      });
    });

    $("#upbtn").on('click', function() {
      var form = $("#submitpercent").serializeArray();
      console.log(form);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/GradePercent/update_percent') ?>",
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
            location.reload();
            $('clear').val("");
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });
    $('#clear').on('click', function() {
      $('.clear').val("");
      $('#update').hide();
      $('#submit').show();
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
            url: "<?= base_url() ?>admin/GradePercent/delete_order",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {

              //referesh table
              $(".delete_all").click(function() {
                location.reload();
              });


            }
          });
          //for client side

        }
      }
    });
  });
</script>