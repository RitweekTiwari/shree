<script type="text/javascript">
  $(document).ready(function() {
    var html = '';
    $('#get_btn').on('click', function() {
      var value = $('#searchByValue').val();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/Status/get_dbc",
        cache: false,
        data: {
          'value': value,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {

          $('#show').html(data);
        }
      });
    });

    $('#get_obc').on('click', function() {
      var value = $('#obc').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/Status/get_obc_list') ?>",
        data: {
          'value': value,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {

          $("#show").html(data);
        }
      });
    });

    $('#get_pbc').on('click', function() {
      var value = $('#pbc').val();

      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/Status/get_pbc_list') ?>",
        data: {
          'value': value,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {

          $("#show").html(data);
        }
      });
    });

   

  });
</script>