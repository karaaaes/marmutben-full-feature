<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <?php 
  // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
  if($protocol == 'http://'){
    $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/';
  }else{
    $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/';
  }
  ?>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="http://localhost/marmutben/admin/index.php" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= $url; ?>" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Marmutben LTE</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/hitsugaya_profile_160x160.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open" id="dashboard">
              <!-- Tambahkan id="dashboard" di sini -->
              <a href="#" class="nav-link active" id="dashboard-link">
                <!-- Tambahkan id="dashboard-link" di sini -->
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link active" id="dashboard-tab">
                    <!-- Tambahkan id="dashboard-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="best-seller">
              <!-- Tambahkan id="best-seller" di sini -->
              <a href="#" class="nav-link" id="best-seller-link">
                <!-- Tambahkan id="best-seller-link" di sini -->
                <i class="nav-icon fas fa-sort-amount-up-alt"></i>
                <p>
                  Best Seller Widget
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./bestseller.php" class="nav-link" id="best-seller-tab">
                    <!-- Tambahkan id="best-seller-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Best Sellers</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="marmut-widget">
              <!-- Tambahkan id="marmut-widget" di sini -->
              <a href="#" class="nav-link" id="marmut-widget-link">
                <!-- Tambahkan id="marmut-widget-link" di sini -->
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Marmut Widget
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./marmut-list.php" class="nav-link" id="marmut-list-tab">
                    <!-- Tambahkan id="marmut-list-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marmut List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./marmut-add.php" class="nav-link" id="form-general-tab">
                    <!-- Tambahkan id="form-general-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Marmut</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="checker-widget">
              <!-- Tambahkan id="checker-widget" di sini -->
              <a href="#" class="nav-link" id="checker-widget-link">
                <!-- Tambahkan id "checker-widget-link" di sini -->
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Checker Widget
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./ongkir.php" class="nav-link" id="ongkir-tab">
                    <!-- Tambahkan id="ongkir-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ongkir</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./paket.php" class="nav-link" id="paket-tab">
                    <!-- Tambahkan id="paket-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Paket</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="promo-widget">
              <!-- Tambahkan id="promo-widget" di sini -->
              <a href="#" class="nav-link" id="promo-widget-link">
                <!-- Tambahkan id="promo-widget-link" di sini -->
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Promo Widget
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./promo.php" class="nav-link" id="promo-tab">
                    <!-- Tambahkan id="promo-tab" di sini -->
                    <i class="far fa-circle nav-icon"></i>
                    <p>Promo</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="logout">
              <!-- Tambahkan id="logout" di sini -->
              <a href="settings.php" class="nav-link" id="logout-link">
                <!-- Tambahkan id="logout-link" di sini -->
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Settings</p>
              </a>
            </li>
            <li class="nav-item" id="logout">
              <!-- Tambahkan id="logout" di sini -->
              <a href="iframe.html" class="nav-link" id="logout-link">
                <!-- Tambahkan id="logout-link" di sini -->
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Logout</p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>