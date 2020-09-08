<div id="content">
  <div id="content-header">
      <div class="container-fluid">
        <div class="row-fluid">
          <div class="span4 text-right">
            <a href="#addnew" class="btn btn-primary addNewbtn"  data-toggle="modal" >Add New</a>
          </div>
      </div>
    </div>
  </div>
<div class="container-fluid"><hr>
  <div class="row">
  <div class="col-12">
  <div class="card">
    <div class="card-body">
        <form id="jobWorkFilter">
          <div class="form-row">
            <div class="col-4">
          <select id="searchByCat" name="searchByCat" class="form-control">
          <option value="">-- Select Category --</option>
          <option value="name">Name</option>
          <option value="phone_no">Phone No.</option>
          <option value="gst">GST/URD</option>
          <option value="deptName">Department</option>
          <option value="subDeptName">Sub Department</option>
          <option value="address">Address</option>
        </select>
      </div>
      <div class="col-4">
        <input type="text" name="searchValue" value="" placeholder="Search" id="searchByValue" class="form-control">
          </div>
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
          <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search</button>  </div>
        </form>
      </div>
      </div>
      <div class="card">
        <div class="card-body">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Employee List</h5>
          </div>
        <div class="widget-content nopadding">
          <table class="table table-striped table-bordered data-table" id="jobWork">
            <thead>
              <tr>
                <th>S/No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($user_data>0)
              {
              $id=1;
              foreach ($user_data as $value) { ?>
              <tr class="gradeU">
                <td><?php echo $id ?></td>
                <td><?php echo $value['first_name']?></td>
                <td><?php echo $value['mobile']?></td>
                <td><?php echo $value['email']?></td>
                <td><?php echo $value['role']?></td>
                <td><?php echo $value['department']?></td>
                <td><?php echo $value['status']?></td>
                <td>
                  <a href="<?php echo '#'.$value['id']; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                    <i class="fas fa-edit blue"></i>
                  </a>
                  &nbsp;&nbsp;&nbsp;
                  <a class="text-danger text-center tip" href="javascript:void(0)" onclick="delete_detail(<?php echo $value['id'];?>)" data-original-title="Delete">
                    <i class="mdi mdi-delete red"></i>
                  </a>
                  </td>
              </tr>

              <!-- Edit modal wind-->
              <div id="<?php echo $value['id']; ?>" class="modal hide" >
                   <div class="modal-dialog" role="document ">
                    <div class="modal-content">
              <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Employee/employee/edit/').$value['id']; ?>" >
                <div class="modal-header">
                    <h5 class="modal-title">Edit Detail</h5>
                  <button data-dismiss="modal" class="close" type="button">×</button>

                </div>
                <div class="modal-body">
                  <div class="widget-content nopadding">

                    <div class="form-group row">
                      <label class="control-label col-sm-3">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" value="<?php echo $value['first_name']?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3">Phone/Mobile</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" name="mobile" value="<?php echo $value['mobile']?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3">Email</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" value="<?php echo $value['email']?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3">Department</label>
                      <div class="col-sm-9">
                        <select name="department" class="form-control">
                          <?php foreach ($dept_name as $rec): ?>

                          <option <?php if ($value['department']==$rec->deptName) { ?>selected <?php } ?>  value="<?php echo $rec->deptName ?>"><?php echo $rec->deptName ?></option>
                        <?php endforeach;?>

                        </select>
                      </div>
                    </div>



                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
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
<form class="form-horizontal" method="post" action="<?php echo base_url('admin/Employee/employee/Adduser') ?>" >
  <div class="modal-header">
    <h5 class="modal-title">Add Detail</h5>
    <button data-dismiss="modal" class="close" type="button">×</button>
  </div>
  <div class="modal-body">
    <div class="widget-content nopadding">
      <div class="form-group row">
        <label class="control-label col-sm-3">Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="first_name" value="">
        </div>
      </div>
       <div class="form-group row">
        <label class="control-label col-sm-3">Password</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password" value="">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3">Phone/Mobile</label>
        <div class="col-sm-9">
          <input type="number" class="form-control" name="mobile" value="">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3">Email</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="email" value="">
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3">Department</label>
        <div class="col-sm-9">
          <select name="department" class="form-control">
            <?php foreach ($dept_name as $rec): ?>
            <option value="<?php echo $rec->deptName; ?>"><?php echo $rec->deptName; ?></option>
          <?php endforeach;?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-3">User Role</label>
        <div class="col-sm-9">
          <select name="role" class="form-control">
            <?php foreach ($user_role as $role): ?>
            <option value="<?php echo $role->id; ?>"><?php echo $role->label; ?></option>
          <?php endforeach;?>
          </select>
        </div>
      </div>


    </div>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
    <input type="submit" class="btn btn-primary">
    <a data-dismiss="modal" class="btn" href="#">Cancel</a>
  </div>
</form>
</div>
</div>
</div>
<!-- <div class="control-group">
<label class="control-label">Rate</label>
<div class="controls">
  <label>
    <input type="checkbox" name="mtr[]" value="MTR" />
    MTR <input type="number" name="mtr[]" value="" id="">
  </label>

  <label>
    <input type="checkbox" name="saree[]" value="Saree" />
    Saree <input type="number" name="saree_rate" value="" id=""></label>

    <label>
      <input type="checkbox" name="suit" value="Suit" />
      Suit <input type="number" name="suit_rate" value="" id="">
    </label>

    <label>
      <input type="checkbox" name="dupatta" value="Dupatta" />
      Dupatta <input type="number" name="dupatta_rate" value="" id="">
    </label>

  </div>
</div> -->
<script>
function delete_detail(id)
{
  var del = confirm("Do you want to Delete");
  if (del== true)
  {
    var sureDel = confirm("Are you sure want to delete");
    if (sureDel == true)
    {
      window.location="<?php echo base_url()?>admin/Employee/employee/delete/"+id;
    }

  }
}

</script>
