<?php
  include('template/sidebar.php');
  include('core/core_functions.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Form Ongkir List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form Ongkir List</li>
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
              <h3 class="card-title">List Ongkir</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="row">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3 mr-2" data-toggle="modal" data-target="#exampleModal">
                  Import Ongkir
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Data Ongkir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mt-3">
                        <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                          <input type="file" name="importFileOngkir" class="btn btn-success mb-3 mr-2" value="Import CSV" accept=".csv" />
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="importOngkir" class="btn btn-danger">Import</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                  <button type="submit" name="deleteAllOngkir" class="btn btn-danger mb-3">Delete All</button>
                </form>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Wilayah Kecil</th>
                    <th>Ongkir COD</th>
                    <th>Ongkir Ojol</th>
                    <th>Ongkir KA Logistik</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $dataOngkir = getListOngkir();
                    $i = 0;
                    foreach($dataOngkir as $ongkir) :
                      $i +=1;
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $ongkir['wilayah']; ?></td>
                    <td><?= $ongkir['wilayah_kecil']; ?></td>
                    <td><?= $ongkir['ongkir_cod']; ?></td>
                    <td><?= $ongkir['ongkir_ojol']; ?></td>
                    <td><?= $ongkir['ongkir_ka_logistik']; ?></td>
                  </tr>
                  <?php
                  endforeach
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Wilayah Kecil</th>
                    <th>Ongkir COD</th>
                    <th>Ongkir Ojol</th>
                    <th>Ongkir KA Logistik</th>

                  </tr>
                </tfoot>
              </table>
            </div>
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