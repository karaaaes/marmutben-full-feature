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
          <h1>Form Marmut List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form Paket List</li>
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
              <h3 class="card-title">List Paket</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="row">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3 mr-2" data-toggle="modal" data-target="#exampleModal">
                  Import Paket
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Data Paket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mt-3">
                        <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                          <input type="file" name="importFilePaket" class="btn btn-success mb-3 mr-2"
                            value="Import CSV" accept=".csv" />
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="importPaket" class="btn btn-danger">Import</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                  <button type="submit" name="deleteAllPaket" class="btn btn-danger mb-3">Delete All</button>
                </form>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Anakan</th>
                    <th>Remaja</th>
                    <th>Induk Jantan</th>
                    <th>Induk Buntingan</th>
                    <th>Grosir</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $dataPaket = getListPromo();
                      $i = 0;
                      foreach($dataPaket as $paket) :
                        $i += 1;
                    ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $paket['jenis']; ?></td>
                    <td><?= "Rp. " . $paket['anakan']; ?></td>
                    <td><?= "Rp. " . $paket['remaja']; ?></td>
                    <td><?= "Rp. " . $paket['induk_jantan']; ?></td>
                    <td><?= "Rp. " . $paket['induk_buntingan']; ?></td>
                    <td><?= "Rp. " . $paket['grosir']; ?></td>
                    <td>
                      <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="id_paket" value="<?= $paket['id']; ?>" hidden/>
                        <button type="submit" name="deletePaket"
                          class="btn btn-block bg-gradient-danger btn-xs">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                    endforeach
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Anakan</th>
                    <th>Remaja</th>
                    <th>Induk Jantan</th>
                    <th>Induk Buntingan</th>
                    <th>Grosir</th>
                    <th>Action</th>
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