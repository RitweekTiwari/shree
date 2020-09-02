<div id="content">
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <form id="unitFilter">
                  <div class="form-row">
                    <div class="col-7">
                      <input type="text" name="searchValue" placeholder="Design Barcode Search" id="searchByValue" class="form-control">
                    </div>
                    <div class="col-3">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" class="btn btn-info" id="get_btn"> <i class="fas fa-search"></i> Status</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-4">

                <div class="form-row">
                  <div class="col-7">
                    <input type="text" name="searchValue" placeholder="Order Barcode Search" id="obc" class="form-control">
                  </div>
                  <div class="col-3">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button type="submit" class="btn btn-info" id="get_obc"> <i class="fas fa-search"></i> Status</button>
                  </div>
                </div>

              </div>
              <div class="col-4">

                <div class="form-row">
                  <div class="col-7">
                    <input type="text" name="searchValue" placeholder="Parent Barcode Search" id="pbc" class="form-control">
                  </div>
                  <div class="col-4">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button type="submit" class="btn btn-info" id="get_pbc"> <i class="fas fa-search"></i> Status</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="container-fluid">
          <hr>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <form id="unitFilter">
                        <div class="form-row">
                          <div class="col-7">
                            <input type="text" name="searchValue" placeholder="Design Barcode Search" id="searchByValue" class="form-control">
                          </div>
                          <div class="col-3">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <button type="submit" class="btn btn-info" id="get_btn"> <i class="fas fa-search"></i> Status</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-4">

                      <div class="form-row">
                        <div class="col-7">
                          <input type="text" name="searchValue" placeholder="Order Barcode Search" id="obc" class="form-control">
                        </div>
                        <div class="col-3">
                          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                          <button type="submit" class="btn btn-info" id="get_obc"> <i class="fas fa-search"></i> Status</button>
                        </div>
                      </div>

                    </div>
                    <div class="col-4">

                      <div class="form-row">
                        <div class="col-7">
                          <input type="text" name="searchValue" placeholder="Parent Barcode Search" id="pbc" class="form-control">
                        </div>
                        <div class="col-4">
                          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                          <button type="submit" class="btn btn-info" id="get_pbc"> <i class="fas fa-search"></i> Status</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="show"></div>



          <div class="row well align-left">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-info " id='printAll'><i class="fa fa-print "></i> Print </button>&nbsp;&nbsp;&nbsp;&nbsp;
          </div>



        </div>
      </div>


      <?php include('barcode_js.php'); ?>

    </div>
    <div class="row" id="show">

    </div>





  </div>
</div>


<?php include('barcode_js.php'); ?>