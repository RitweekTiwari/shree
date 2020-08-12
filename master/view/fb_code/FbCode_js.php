<script type="text/javascript">
  $(document).ready(function() {

jQuery('#master').on('click', function(e){
 if($(this).is(':checked',true))
 {
   $(".sub_chk").prop('checked', true);
 }
 else
 {
   $(".sub_chk").prop('checked',false);
 }
});


jQuery('.delete_all').on('click', function(e){
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
     WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
     var check = confirm(WRN_PROFILE_DELETE);
     if(check == true){
       //for server side
     var join_selected_values = allVals.join(",");
     // alert (join_selected_values);exit;

       $.ajax({
         type: "POST",
         url: "<?= base_url()?>admin/Order_type/delete_order",
         cache:false,
         data: {'ids' : join_selected_values, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'},
         success: function(response)
         {

           //referesh table
           $(".sub_chk:checked").each(function() {
              var id = $(this).attr('data-id');
              $('#tr_'+id).remove();
           });


         }
       });
              //for client side

     }
   }
 });
   });

   </script>
