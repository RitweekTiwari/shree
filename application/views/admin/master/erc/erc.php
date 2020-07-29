<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class='card container'>
          <form class="form-horizontal" method="post" action="<?php echo base_url('admin/ERC/add_erc')  ?>" name="basic_validate" novalidate="novalidate">
            <div class="card-header">
              <h5 class="card-title">ADD</h5>


            </div>
            <div class="card-body">
              <div class="widget-content nopadding">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="control-label ">Design Name</label>

                    <select name="designname" class="form-control select2" id='designname'>
                      <option value="">Select Design</option>
                      <?php foreach ($fresh_designname as $rec) : ?>
                        <option value="<?php echo $rec['designName'] ?>"><?php echo $rec['designName'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-sm-3">
                    <label class="control-label ">Design Code</label>

                    <input type="text" class="form-control" name="descode" value="" id='descode'>

                  </div>

                  <div class="col-sm-2">
                    <label class="control-label ">Rate</label>

                    <input type="number" class="form-control" name="rate" value="" id='rate'>
                  </div>
                  <div class="col-sm-2" id='submit'>

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <input type="submit" value="Add" class="btn btn-primary">


                  </div>
                </div>
                <div class='text-center text-danger' id='msg'></div>
              </div>
            </div>

          </form>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">

              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>ERC Design List</h5>
              </div>

              <hr>
              &nbsp;&nbsp; &nbsp;&nbsp; <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              <hr>
              <table class="data-table text-center table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Design Name</th>
                    <th>Design Code</th>
                    <th>Rate</th>
                    <th>options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $c = 1;
                  foreach ($design as $value) { ?>
                    <tr id="<?php echo $value['id']; ?>">
                      <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['id'] ?>"></td>
                      <td><?php echo $value['desName']; ?></td>
                      <td><?php echo $value['desCode']; ?></td>
                      <td><?php echo $value['rate']; ?></td>
                      <td>
                        <a class="text-center tip edit">
                          <i class="fas fa-edit blue"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value['id']; ?>)">
                          <i class="mdi mdi-delete red"></i>
                        </a>
                      </td>

                    </tr>

                  <?php $c += 1;
                  } ?>


                </tbody>
              </table>

            </div>

          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>New Design List</h5>
              </div>
              <hr>
              <table class="data-table text-center table-bordered">
                <thead>
                  <tr>
                    <th>Design Name</th>
                    <th>Stitch</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($fresh_designname as $value) { ?>
                    <tr class="gradeU order_row" id="">

                      <td><?php echo $value['designName']; ?></td>
                      <td><?php echo $value['stitch']; ?></td>


                    </tr>

                  <?php } ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
</div>
<div id="edit" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/ERC/update/')  ?>" name="basic_validate" novalidate="novalidate">
        <div class="modal-header">
          <h5 class="modal-title">Edit Department</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>

        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Design Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="designname" value="" id='designname1'>

              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Design Code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="descode" value="" id='descode1'>
              </div>
            </div>
            <input type="hidden" name="id" id='erc_id'>


            <div class="form-group row">
              <label class="control-label col-sm-3">Rate</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="rate" value="" id='rate1'>
              </div>
            </div>
          </div>
          <div class='text-center text-danger' id='msg1'></div>
        </div>
        <div class="modal-footer" id='update'>
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
          <input type="submit" value="Update" class="btn btn-primary">
          <a data-dismiss="modal" class="btn" href="#">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<style>

</style>
<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");

    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");

      if (sureDel == true) {
        window.location = "<?php echo base_url() ?>admin/ERC/delete/" + id;
      }
    }
  }
</script>
<?php include('erc_js.php'); ?>