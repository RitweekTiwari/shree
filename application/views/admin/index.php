<?php include('layout/css.php') ?>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
  <div class="lds-ripple">
    <div class="lds-pos"></div>
    <div class="lds-pos"></div>
  </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
  <!-- ============================================================== -->
  <!-- Topbar header - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header" data-logobg="skin5">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="<?php echo base_url('admin/dashboard') ?>">
          <!-- Logo icon -->
          <b class="logo-icon p-l-10">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img src="<?php echo base_url('optimum/admin') ?>/assets/images/shri1.png" alt="homepage" class="light-logo" />

          </b>
          <!--End Logo icon -->
          <!-- Logo text -->
          <span class="logo-text">
            <!-- dark Logo text -->
            <h2>ERP</h2>

          </span>
          <!-- Logo icon -->
          <!-- <b class="logo-icon"> -->
          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
          <!-- Dark Logo icon -->
          <!-- <img src="<?php echo base_url('optimum/admin') ?>/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

          <!-- </b> -->
          <!--End Logo icon -->
        </a>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-left mr-auto">
          <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
          <!-- ============================================================== -->
          <!-- create new -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="d-none d-md-block">Preferences <i class="fa fa-angle-down"></i></span>
              <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo base_url('admin/Setting'); ?>">Setting</a>


          </li>
          <!-- ============================================================== -->
          <!-- Search -->
          <!-- ============================================================== -->
          <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
            <form class="app-search position-absolute">
              <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
            </form>
          </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">
          <!-- ============================================================== -->
          <!-- Comment -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
            </a>

          </li>
          <!-- ============================================================== -->
          <!-- End Comment -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Messages -->
          <!-- ============================================================== -->

          <!-- ============================================================== -->
          <!-- End Messages -->
          <!-- ============================================================== -->

          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('optimum/admin') ?>/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated">
              <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
              <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
              <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url('admin/setting'); ?>"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
              <div class="dropdown-divider"></div>
              <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
            </div>
          </li>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- ============================================================== -->
  <!-- End Topbar header -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Left Sidebar - style you can find in sidebar.scss  -->
  <!-- ============================================================== -->
  <aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="p-t-30">
          <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard'); ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashbord</span></a></li>
          <li class="sidebar-item hideElement "> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
              <li class="sidebar-item"><a href="<?php echo base_url('admin/branch_detail'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Branch Detail </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/customer_detail'); ?>" class="sidebar-link"><i class="fas fa-users"></i><span class="hide-menu"> Customer Details </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/job_work_party'); ?>" class="sidebar-link"><i class="fas fa-briefcase"></i><span class="hide-menu"> Job Work Party </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/job_work_type'); ?>" class="sidebar-link"><i class="fas fa-briefcase"></i><span class="hide-menu"> Job Work Type </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/department'); ?>" class="sidebar-link"><i class="fas fa-shekel-sign"></i><span class="hide-menu"> Department </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/sub_department'); ?>" class="sidebar-link"><i class="fas fa-shekel-sign"></i><span class="hide-menu"> Godown </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/hsn'); ?>" class="sidebar-link"><i class="fas fa-barcode"></i><span class="hide-menu"> HSN </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/fabric'); ?>" class="sidebar-link"><i class="fab fa-deskpro"></i><span class="hide-menu"> Fabric </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/design'); ?>" class="sidebar-link"><i class=" fas fa-pencil-alt"></i><span class="hide-menu"> Design </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/ERC'); ?>" class="sidebar-link"><i class="fa-meetup"></i><span class="hide-menu"> ERC </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/SRC'); ?>" class="sidebar-link"><i class="fa fa-podcast"></i><span class="hide-menu"> SRC </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/EMB'); ?>" class="sidebar-link"><i class="fa fa-podcast"></i><span class="hide-menu"> EMBJWR </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Cause'); ?>" class="sidebar-link"> <i class="fab fa-uniregistry"></i><span class="hide-menu"> Cause</span></a></li>

              <li class="sidebar-item"><a href="<?php echo base_url('admin/session_year'); ?>" class="sidebar-link"> <i class="fas fa-calendar"></i><span class="hide-menu"> Session</span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Order_type'); ?>" class="sidebar-link"> <i class="fab fa-first-order"></i><span class="hide-menu"> Order Type</span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Data_category'); ?>" class="sidebar-link"> <i class="fas fa-certificate"></i><span class="hide-menu"> Data Category</span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Unit'); ?>" class="sidebar-link"> <i class="fab fa-uniregistry"></i><span class="hide-menu"> Unit</span></a></li>
            </ul>
          </li>
          <li class="sidebar-item hideElement "> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Godown </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
              <?php foreach ($godown as $row) { ?>
                <li class="sidebar-item"><a href="<?php echo base_url('admin/transaction/home/') . $row->id; ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> <?php echo  $row->subDeptName; ?> </span></a></li>
              <?php } ?>
            </ul>
          </li>
          <li class="sidebar-item hideElement"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Orders/dashboard'); ?>" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Order</span></a></li>
          <li class="sidebar-item "> <a class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-store"></i><span class="hide-menu">FRC</span></a>
            <ul aria-expanded="false" class="collapse  first-level">
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/showRecieve'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Add Recieve Challan </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/showRecieveList'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Recieve Challan List </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Add Return Challan </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/showReturnList'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Return Challan List </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/AddPBC'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu">ADD 2nd PBC </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/Show_PBC'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> 2nd PBC List </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/add_tc_list'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> TC ADD </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/show_tc'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> TC List </span></a></li>

              <li class="sidebar-item"><a href="<?php echo base_url('admin/FRC/show_stock'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Stock of plain fabric </span></a></li>
            </ul>
          </li>
          <li class="sidebar-item "> <a class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"><i class="mdi mdi-border-color"></i><span class="hide-menu">Dye Transaction</span></a>
            <ul aria-expanded="false" class="collapse  first-level">
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Dye_transaction'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Add Issue Transaction </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Dye_transaction/showReturnList'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Issue Transaction List </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Dye_transaction/showRecieve'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Add Recieve Transaction </span></a></li>
              <li class="sidebar-item"><a href="<?php echo base_url('admin/Dye_transaction/showRecieveList'); ?>" class="sidebar-link"><i class="fas fa-code-branch"></i><span class="hide-menu"> Recieve Transaction List </span></a></li>

            </ul>
          </li>
          <li class="sidebar-item hideElement"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Dashboard/print_barcode'); ?>" aria-expanded="false"><i class="mdi mdi-printer"></i><span class="hide-menu">Barcode Printing
              </span></a></li>
          <li class="sidebar-item hideElement"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/FDA'); ?>" aria-expanded="false"><i class="mdi mdi-forward"></i><span class="hide-menu">Fabric Design
                Assign</span></a></li>

          <li class="sidebar-item hideElement"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/Setting'); ?>" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Setting</span></a></li>

        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!-- ============================================================== -->
  <!-- End Left Sidebar - style you can find in sidebar.scss  -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Page wrapper  -->
  <!-- ============================================================== -->
  <div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title"><?php echo isset($page_name) ? $page_name : 'Dashbord';  ?></h4>
          <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo isset($page_name) ? $page_name : ''; ?></li>
              </ol>
            </nav>
          </div><br><br><br>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <?php echo $main_content; ?>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
      All Rights Reserved by Shree ERP. Designed and Developed by <a href="https://rectorsol.com">rectorsol</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Page wrapper  -->
  <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->

<?php include('layout/footer.php') ?>