

<script type="text/javascript">
$(document).ready(function() {

  $('#desname').on('change', function() {
    var desName = $(this).find(":selected").text();
    //alert(desName);
    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>admin/EMB/EmbRate",
      cache: false,
      data: {
        'desName': desName,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
      },
      success: function(response) {
        $('#rate').val(response);
      }
    });
  });

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
             url: "<?= base_url()?>admin/Job_work_type/deletejob",
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

 // $(".order_row").click(function(){
 //            // alert ('ok');
 //            var oreder_id =  $(this).attr('id');
 //             ///alert(oreder_id);
 //
 //                  var csrf_name = $("#get_csrf_hash").attr('name');
 //                  var csrf_val = $("#get_csrf_hash").val();
 //                  $.ajax({
 //                    type: "POST",
 //                    url: "<?php echo base_url('admin/Orders/get_order_details') ?>",
 //                    data: {'oreder_id' : 	oreder_id, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'},
 //                    datatype: 'json',
 //                    success: function(data){
 //
 //                       $("#content_body").html(data);
 //                    }
 //                  });
 //                });

 var i=1;
 // $('#add_fresh').click(function(){
 //
 //      i++;
 //
 //      $('#fresh_field').append('<row id="row'+i+'" class="row"><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'">   <div class="col-md-3"> <label>Job</label>  <input type="text" class="form-control" name="job[]" value=""></div> <div class="col-md-4"> <label>Rate</label>  <input type="text" class="form-control" name="rate[]" value=""></div><div class="col-md-3"><label>Choose Unit</label><select Name="unit[]"><option value="pcs">pcs</option><option value="mtrs">mtrs</option></select></div>  <div class="col-md-2"><br>&nbsp;&nbsp;<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div><div class="row"><div class="col-md-12"> <label></label><div></div><br><br><br>');
 //
 // });

$('#add_fresh').click(function(){
  var rowobj = $("#addNewRow").html();
  $('#fresh_field').append(rowobj);
});
 $(document).on('click', '.btn_remove', function(){
      $(this).parent().parent().remove();
 });

 $( "#order_id" ).autocomplete({
      source: function( request, response ) {

          var searchText = extractLast(request.term);
          $.ajax({
              url: "<?php echo base_url("/admin/Orders/order_number") ?>",
              type: 'post',
              dataType: "json",
              data: {
                  search: searchText,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
              },
              success: function( data ) {
                  response( data );
              }
          });
      },
      select: function( event, ui ) {
          var terms = split( $('#order_id').val() );

          terms.pop();

          terms.push( ui.item.label );

          terms.push( "" );
          $('#order_id').val(terms.join( ", " ));

          // Id
          var terms = split( $('#selectuser_ids').val() );

          terms.pop();

          terms.push( ui.item.value );

          terms.push( "" );
          $('#selectuser_ids').val(terms.join( ", " ));

          return false;
      }

  });

});

   </script>
