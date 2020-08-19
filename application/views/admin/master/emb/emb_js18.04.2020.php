<script src="<?php echo base_url('jexcelmaster/')?>asset/js/jquery.3.1.1.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jexcel.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jsuites.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jexcel.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>src/css/jexcel.datatables.css" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {
        var response = '';
        var design=[];
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('admin/EMB/get_emb_list')?>",

            success: function(text) {

        data= jexcel(document.getElementById('spreadsheet'), {
        data:text,
        search:true,
        pagination:10,
        columns: [
            // { type: 'checkbox',title:'Check',class:'sub_chk',allowDeleteRow:true,width:120 },
           { type: 'text', title:'id',width:60 },
            { type: 'dropdown', title:'Design Name' ,autocomplete:true, width:120,url:"<?php echo base_url('admin/EMB/getDesignName')?>" },
            { type: 'dropdown', title:'Worker Name',autocomplete:true, width:120,url:"<?php echo base_url('admin/EMB/get_workporty_name')?>" },
            { type: 'text', title:' Rate' , width:120 },
            { type: 'hidden', title:' Rate' , width:120 },


         ], onchange: changed,
            oninsertrow:insertrow,
      });

            console.log(data);
            }
        });
          var changed = function(instance, cell, x, y, value) {
            var cellName = jexcel.getColumnNameFromId([x,y]);
            var cell1 = data.getValueFromCoords(0,y);
           var workname = data.getValueFromCoords(2,y);


                var dat=[];
                if(x==1){
                    dat={
                      designName: value,
                      id : cell1,
                      workerName1:workname,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                    }
              $.ajax({
              url: "<?php echo base_url('admin/EMB/update')?>",
              type: "POST",
              data:dat,
              success: function(dataResult){
              console.log(dataResult);
              }
            });
                }

             var design = data.getValueFromCoords(1,y);
                if(x==2){
                    dat={
                      designName1: design,
                      workerName: value,
                      id : cell1,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                    }
                           $.ajax({
              url: "<?php echo base_url('admin/EMB/update')?>",
              type: "POST",
              data:dat,
              success: function(dataResult){
              console.log(dataResult);
              }
            });
                }
                if(x==3){
                    dat={
                      rate: value,
                      id : cell1,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                    }
                           $.ajax({
              url: "<?php echo base_url('admin/EMB/update')?>",
              type: "POST",
              data:dat,
              success: function(dataResult){
              console.log(dataResult);
              }
            });
                }
        }

        var insertrow  = function(instance,x,y) {

         dat={

                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                    }
          $.ajax({
              url: "<?php echo base_url('admin/EMB/add_emb')?>",
              type: "POST",
               data: dat,
              success: function(id){
               var cellName = jexcel.getColumnNameFromId([0,x+1]);

                    data.setValue(cellName,id);
                    var cell1 = data.getValueFromCoords(0,x+1);
              }
            });

          }
         $('#download').on('click', function () {
          $('#spreadsheet').jexcel('download');
         });


    jQuery('.delete_all').on('click', function(e) {
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
         url: "<?= base_url()?>admin/design/deleteUser",
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
