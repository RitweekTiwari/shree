<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
          <div class="card container col-sm-12">
            <div class="card-body" id="result">
              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Fabric/addFabric') ?>">
                <div class="card-header">
                  <h5 class="card-title">FABRIC CREATION </h5>

                </div><br>


                <div class="form-group row">
                  <label class="control-label col-sm-3">FABRIC NAME</label>
                  <label class="control-label col-sm-3">FABRIC HSN</label>
                  <label class="control-label col-sm-2">FABRIC TYPE</label>
                  <label class="control-label col-sm-2">FABRIC CODE</label>
                  <label class="control-label col-sm-2">FABRIC UNIT</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control clear read" name="fabricName" value="" required id="fabric_name">
                    <span id="fabric-error" class="error" style="color:red;"></span>
                  </div>

                  <div class="col-sm-3">
                    <select name="fabHsnCode" class="form-control select2 clear" id="fabHsnCode">
                      <?php foreach ($hsn_data as $hsn_value) : ?>
                        <option value="<?php echo $hsn_value->hsn_code ?>"><?php echo $hsn_value->hsn_code ?></option>
                      <?php endforeach; ?>

                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control clear" name="fabricType" value="" id="fabricType">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control clear" name="fabricCode" value="" id="fabricCode">
                    <input type="hidden" class="form-control" name="fabricid" value="" id="fabricid">
                  </div>
                  <div class="col-sm-2">
                    <select name="fabricUnit" class="form-control clear" id="fabricUnit">
                      <?php foreach ($unit_data as $unit_value) : ?>
                        <option value="<?php echo $unit_value->id ?>"><?php echo $unit_value->unitSymbol ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                </div>

                <hr>
                <div class="form-group row edit_details">
                  <label class="control-label col-sm-3">Other Details</label>
                  <div class="col-sm-3">
                    <input type="radio" class="form-control " id="radio1" value="Yes" name="other">Yes
                  </div>
                  <div class="col-sm-3">
                    <input type="radio" class="form-control " id="radio2" value="No" name="other">No
                  </div>
                </div>


                <div class="row " id="addbtn">
                  <div class="col-sm-12 " style="left:82%">
                    <label class="control-label">Add Details </label> <button type="button" name="add" id="add_fresh" class="btn btn-primary btn-sm">+</button>
                  </div>
                </div>
                <div class="form-group" id="extra-details"></div>

                <div class="row">
                  <div class="col-sm-1">Segment</div>
                  <div class="col-sm-5">Fabric</div>
                  <div class="col-sm-1">Length</div>
                  <div class="col-sm-1">Width</div>
                  <div class="col-sm-1">Max</div>
                  <div class="col-sm-1">Min</div>
                  <div class="col-sm-1">Option</div>
                </div>
                <div id="fresh_field">

                </div>
                <br>
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
                  <input type="button" value="Cancel" class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>&nbsp;&nbsp;&nbsp;


              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div id="addNewRow" class="row" style="display: none">

  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <!-- <div class="card">
    <div class="card-body">
        <form id="fabricFilter">
          <div class="form-row">
            <div class="col-4">
              <select id="searchByCat" name="searchByCat" class="form-control">

                <option value="fabricName">Fabric Name</option>
                <option value="fabHsnCode">Fabric HSN Code</option>
                <option value="fabricType">Fabric Type</option>
                <option value="fabricCode">Fabric Code</option>
              </select>
            </div>
          <div class="col-4">
            <input type="text" name="searchValue" placeholder="Search" id="searchByValue" class="form-control">
          </div>
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
          <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>  </div>
        </form>
      </div>
      </div> -->
        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Fabric List</h5>
              </div>
              <hr>
              <div class="row well">
                &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                &nbsp;&nbsp;<a type="button" class="btn btn-info  btn-success" id='clearfilter' style="color:#fff;">Clear filter</a>&nbsp;&nbsp; &nbsp;&nbsp;
                <button id="btn-show-all-children" class="btn btn-success " type="button">Expand/Collapse</button>
              </div>
              <hr>

              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered " id="fabric">
                  <thead>
                    <tr>
                      <th></th>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>Fabric Name</th>
                      <th>Fabric HSN Code</th>
                      <th>Fabric Type</th>
                      <th>Fabric Code</th>
                      <th>Fabric Unit</th>
                      <th>Purchase</th>
                      <th>fabricId</th>
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
</div>

<!-- add modal wind-->



<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>admin/Fabric/delete/" + id,

          success: function(response) {
            if (response == 1)
              $('#fabric').DataTable().ajax.reload();
            else
              toastr.error('Error!', "Fabric is used in Stock. Cannot Delete");

          }
        });

      }
    }
  }
</script>
<?php include('js.php'); ?>