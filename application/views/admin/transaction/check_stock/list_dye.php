<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12 ">
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
                                    <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
                                        <div class="form-row">
                                            <div class="col-2">
                                                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                                            </div>
                                            <div class="col-2">

                                                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-2">

                                                <select id="searchByCat" name="searchByCat" class="form-control form-control-sm" required>
                                                    <option value="">-- Select Category --</option>

                                                    <option value="challan_no">Challan No</option>
                                                    <option value="total_quantity">Quantity</option>
                                                    <option value="total_pcs">Total PCS</option>
                                                    <option value="total_tc">Total TC</option>


                                                </select>
                                            </div>
                                            <div class="col-2">

                                                <input type="text" name="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                                            </div>
                                            <input type="hidden" name="type" value="tc"><input type="hidden" name="search" value="simple">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                            <button type="submit" name="search" value="simple" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
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
                                    <form action="<?php echo base_url('/admin/FRC/filter'); ?>" method="post">
                                        <table class=" remove_datatable">
                                            <caption>Advance Filter</caption>
                                            <thead>
                                                <tr>
                                                    <th>Date_from</th>
                                                    <th>Date_to</th>
                                                    <th>Challan No</th>
                                                    <th>Quantity</th>
                                                    <th>Total PCS</th>
                                                    <th>Total TC</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>
                                                    <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                                                <td>
                                                    <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>
                                                <td><input type="text" name="challan_no" class="form-control form-control-sm" value="" placeholder="Challan No">
                                                </td>

                                                <td><input type="text" name="total_quantity" class="form-control form-control-sm" value="" placeholder="Total Quantity">
                                                </td>

                                                <td>
                                                    <input type="text" name="total_pcs" class="form-control form-control-sm" value="" placeholder="Total pcs">
                                                </td>

                                                <td>
                                                    <input type="text" name="total_tc" class="form-control form-control-sm" value="" placeholder="total tc"></td>

                                            </tr>

                                        </table>
                                        <input type="hidden" name="type" value="tc"><input type="hidden" name="search" value="advance">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                        <button type="submit" name="search" value="advance" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>


        <!-- **************** Product List *****************  -->
        <div class="col-md-12 bg-white">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TC Challan Receive List</h4>
                    <hr>

                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <div class="row well">
                                <div class="col-6"> &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a type="button" class="btn btn-info   btn-success" href='<?php echo base_url('/admin/FRC/show_tc'); ?>' style="color:#fff;">Clear filter</a>
                                </div>
                                <div class="col-6">

                                    <form action="<?php echo base_url('/admin/FRC/show_tc'); ?>" method="post">

                                        <div class="form-row ">
                                            <div class="col-5">
                                                <label>Date From</label>
                                                <input type="date" name="date_from" class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>">
                                            </div>
                                            <div class="col-5">
                                                <label>Date To</label>
                                                <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                            <div class="col-2">
                                                <label>Search</label>
                                                <input type="hidden" name="type" value="recieve">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                                <button type="submit" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>



                            <table class="table table-bordered data-table text-center " id="frc">

                                <thead class="bg-dark text-white">
                                    <tr class="odd" role="row">
                                        <th><input type="checkbox" class="sub_chk" id="master"></th>
                                        <th>Date</th>

                                        <th>Month</th>

                                        <th>View</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($stock as $value) { ?>
                                        <tr class="gradeU" id="tr_<?php echo $value['id'] ?>">

                                            <td><input type="checkbox" class="sub_chk hover" data-id="<?php echo $value['id'] ?> "> </td>
                                            <td><?php $date = date_create($value['date']);
                                                echo date_format($date, "d-m-y "); ?>
                                            </td>


                                            <td><?php $date = date_create($value['date']);
                                                $month= date_format($date, "m");
                                               echo date('F', mktime(0, 0, 0, $month, 10));?></td>

                                            <td>

                                                <a href="<?php echo base_url('admin/stock/view_stock_list/') . $value['id'] ?> ">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                            </td>

                                        </tr>

                                    <?php $c = $c + 1;
                                    } ?>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


  