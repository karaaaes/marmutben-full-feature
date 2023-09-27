<?php
  include('template/sidebar.php');
  include('core/core_functions.php');

  $dataPromo = getListPromoSection();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Form Promo List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form Promo List</li>
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
              <h3 class="card-title">List Promo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <a href="promo-add.php" class="btn btn-primary bg-gradient-primary mb-3">Tambah Promo</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Promo</th>
                    <th>Image Promo</th>
                    <th>Kode Promo</th>
                    <th>Jumlah Promo</th>
                    <th>Expired Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 0;
                      foreach($dataPromo as $promo) : 
                        $i += 1;
                    ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $promo['nama_promo']; ?></td>
                    <td><img src="../<?= $promo['image_promo']; ?>" height="100" width="200" alt="image_promo"/></td>
                    <td><?= $promo['kode_promo']; ?></td>
                    <td><?= $promo['jumlah_promo']; ?></td>
                    <td><?= $promo['expired_at']; ?></td>
                    <td>
                      <a href="promo-edit.php?id=<?= $promo['id']; ?>" class="btn btn-block bg-gradient-warning btn-xs">Edit</a>
                      <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                        <input name="id_promo" value="<?= $promo['id']; ?>" hidden>
                        <button type="submit" name="deletePromo" class="btn btn-block bg-gradient-danger btn-xs">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                    endforeach;
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Promo</th>
                    <th>Image Promo</th>
                    <th>Kode Promo</th>
                    <th>Jumlah Promo</th>
                    <th>Expired Date</th>
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

