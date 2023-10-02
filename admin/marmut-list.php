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
          <h1>Form Add Marmut</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form Marmut List</li>
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
              <h3 class="card-title">Form Form Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Marmut</th>
                    <th>Kategori</th>
                    <th>Image Marmut</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $dataMarmut = getListMarmut();
                    $i = 0;
                    foreach($dataMarmut as $data) :
                      $i += 1;
                      $harga = $data['harga']; // Angka yang ingin Anda format
                      $harga_terformat = number_format($harga, 0, ',', '.');
                  ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data['jenis_marmut']; ?></td>
                    <td><?= $data['categories']; ?></td>
                    <td>
                      <img src="<?= "../".$data['image_marmut']; ?>" height="100" width="200" alt="">
                    </td>
                    <td><?= "Rp. ".$harga_terformat; ?></td>
                    <td>5</td>
                    <td>
                      <a href="marmut-edit.php?id=<?= $data['id'];?>" class="btn btn-block bg-gradient-warning btn-xs">Edit</a>
                      <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                        <input name="id_marmut" value="<?= $data['id']; ?>" hidden>
                        <button type="submit" name="deleteMarmut" class="btn btn-block bg-gradient-danger btn-xs">Delete</button>
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
                    <th>Nama Marmut</th>
                    <th>Kategori</th>
                    <th>Image Marmut</th>
                    <th>Harga</th>
                    <th>Stok</th>
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
