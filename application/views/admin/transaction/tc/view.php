<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
 
        <!-- **************** Product List *****************  -->
        <div class="col-md-12 bg-white">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TC Challan Receive Detail</h4>
                    <hr>

                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <div class="row well" >
                             <div class="col-6"> <a type="button" class="btn btn-info pull-left print_all btn-success" style="color:#fff;"><i class="fa fa-print"></i></a>
                             </div>
                            </div><hr>
                            <table class=" table-bordered data-table text-center " id="frc">
                                <thead class="bg-dark text-white">
                                    <tr class="odd" role="row">
                                        <th><input type="checkbox" class="sub_chk" id="master"></th>
                                         <th>Sno</th>
                    <th>PBC</th>
                  <th>OBC</th>
                  <th>Order No.</th>
                   <th>Current Qty</th>
                  <th>Finish Qty</th> 
                 <th>TC</th>
                  <th>Fabric Code</th>
                  <th>Fabric</th>
                  <th>Hsn</th>
                  <th>Design Name </th>
                  <th>Design Code</th>
                  <th>Dye </th>
                  <th>Matching</th>
                 
                  <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                        $c=1;$qty=0.00;$fqty=0.00;$tc=0.00;
                                        
                                        foreach ($data as $value) { 
                                          $qty+=$value['quantity'];
                                       $fqty+=$value['quantity'];
                                       ?>
                                        <tr class="gradeU" id="tr_<?php echo $value['trans_meta_id']?>">

                                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['trans_meta_id'] ?>"></td>
                                         <td><?php echo $c?> </td>
                                          <td><?php echo $value['pbc']?></td>
                    <td><?php echo $value['order_barcode']?></td>
                    <td><?php echo $value['order_number']?></td>
                    <td><?php echo $value['quantity']?></td>
                    <td><?php echo $value['finish_qty']?></td>
                    <td><?php $cd=$value['finish_qty']-$value['quantity'];$tc=$tc+$cd;  echo $cd?></td>
                     <td><?php echo $value['fabricCode']?></td>
                    <td><?php echo $value['fabric_name']?></td>
                    <td><?php echo $value['hsn']?></td>
                    <td><?php echo $value['design_name']?></td>
                    <td><?php echo $value['design_code']?></td>
                    <td><?php echo $value['dye']?></td>
                    <td><?php echo $value['matching']?></td>
                    
                    <td><?php echo $value['unit']?></td>
                                         
                                        </tr>

                                <?php $c=$c+1; } ?>
                                </tbody class="bg-dark text-white"><tfoot>
                                    
                                <tr > <<th>Total</th>
                                         <th></th>
                    <th></th>
                  <th></th>
                  <th> </th>
                   <th><?php echo $qty ?></th>
                  <th><?php echo $fqty ?></th> 
                 <th><?php echo $tc ?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>  </th>
                  <th> </th>
                  <th> </th>
                  <th></th>
                 
                  <th></th>
                    
                  </tr></tfoot>
                            </table>
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
   
   jQuery('.print_all').on('click', function(e) {
  var allVals = [];
   $(".sub_chk:checked").each(function() {
     allVals.push($(this).attr('data-id'));
   });
   //alert(allVals.length); return false;
   if(allVals.length <=0)
   {
     alert("Please select row.");
   }
   else {
     //$("#loading").show();
     WRN_PROFILE_DELETE = "Are you sure you want to Print this rows?";
     var check = confirm(WRN_PROFILE_DELETE);
     if(check == true){
       //for server side
     var join_selected_values = allVals.join(",");
     // alert (join_selected_values);exit;
     var ids = join_selected_values.split(",");
     var data = [];
     $.each(ids, function(index, value){
       if (value != "") {
         data[index] = value;
       }
     });
       $.ajax({
         type: "POST",
         url: "<?= base_url()?>admin/FRC/return_print_multiple",
         cache:false,
         data: {'ids' : data,'title':'TC List Details','type':'tc', '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'},
         success: function(response)
         {
           $("body").html(response);
         }
       });
              //for client side

     }
   }
 });  
</script>


