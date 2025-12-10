<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AUTOTECHCARE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <!-- Dashboard -->
    <li class="nav-item menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Customer Master -->
    <li class="nav-item">
      <a href="pages/widgets.html" class="nav-link active">
        <i class="nav-icon fas fa-th"></i>
        <p>Customer Master
          <i class="right fas fa-angle-left"></i>
          <span class="right badge badge-danger"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="customerform.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>New</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="viewcustomer.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Details</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Services -->
    <li class="nav-item" style="margin-bottom: 50px;">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-copy"></i>
        <p>Services
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">         
        <li class="nav-item">
          <a href="servicesform.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>New Work Job</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="viewservicesform.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Pending View</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="viewservicesdone.php" class="nav-link" style="background-color: green; color: white; border-radius: 5px; padding: 10px 15px;">
            <i class="far fa-circle nav-icon"></i>
            <p>Job Done</p>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a href="viewdeliver.php" class="nav-link" style="background-color: green; color: white; border-radius: 5px; padding: 10px 15px;">
            <i class="far fa-circle nav-icon"></i>
            <p>View Deliverd</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Pending Deliver -->
    <!-- <li class="nav-item">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-copy"></i>
        <p>Pending Deliver
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right" style="margin-top: 10px;"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="deliverform.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Pending Bike Deliver</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="viewdeliver.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Work Job</p>
          </a>
        </li>
      </ul>
    </li> -->

    <!-- Bike Make Master -->
    <li class="nav-item">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-copy"></i>
        <p>Bike Make Master
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="bikemakeform.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Make</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="viewbikemake.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>View Make</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a href="viewpendingamount.php" class="nav-link active">
        <i class="nav-icon fas fa-copy"></i>
        <p>Payment
          <i class="fas fa-angle-left right"></i>
          <span class="badge badge-info right"></span>
        </p>
      </a>
     

    <li class="nav-item">
      <a href="invoicereport.php" class="nav-link active">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Report</p>
      </a>
    </li>

    <!-- Change Password -->
    <li class="nav-item">
      <a href="changepassword.php" class="nav-link active">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Change Password</p>
      </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
      <a href="logout.php" class="nav-link active">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
    </li>

  </ul>
</nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>