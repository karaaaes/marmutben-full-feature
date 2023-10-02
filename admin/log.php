<?php
  include('template/sidebar.php');
  include_once('core/core_functions.php');
  
  $firstDate = "";
  $lastDate = "";
  $firstDateValue = "";
  $lastDateValue = "";

  if(isset($_GET['first']) && isset($_GET['last'])){
    $firstDate = str_replace("%"," ", $_GET['first']);
    $lastDate = str_replace("%"," ", $_GET['last']); 

    $explodeFirstDate = explode("%", $_GET['first']);
    $firstDateValue = $explodeFirstDate[0];
    $firstDateValue = date("Y-m-d", strtotime($firstDateValue));

    $exportLastDate = explode("%", $_GET['last']);
    $lastDateValue = $exportLastDate[0];
    $lastDateValue = date("Y-m-d", strtotime($lastDateValue));
  }

  $dataLog = getLog($firstDate, $lastDate);
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
              <div class="row">
                <form class="mb-3" action="core/core_functions.php" method="POST" enctype="multipart/form-data" style="width: 100%;">
                  <div class="range-date" style="display:flex !important;">
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom: 0;">
                        <label for="exampleInputEmail1">First Date</label>
                        <div class="input-group">
                          <input type="date" name="first_date" class="form-control" placeholder="Date" value="<?= $firstDateValue ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom: 0;">
                        <label for="exampleInputEmail1">Last Date</label>
                        <div class="input-group">
                          <input type="date" name="last_date" class="form-control" placeholder="Date" value="<?= $lastDateValue ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                        <button type="submit" name="submitFilter" class="btn btn-primary mt-2">Filter</button>
                  </div>
                </form>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Menu</th>
                    <th>Item</th>
                    <th>Log</th>
                    <th>Timestamp</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $i = 0;
                      foreach($dataLog as $data) :
                        $i += 1;
                    ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data['type']; ?></td>
                    <td><?= $data['menu']; ?></td>
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
                    <th>Menu</th>
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