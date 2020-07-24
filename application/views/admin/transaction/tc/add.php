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
         <?php  if($data){ ?>
            <form method="post" action="<?php echo base_url('admin/transaction/add_tc_challan/').$id?>">
              <table class="remove_datatable">
                <thead>
                  <tr class="odd" role="row">
                  <th>Sno</th>
                    <th>PBC</th>
                  <th>OBC</th>
                  <th>Order No.</th>
                 
                  <th>Fabric</th>
                  <th>Hsn</th>
                  <th>Design Name </th>
                  <th>Design Code</th>
                  <th>Dye </th>
                  <th>Matching</th>
                  <th>Current Qty</th>
                   
                 
                  <th>Unit</th>
                 


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



