<script type="text/javascript">
  $(document).ready(function() {
    $("#FormGrade").hide();
    $(document).ready(function() {
      $("select").select2();
      $('.select2-container').css("width", "100%");

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
      if (allVals.length >= 0) {
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
            url: "<?= base_url() ?>admin/Fabric/deletefabric",
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
    $("#code1").on('change', function() {

      $(".code").val($("#code1 :selected").text());
    });
    $("#next").on('click', function() {
      var fabric = $("#fabricName").val();
      var code = $("#code1").val();
      if (fabric != "" && code != "") {


        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>admin/SRC/get_src",
          cache: false,
          data: {
            'fabric': fabric,
            'code': code,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(response) {

            response = JSON.parse(response);
            console.log(response.percent);
            if (response.src != 0) {

              response.src.forEach(myFunction);

              function myFunction(item, index) {
                // console.log(item.grade);
                $('#tr' + item.grade + '').find('.rate').val(item.rate);
              }
            } else {
              $('.rate').val(0);
            }
            if (response.percent != 0) {

              response.percent.forEach(myFunction);

              function myFunction(item, index) {
                // console.log(item.grade);
                $('#tr' + item.grade + '').find('.percent').val(item.percent);
              }
            } else {
              $('.percent').val(0);
            }
            $("#FormGrade").show();

          }
        });
      } else {
        toastr.info('Info!', "Please select fabric and code");
      }
    });
    $("#rate0").on('change', function() {
      var count = <?php echo $count ?>;
      var rate = $(this).val();
      for (var i = 1; i < count; i++) {
        $('#rate' + i + '').val((rate * Number($('#percent' + i + '').val())) / 100);
      }



    });
    $(".fabricName").on('change', function() {


      var fabricName = $(this).val();
      // alert(fabricName);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/SRC/getfabricRate') ?>",
        data: {
          'id': fabricName,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          if (data != '') {
            $('#lastRate').val(data[0].purchase_rate);
            $('#oldRate').val(data[1].purchase_rate);
          } else {
            $('#lastRate').val("0");
            $('#oldRate').val("0");
          }

        }
      });
    });
    $("#add_src").on('click', function() {
      var form = $("form").serializeArray();
      // console.log(form);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/SRC/add_src') ?>",
        data: {
          'form': form,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          if (data = 1) {
            toastr.success('Success!', "Added Successfully");
          } else {
            toastr.error('Error!', "Something went wrong");
          }
        }
      });
    });
    $("#update").on('click', function() {
      var fab = $("#fabricName").val();
      var op = $("#operation").val();
      var rate = $("#new_rate").val();
      if (fab != "" && rate != "") {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/SRC/change_src') ?>",
          data: {
            'fab': fab,
            'op': op,
            'rate': rate,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          success: function(data) {
            if (data = 1) {
              toastr.success('Success!', "Updated Successfully");
            } else {
              toastr.error('Error!', "Something went wrong");
            }
          }
        });
      } else {
        toastr.info('Info!', "Please select and enter something");
      }
    });

  });
</script>