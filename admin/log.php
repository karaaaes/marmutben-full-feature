<?php
  include('template/sidebar.php');
  include_once('core/core_functions.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Log List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Log List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12 mb-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Log List</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Log</th>
                    <th>Timestamp</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $dataLog = getLog();
                      $i = 0;
                      foreach($dataLog as $data) :
                        $i += 1;
                    ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data['type']; ?></td>
                    <td><?= $data['item']; ?></td>
                    <td><?= $data['log']; ?></td>
                    <td><?= $data['timestamp']; ?></td>
                  </tr>
                  <?php 
                    endforeach
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Log</th>
                    <th>Timestamp</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include('template/footer.php');
?>