<?php
  include('template/sidebar.php');
  include('core/core_functions.php');

  $dataMarmutCategories = countMarmutCategories();
  $categoryNames = ['Anakan', 'Remaja', 'Indukan', 'Bunting', 'Indukan Hias', 'Buntingan Hias'];

  $countCategories = [];

  foreach ($categoryNames as $index => $categoryName) {
    $countCategories[$categoryName] = isset($dataMarmutCategories[$index]['categories_marmut']) ? $dataMarmutCategories[$index]['categories_marmut'] : 0;
  }

  $dataHitCategories = getDataHit();
  $totalHits = [];

  foreach ($categoryNames as $index => $categoryName) {
    $totalHits[$categoryName] = $dataHitCategories[$index]['hit'];
  }

// Sekarang Anda memiliki $countCategories['Anakan'], $countCategories['Remaja'], dst.

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><strong>Dashboard</strong></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Anakan</span>
              <span class="info-box-number">
                <?= $countCategories['Anakan']; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Remaja</span>
              <span class="info-box-number">
                <?= $countCategories['Remaja']; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Indukan</span>
              <span class="info-box-number">
                <?= $countCategories['Indukan']; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Bunting</span>
              <span class="info-box-number"><?= $countCategories['Bunting'] ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Indukan Hias</span>
              <span class="info-box-number"><?= $countCategories['Indukan Hias']; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-2">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Bunting Hias</span>
              <span class="info-box-number"><?= $countCategories['Buntingan Hias']; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"><strong>Interaction (Total View on Front Page)</strong></h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Interaction Click Marmutben</strong>
                  </p>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->

                <div class="col-md-12">
                  <div class="progress-group">
                    Anakan
                    <span class="float-right"><?= $totalHits['Anakan']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Remaja
                    <span class="float-right"><?= $totalHits['Remaja']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 100%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Indukan</span>
                    <span class="float-right"><?= $totalHits['Indukan']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Bunting
                    <span class="float-right"><?= $totalHits['Bunting']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-info" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Indukan Hias
                    <span class="float-right"><?= $totalHits['Indukan Hias']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Bunting Hias
                    <span class="float-right"><?= $totalHits['Buntingan Hias']; ?></span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <!-- PRODUCT LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Recently Activity</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php 
                  $dataLog = getAllLog();
                  foreach($dataLog as $data) : 
                    if($data['type'] == 'INSERT'){
                      $badge = "badge-success";
                    }else if($data['type'] == 'UPDATE'){
                      $badge = "badge-warning";
                    }else{
                      $badge = "badge-danger";
                    }
                ?>
                <li class="item">
                  <div class="product-info" style="margin-left: 20px;">
                    <a href="#" class="product-title"><?= $data['item'] ?>
                      <span class="badge <?= $badge; ?> float-right"><?= $data['type'] ?></span>
                    </a>
                    <span class="product-description">
                      <?= $data['log'] ?>
                        <span class="timestamp float-right"><?= $data['timestamp'] ?></span>
                    </span>
                  </div>
                </li>
                <?php 
                  endforeach
                ?>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="log.php" class="uppercase">View All Log</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>

</html>