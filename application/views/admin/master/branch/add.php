<!-- add modal wind-->
<div id="addnew" class="modal hide">
    <div class="modal-dialog" role="document ">
    <div class="modal-content">
  <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Branch_detail/addBranch') ?>" >
    <div class="modal-header">
        <h5 class="modal-title">Add Detail</h5>
      <button data-dismiss="modal" class="close" type="button">×</button>
    </div>
    <div class="modal-body">
      <div class="widget-content nopadding">

        <div class="form-group row">
          <label class="col-sm-3">Name</label>
          <div class="col-sm-9">
            <input type="text" name="name" required value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Sort Name</label>
          <div class="col-sm-9">
            <input type="text" name="sort_name" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Phone Number</label>
          <div class="col-sm-9">
            <input type="number" name="phone_no" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Email</label>
          <div class="col-sm-9">
            <input type="email" name="email" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Remark</label>
          <div class="col-sm-9">
            <input type="text" name="remark" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Category</label>
          <div class="col-sm-9">
            <input type="text" name="category" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-sm-3">Address</label>
          <div class="col-sm-9">
            <textarea name="address" cols="30" rows="5"></textarea>
          </div>
        </div>

      </div>
    </div>
    <div class="modal-footer">
    <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <input type="submit" class="btn btn-primary">
      <a data-dismiss="modal" class="btn" href="#">Cancel</a>
    </div>
  </form>
  </div>
  </div>
</div>
<!-- edit modal wind-->
