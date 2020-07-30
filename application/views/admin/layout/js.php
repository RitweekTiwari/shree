
<script type="text/javascript">
  $(document).ready(function() {
     var table=  $('.data-table ').DataTable({
      
      
     "pageLength": 50,
     "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
     select: true,
    
     
     dom: 'Bfrtip',
        buttons: [
            'pageLength', {
                extend: 'excel', footer: true, 
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'pdf', footer: true, 
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'print', footer: true, 
                exportOptions: {
                    columns: ':visible'
                }
            },
            
            'selectAll',
            'selectNone',
            'colvis'
        ],
         scrollY:        500,
        scrollX:        false,
        scrollCollapse: true,
        paging:         true,
        
  
    } );
    // Multi Select
     $(document).on('click','#master', function(e) {
   
      var rows = table.rows({
        'search': 'applied'
      }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('#frc tbody').on('change', 'input[type="checkbox"]', function () {
      // If checkbox is not checked
      if (!this.checked) {
        var el = $('#master').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if (el && el.checked && ('indeterminate' in el)) {
          // Set visual state of "Select all" control
          // as 'indeterminate'
          el.indeterminate = true;
        }
      }
    });
     $(".select2").select2();

   
  
     // use Class to remove datatable
     $('.remove_datatable').DataTable().destroy();

    $("#filter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      $.ajax({
        'url': "<?php echo base_url('/admin/Branch_detail/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#branch').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#CustomerFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      $.ajax({
        'url': "<?php echo base_url('/admin/Customer_detail/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#customer').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#jobWorkFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Job_work_party/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#jobWork').find('tbody').html(JSON.parse(response));
        }
      });
    });
      $("#jobWorkTypeFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Job_work_type/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#jobWorktype').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#deptFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Department/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#dept').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#subDeptFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Sub_department/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#subDept').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#hsnFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Hsn/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#hsn').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#fabricFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Fabric/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#fabric').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#designFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Design/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#design').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#sessionFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Session_year/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#session').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#orderTypeFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Order_type/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#orderType').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#dataCateFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Data_category/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#dataCate').find('tbody').html(JSON.parse(response));
        }
      });
    });

    $("#unitFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "<?php echo base_url('/admin/Unit/filter'); ?>",
        'type': 'POST',
        'data': form,
        'success': function(response) {
          $('#unit').find('tbody').html(JSON.parse(response));
        }
      });
    });

$("#frcFilter, #frcAdvanceFilter").on("submit", function(event) {
      event.preventDefault();
      var form = $(this).serialize();
      console.log(form);
      $.ajax({
        'url': "",
        'type': 'POST',
        'data': form,
        'success': function(response) {
        
          $('#frc').find('tbody').html(JSON.parse(response));
        }
      });
    });
   
//  $("#frc_dateFilter").on("submit", function(event) {
//       event.preventDefault();
//       var form = $(this).serialize();
//       console.log(form);
//       $.ajax({
//         'url': "<?php echo base_url('/admin/frc/date_filter'); ?>",
//         'type': 'POST',
//         'data': form,
//         'success': function(response) {
          
//           $('#frc').find('tbody').html(JSON.parse(response));
//         }
//       });
//     });
        	});

  $(document).change(function() {
  $(document).on('click','#master', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });

	});

  function goPage(newURL) {

    // if url is empty, skip the menu dividers and reset the menu selection to default
    if (newURL != "") {

      // if url is "-", it is this page -- reset the menu:
      if (newURL == "-") {
        resetMenu();
      }
      // else, send page to designated URL
      else {
        document.location.href = newURL;
      }
    }
  }

  // resets the menu selection upon entry to this page:
  function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
  }
</script>
