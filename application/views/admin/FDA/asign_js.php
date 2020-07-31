<script type="text/javascript">
  $(document).ready(function() {
    $('#table ').DataTable({

      destroy: true,
      "pageLength": 250,
      "lengthMenu": [
        [250, 500, 1000, -1],
        [250, 500, 1000, "All"]
      ],

      select: true,
      dom: 'Bfrtip',
      buttons: [
        'pageLength', 'excel', 'pdf', {
          extend: 'print',
          exportOptions: {
            columns: ':visible'
          }
        },

      ],
      scrollY: 500,
      scrollX: false,
      scrollCollapse: false,
      paging: true,
      fixedColumns: false,
      fixedheader: true

    });
    $(window).on("load", function() {
      get_list();
    });

    function get_list() {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/FDA/get_fda_group_list') ?>",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        beforeSend: function() {
          isProcessing = true;
          $("#asign_result").html('<img src="<?php echo base_url('optimum/preloader.gif ') ?>">');
        },
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
          beforeSend: function() {
            isProcessing = true;
            $("#show").html('<img src="<?php echo base_url('optimum/preloader.gif') ?>">');
          },
          success: function(data) {
            if (data.error) {
              toastr.error('Failed!', data.msg);
              $("#show").html('');
            } else {
              toastr.success('Success!', data.msg);
              $("#show").html('');
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
      window.value = $(this).val();
      if (fabricType != "") {
        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('admin/FDA/get_fabric_name_value') ?>",
          data: {
            'fabricType': fabricType,
            'fabricName': fabricName,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: 'json',
          beforeSend: function() {
            isProcessing = true;
            $("#show").html('<img src="<?php echo base_url('optimum/preloader.gif ') ?>">');
          },
          success: function(data) {
            $("#show").html(data);
          }

        });
      } else {
        $("#show").html('');
      }
    });

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