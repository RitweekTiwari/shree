<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">

      </div>
    </div>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
                <form action="">
                  <div id="feedback">
                    <h4>Select Fabric Name:</h4>
                  </div><br>
                  <div class="form-group">
                    <select name="fabric" id="fabric" class="form-control select2" style="width:180px;">
                      <option value="">select fabric</option>
                      <?php foreach ($fabric_data as $value) : ?>
                        <option value="<?php echo $value['fabricType']; ?>"><?php echo $value['fabricName']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </form>
              </div>
              <div class="col-sm-8" id="show">
                <div>
                  <form>
                    <h4>Apply FDA: </h4>
                    <input type="hidden" name="fabric_type" id='fabric_type'>
                    <input type="hidden" name="fabric_name" id='fabric_name'>
                </div>
                <div class="">
                  <table class="table table-bordered " id="table" id="fabric">
                    <thead>
                      <tr class="odd" role="row">
                       
                        <th><b>id</b></th>
                        <th><b>Design Name</b></th>
                        <th><b>Design Code</b></th>
                        <th><b>Stitch</b></th>


                      </tr>
                    </thead>

                  </table>
                </div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                <input type="submit" name="OK" class="btn btn-primary" value="Assign" id="asign" />
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
    <div class="row-fluid " id="asign_result">

    </div>
    <!-- add modal wind-->

    <!-- End add modal wind-->
    <style>
      td {
        padding: 5px;
        cursor: pointer;
      }

      .selected {
        background-color: #7460ee;
        color: #FFF;
      }
    </style>

    <?php include('asign_js.php'); ?>