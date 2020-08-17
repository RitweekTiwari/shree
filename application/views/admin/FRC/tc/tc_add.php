<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->

  <!-- **************** Product List *****************  -->
  <div class="col-md-12 bg-white">
    <div class="card">
      <div class="card-body">
        
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fa fa-plus"></i> Create TC Chalan</h5>
          </div>
          <div class="modal-body">
         <?php  if($frc_data || $tc){ ?>
            <form method="post" action="<?php echo base_url('admin/FRC/add_tc')?>">
              <table class="remove_datatable">
                <thead>
                  <tr class="odd" role="row">
                    <th>Sno.</th>
                    <th>Date</th>
                    <th>PBC</th>
                    <th>Fabric</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Cur qty</th>
                    <th>Unit</th>
                    <th>TC</th>


                  </tr>
                </thead>
                <tbody>
                  <?php 
                                         echo $content;
                                        
                                           ?>
                </tbody>
              </table>
        
              <hr>
              <div class="col-md-3">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                  value="<?=$this->security->get_csrf_hash();?>" />
                <button type="submit" name="submit" class="btn btn-success btn-md">Submit</button>
              </div>
              <hr>
            <?php }
                  else{
                                          echo "<h4 style='color:red '>No data found</h4>";
                                        }                    
                                        
                                           ?>

        </div>

      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

</div>
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      window.location = "<?php echo base_url()?>admin/Orders/deleteOrders/" + id;
    }
  }
</script>
