<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4 text-right">
          <a href="#addnew" class="btn btn-primary addNewbtn" data-toggle="modal">Add New</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form id="dataCateFilter">
              <div class="form-row">
                <div class="col-4">
                  <select id="searchByCat" name="searchByCat" class="form-control">
                    <option value="">-- Select Category --</option>
                    <option value="dataCategory">Order Category Name</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="searchValue" class="form-control" value="" placeholder="Search"
                    id="searchByValue">
                </div>
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                  value="<?=$this->security->get_csrf_hash();?>" />
                <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>
              </div>
            </form>

          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Category List</h5>
              </div>
              <div class="row well">
                <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i
                    class="mdi mdi-delete red"></i></a>
              </div>
              <div class="widget-content nopadding">
                <table class="table table-striped table-bordered data-table" id="dataCate">
                  <thead>
                    <tr>
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Order Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                if($data_cate_data>0)
                  {
                    $id=1;
                       foreach ($data_cate_data as $value) { ?>
                    <tr class="gradeU" id="tr_<?php echo $value->id?>">
                      <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->id ?>"></td>
                      <td><?php echo $id; ?></td>
                      <td><?php echo $value->dataCategory; ?></td>
                      <td>
                        <a href="<?php echo '#'.$value->id; ?>" class="text-center tip" data-toggle="modal"
                          data-original-title="Edit">
                          <i class="fas fa-edit blue"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a class="text-danger text-center tip" href="javascript:void(0)"
                          onclick="delete_detail(<?php echo $value->id;?>)" data-original-title="Delete">
                          <i class="mdi mdi-delete red"></i>
                        </a>
                      </td>
                    </tr>

                    <!-- Edit modal wind-->
                    <div id="<?php echo $value->id; ?>" class="modal hide">
                      <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                          <form class="form-horizontal" method="post"
                            action="<?php echo base_url('admin/Data_category/edit/').$value->id;?>"
                            name="basic_validate" id="basic_validate" novalidate="novalidate">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Order Category</h5>
                              <button data-dismiss="modal" class="close" type="button">×</button>

                            </div>
                            <div class="modal-body">
                              <div class="widget-content nopadding">
                                <div class="form-group row">
                                  <label class="control-label col-sm-3">Order Category Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="dataCategory" class="form-control"
                                      value="<?php echo $value->dataCategory; ?>" id="required">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                              <input type="submit" value="Update" class="btn btn-primary">
                              <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Edit modal wind-->
                    <?php $id=$id+1;  } } ?>

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

<!-- add modal wind-->
<div id="addnew" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Data_category/addDataCate')?>"
        name="basic_validate" id="basic_validate" novalidate="novalidate">
        <div class="modal-header">
          <h5 class="modal-title">Add Order Category</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <div class="form-group row">
              <label class="control-label col-sm-3">Order Category Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="dataCategory" value="" id="required">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
            value="<?php echo $this->security->get_csrf_hash();?>">
          <input type="submit" class="btn btn-primary">
          <a data-dismiss="modal" class="btn" href="#">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End add modal wind-->
<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url()?>admin/Data_category/delete/" + id;
      }

    }
  }
</script>
<?php include('category_js.php'); ?>
