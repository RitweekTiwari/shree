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

    $("#printAll").on("click", function() {

      //Wait for all the ajax requests to finish, then launch the print window

      var divToPrint = document.getElementById("show");
      newWin = window.open("");
      newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/dist/css/style.min.css\" type=\"text/css\" media=\"print\"/>");
      newWin.document.write("<link rel=\"stylesheet\" href=\"<?php echo base_url('optimum/admin') ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css\" type=\"text/css\" media=\"print\"/>");

      newWin.document.write(divToPrint.outerHTML);
      newWin.document.close();
      newWin.print();
    });

  });
</script>