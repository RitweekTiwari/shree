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
  <!-- add modal wind-->
  <div id="addnew" class="modal hide">
    <div class="modal-dialog" role="document ">
      <div class="modal-content">
        <!-- <form class="form-horizontal" id="addDesign" method="post" action="<?php echo base_url('admin/Design/addDesign') ?>" name="basic_validate"  enctype="multipart/form-data"> -->
        <form class="form-horizontal" id="addDesign" method="post" action="<?php echo base_url('admin/Design/addDesign') ?>" name="basic_validate" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Add Design</h5>
            <button data-dismiss="modal" class="close" type="button">×</button>

          </div>
          <div class="modal-body">
            <div class="widget-content nopadding">
              <span id="design-error" class="error" style="color:red;"></span>
              <div class="form-group row">
                <label class="control-label col-sm-3">Design Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="designName" value="" id="design_name">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Design Series</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="designSeries" value="" id="designSeries">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Fabric Name</label>
                <div class="col-sm-9">
                  <select name="fabricName" id="fabricName" class="form-control">
                    <?php foreach ($febName as $rec) : ?>
                      <option value="<?php echo $rec->fabricName; ?>"> <?php echo $rec->fabricName; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-sm-3">Stitch</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="stitch" value="">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Dye</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="dye" value="">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Matching</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="matching" value="">
                </div>
              </div>

              <div class="form-group row">
                <label class="control-label col-sm-3">TH Catting Rate</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="htCattingRate" value="">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Design Pic</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="designPic" value="">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">Design On</label>
                <div class="col-sm-9">
                  <!--<input type="text" class="form-control" name="designOn" value="">-->
                  <input type="text" class="form-control" name="designOn" id="designOn" value="">
                </div>
              </div>



            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="submit" class="btn btn-primary" id="design_btn">
            <a data-dismiss="modal" class="btn" href="#">Cancel</a>
          </div>
        </form>

      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div id="accordion">

              <div class="modal-content">
                <div class="modal-header">
                  <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    Simple filter
                  </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                  <div class="modal-body">
                    <form method="post">
                      <div class="form-row">

                        <div class="col-3">
                          <select name="searchByCat" class="form-control form-control-sm" required id='searchByCat'>
                            <option value="">-- Select Category --</option>
                            <option value="designName">Design Name</option>
                            <option value="desCode">Design Code</option>
                            <option value="designSeries">Series</option>
                            <option value="barCode"> Barcode</option>
                            <option value="fabricName">Fabric Name</option>
                            <option value="rate">Emb Rate</option>
                            <option value="stitch">Stitch</option>
                            <option value="dye">Dye</option>
                            <option value="matching">Matching</option>
                            <option value="sale_rate">Sale rate</option>
                            <option value="htCattingRate">Ht cating rate</option>
                            <option value="designOn">Design On</option>
                          </select>
                        </div>
                        <div class="col-3">
                          <input type="text" name="searchValue" id='searchValue' class="form-control form-control-sm" value="" placeholder="Search" required>
                        </div>

                        <button type="button" id='simplefilter' class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>


                        <!-- <div class="col-3">
                            <input type="text" name="replaceValue" class="form-control form-control-sm" value="" placeholder="Replace">
                          </div>
                          <button type="submit" name="replacebtn" class="btn btn-warning btn-xs"> Replace</button> -->

                      </div>
                    </form>



                  </div>
                </div>
              </div>

              <div class="modal-content">
                <div class="modal-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                    Advance filter
                  </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="modal-body">
                    <form method="post">
                      <table class=" remove_datatable">
                        <caption>Advance Filter</caption>
                        <thead>
                          <tr>

                            <th>Design name</th>
                            <th>Design Series</th>
                            <th>Design Code</th>
                            <th>Emb Rate</th>
                            <th>Stitch</th>
                            <th>Dye</th>

                          </tr>
                        </thead>
                        <tr>

                          <td><input type="text" id="fdesignName" class="form-control form-control-sm" value="" placeholder="designName"></td>

                          <td><input type="text" id="fdesignSeries" class="form-control form-control-sm" value="" placeholder="design Series"></td>

                          <td><input type="text" id="fdesCode" class="form-control form-control-sm" value="" placeholder="DesignCode"></td>

                          <td><input type="text" id="frate" class="form-control form-control-sm" value="" placeholder="Emb rate"></td>

                          <td><input type="text" id="fstitch" class="form-control form-control-sm" value="" placeholder="stitch"></td>
                          <td><input type="text" id="fdye" class="form-control form-control-sm" value="" placeholder="Dye"></td>
                        </tr>

                        <th>Matching</th>
                        <th>Sale Rate</th>
                        <th>Ht Cathing Rate</th>
                        <th>Fabric Name</th>
                        <th>Barcode</th>
                        <th>designOn</th>
                        <tr>
                          <td><input type="text" id="fmatching" class="form-control form-control-sm" value="" placeholder="Matching"></td>

                          <td><input type="text" id="fsale_rate" class="form-control form-control-sm" value="" placeholder="Sale Rate"></td>

                          <td><input type="text" id="fhtCattingRate" class="form-control form-control-sm" value="" placeholder="Ht Cathing Rate"></td>

                          <td><input type="text" id="ffabricName" class="form-control form-control-sm" value="" placeholder="Fabric Name"></td>

                          <td><input type="text" id="fbarCode" class="form-control form-control-sm" value="" placeholder=" BarCode"></td>

                          <td><input type="text" id="fdesignOn" class="form-control form-control-sm" value="" placeholder="Design On"></td>
                        </tr>
                      </table>


                      <button type="button" id='advancefilter' class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Design List</h5>
              </div>
              <hr>
              <div class="widget-content nopadding">
                <div class="row well">
                  &nbsp; &nbsp;&nbsp; <a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left print_all btn-success" style="color:#fff;"><i class="fa fa-print"></i></a>
                  &nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info   btn-success" id='clearfilter' style="color:#fff;">Clear filter</a>

                </div>
                <hr>
                <table class=" table-striped  table-responsive  table-bordered  table-responsive" id="design">
                  <caption style='caption-side : top' class=" text-info">
                    <h6 class="text-center" id='caption1'></h6>
                  </caption>
                  <thead>
                    <tr class="odd" role="row">
                      <th><input type="checkbox" class="sub_chk" id="master"></th>
                      <th>S/No</th>
                      <th>Design Name</th>
                      <th>Design Series</th>
                      <th>Design Code</th>
                      <th>Emb Rate</th>
                      <th>Stitch</th>
                      <th>Dye</th>
                      <th>Matching</th>
                      <!-- <th>Sale Rate</th> -->
                      <th>HT Catting Rate</th>
                      <th>Design Image</th>
                      <th>Fabric Name</th>
                      <th>Bar Code</th>
                      <th>Design On</th>
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
<div id="edit" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/Design/edit/') ?>" name="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
        <div class="modal-header">

          <h3>Edit Design</h3>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">

            <div class="form-group row">
              <label class="control-label col-sm-3">Design Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="designName" id='designName1'>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Design Series</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="designSeries" id='designSeries1'>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-3">Stitch</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="stitch" id='stitch1'>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Dye</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="dye" id='dye1'>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Matching</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="matching" id='matching1'>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-3">TH Catting Rate</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="htCattingRate" id='htCattingRate1'>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-sm-3">Design Pic</label>
              <div class="col-sm-2">
                <img src="" alt="image" style="height: 50px; width: 50px;" id='designPic1'>
              </div>
              <div class="col-sm-7">
                <input type="file" class="form-control" name="designPic1">
              </div>

            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Design On</label>
              <div class="col-sm-9">


                <select name="designOn" class="form-control" id='designOn1'>
                  <?php foreach ($febType as $rec) : ?>
                    <option value="<?php echo $rec->fabricType ?>">
                      <?php echo $rec->fabricType ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-3">Fabric name</label>
              <div class="col-sm-9">
                <select name="fabricName" class="form-control" id='fabricName1'>
                  <?php foreach ($febName as $rec) : ?>
                    <option value="<?php echo $rec->fabricName ?>"><?php echo $rec->fabricName ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="designId" id='designId'>
          <input type="hidden" name="barCode" id='barCode'>
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <input type="submit" value="Update" class="btn btn-primary">
          <a data-dismiss="modal" class="btn" href="#">Cancel</a>
        </div>
      </form>
      <div>
      </div>
    </div>


    <script type="text/javascript">
      function delete_detail(id) {
        var del = confirm("Do you want to Delete");
        if (del == true) {
          var sureDel = confirm("Are you sure want to delete");
          if (sureDel == true) {
            window.location = "<?php echo base_url() ?>admin/Design/delete/" + id;
          }
        }
      }


      function edit(id) {

        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>admin/design/getDesign",

          data: {
            id: id,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success: function(response) {
            response = JSON.parse(response);

            $("#designId").val(id);
            $("#designName1").val(response['designName']);
            $("#designSeries1").val(response['designSeries']);
            $("#stitch1").val(response['stitch']);
            $("#dye1").val(response['dye']);
            $("#matching1").val(response['matching']);
            $("#htCattingRate1").val(response['htCattingRate']);
            $("#designPic1").attr('src', '<?php echo base_url('upload/') ?>' + response['designPic']);
            $("#designOn1").val(response['designOn']);
            $("#fabricName1").val(response['fabricName']);
            $("#barCode").val(response['barCode']);
            $("#edit").modal();
          }
        });

      }
    </script>
    <?php include('design_js.php'); ?>