<script type="text/javascript">
  $(document).ready(function() {

    $(window).on("load", function() {
      get_list();
      getlist2("Null", "Null");

    });

    function get_list() {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/FDA/get_fda_group_list') ?>",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
      
        success: function(data) {
          $("#asign_result").html(data);
        }
      });
    }

    $('#asign').on('click', function(event) {
      event.preventDefault();
      var selected = [];
      var fabric_type = $('input[name="fabric_type"]').val();
      var fabric_name = $('input[name="fabric_name"]').val();
      $("#table tr.selected").each(function() {
        selected.push($('td:first', this).html());
      });

      if (selected == "") {
        alert("Nothing to Assign");
      } else {
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/FDA/submit_value') ?>",
          data: {
            'selected': selected,
            'fabric_type': fabric_type,
            'fabric_name': fabric_name,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
         
          success: function(data) {
            if (data.error) {
              toastr.error('Failed!', data.msg);
              
            } else {
              toastr.success('Success!', data.msg);
              get_list();
             


            }
          }
        });
      }
    });

    // $("#button").click(function() {
    //   // location.reload(true);
    //   window.location.reload();
    // });

    $("#table tr").on('click', function() {
      event.preventDefault();
      // $("#table tr").removeClass("selected");
      $(this).toggleClass('selected');
      // $(event).addClass("selected");

    });

    // });
    $("#fabric").on('change', function() {
      var fabricType = $(this).val();
      var fabricName = $(this).children("option:selected").html();
      $("#fabric_type").val(fabricType);
      $("#fabric_name").val(fabricName);
      window.value = $(this).val();
      if (fabricType != "") {

        getlist2(fabricName, fabricType)


      }
    });

    function getlist2(fabric, type) {
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
          type: "POST",
          url: "<?php echo base_url('admin/FDA/get_fabric_name_value') ?>",
          data: {
            'fabricType': type,
            'fabricName': fabric,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
        },

        select: true,
        scrollY: 500,
        paging: false,
        "destroy": true,
      });

    }
    $("#fda_value span").click(function(event) {
      // alert('ok');
      var fabric_id = $(this).attr('id');
      console.log(fabric_id);
      //alert(fabric_id);
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/FDA/get_fda_details') ?>",
        data: {
          'fabric_id': fabric_id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          $(".content_body").html(data);
        }

      });

    });

  });
</script>