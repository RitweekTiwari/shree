<div id="content">
  <div id="content-header">
    <div class="container-fluid">

      <!-- add modal wind-->

      <div class="row">
        <div class="col-12">
          <div class="card">

          </div>
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-body">
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                      <h5>Emb Worker List</h5>
                    </div><hr>
                    <div class="row well">
                      &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('admin/emb') ?>" type="button" class="btn btn-info" style="color:#fff;">Go Back</a>

                    </div><hr>
                    <div class="widget-content nopadding">
                      <table class="table table-striped table-bordered data-table" id="jobWorktype">
                        <thead>
                          <tr>
                            <th><input type="checkbox" class="sub_chk" id="master"></th>
                            <th>S/No</th>
                            <th>Worker</th>
                            <th>Rate</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($emb > 0) {
                            $id = 1;
                            foreach ($worker as $value) { ?>
                              <tr class="gradeU" id="tr_<?php echo $value['metaid'] ?>">
                                <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['metaid'] ?>"></td>
                                <td><?php echo $id ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['rate'] ?></td>

                              </tr>


                          <?php $id = $id + 1;
                            }
                          } ?>
                        </tbody>
                      </table>
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
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/EMB/deleteembmeta/" + id;
      }

    }
  }
</script>
<style>
  #DataTables_Table_0_previous {
    display: none;
  }

  #DataTables_Table_0_paginate {
    display: none;
  }

  select {
    width: 120px;
    height: 35px;
    box-sizing: border-box;
    border-color: #e9ecef;
  }
</style>

<?php include('emb_js.php'); ?>