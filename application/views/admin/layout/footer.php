<!-- All Jquery -->
<!-- ============================================================== -->

<!-- Bootstrap tether Core JavaScript -->
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- Charts js Files -->
<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/libs/flot/excanvas.js"></script>

<script defer="true" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script defer="true" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script defer="true" src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script defer="true" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script defer="true" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script defer="true"  type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-colvis-1.6.3/b-html5-1.6.3/b-print-1.6.3/sc-2.0.2/sl-1.3.1/datatables.min.js"></script>

<?php include('js.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    <?php if ($this->session->flashdata()) : ?>
      <?php if ($this->session->flashdata('error')) : ?>
        toastr.error('Faild!', '<?php echo $this->session->flashdata('msg') ?>');
      <?php else : ?>
        toastr.success('Success!', '<?php echo $this->session->flashdata('msg') ?>');
      <?php endif; ?>
    <?php endif; ?>
  });
</script>

</body>

</html>