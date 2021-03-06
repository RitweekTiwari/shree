<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="card container">
          <div class="card-body">
            <form class="form-horizontal" id="submitjob">
              <div class="modal-header">
                <h5 class="modal-title">ADD DETAILS</h5>
              </div>

              <div class="modal-body">
                <div class="widget-content nopadding">
                  <div class="form-group row"> <label class="control-label col-sm-1">Type</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control clear" name="type" value="" id="type" required>
                      <input type="hidden" class="form-control" name="jobworkId" value="" id="jobworkId">
                    </div>
                    <label class="control-label col-sm-1">Category</label>
                    <div class="col-sm-3">
                      <select class="form-control " id="category" name="category" required>
                        <option> -- Select One -- </option>
                        <option value="No Charge"> No Charge </option>
                        <option value="Constant"> Constant </option>
                        <option value="Attachment"> Attachment </option>

                      </select>
                    </div>
                    <label class="control-label col-sm-1">Rate From</label>
                    <div class="col-sm-3">
                      <select class="form-control " id="from" name="from" required>

                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row " id="extra-details"></div>
                  <div class="row" id="details">
                    <div class="col-md-3">
                      <label>Job</label>
                      <input type="text" class="form-control clear" name="job[]" value="" required>
                    </div>
                    <div class="col-md-3">
                      <label>Rate</label>
                      <input type="number" class="form-control clear" name="rate[]" value="0" required>
                    </div>

                    <div class="col-md-4">
                      <label>Choose Unit</label>
                      <select name="unit[]" class="form-control" required>
                        <option value=""> Select Unit </option>
                        <?php foreach ($units as $value) : ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo $value['unitSymbol']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-2">
                      <label> Action </label><br>
                      <button type="button" name="add" id="add_fresh" class="btn btn-primary btn-sm">+</button>
                    </div>
                  </div>
                  <div id="fresh_field">
                  </div><br>
                  <div class=" float-right" id="submit">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="submit" class="btn btn-primary">
                  </div>
                  <div class=" float-right" id="update">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="submit" class="btn btn-primary" value="Update" id="update_btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class=" float-right" id="cancle">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="button" value="Cancle" class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>&nbsp;&nbsp;&nbsp;
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- add modal wind-->




  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Job Work Type List</h5>
              </div>

              <hr>
              <div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                &nbsp;&nbsp;<a type="button" class="btn btn-info  btn-success" id='clearfilter' style="color:#fff;">Clear filter</a>&nbsp;&nbsp; &nbsp;&nbsp;
                <button id="btn-show-all-children" class="btn btn-success " type="button">Expand/Collapse</button>
              </div>
              <hr>

              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered " id="jobWorklist">
                  <thead>
                    <tr>
                      <th></th>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Rate from</th>
                      <th>jobconstant</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                </table>


              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div id="addNewRow" class="row" style="display: none">
    <div class="row">
      <div class="col-md-3">
        <input type="text" class="form-control clear" name="job[]" value="" required>
      </div>
      <div class="col-md-3">
        <input type="number" class="form-control clear" name="rate[]" value="0" required>
      </div>
      <div class="col-md-4">
        <select name="unit[]" class="form-control" required>
          <option value="">Select Unit</option>
          <?php foreach ($units as $value) : ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['unitSymbol'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="button" name="remove" class="btn btn-danger btn-sm btn_remove">X</button>
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
        window.location = "<?php echo base_url() ?>admin/Job_work_type/delete/" + id;
      }

    }
  }
</script>


<?php include('jobtype_js.php'); ?>