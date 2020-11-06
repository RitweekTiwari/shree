<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="col-lg-12">
                        <div class="row">


                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#FF57B9,#A704FD);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-border-outside"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/transaction/showDye/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-cart"></i></h4>
                                            <h5 class="text-white">DYE TRANSACTION</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#5b247a,#ea6060);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-download"></i>
                                        </h1>

                                        <a href="<?php echo base_url('admin/Dye_transaction/showDyeInList/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-cart"></i></h4>
                                            <h5 class="text-white">MATERIAL IN</h5>
                                        </a>
                                        <span class="badge badge-pill  new-notify" id="dye"></span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#b1ea4d,#459522);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-upload"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/Dye_transaction/showDyeOutList/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-cart"></i></h4>
                                            <h5 class="text-white">MATERIAL OUT</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box text-center" style="background: linear-gradient(45deg,#f2d50f,#da0641);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-folder-star"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/Dye_transaction/showStock/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-store"></i></h4>
                                            <h5 class="text-white">STOCK OF GODOWN</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#F5515F,#A1051D);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-alert"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/stock/stock_check_dye/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-store"></i></h4>
                                            <h5 class="text-white">STOCK CHECK</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#FF57B9,#A704FD);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-border-outside"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/transaction/show_bill/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-store"></i></h4>
                                            <h5 class="text-white">BILL TRANSACTION</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" style="background: linear-gradient(45deg,#FF57B9,#A704FD);">
                                        <h1 class="font-light text-white">
                                            <i class="mdi mdi-border-outside"></i>
                                        </h1>
                                        <a href="<?php echo base_url('admin/stock/stock_list/') . $godown; ?>">
                                            <h4 class=" font-light text-white"><i class="mdi mdi-store"></i></h4>
                                            <h5 class="text-white">STOCK LIST</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('admin/transaction/get_count/') . $godown ?>",


                success: function(data) {
                    data = JSON.parse(data);
                    if (data) {

                    }
                }
            });
        });
    </script>