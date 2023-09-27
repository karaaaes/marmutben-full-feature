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
          <h1>Form Add Promo</h1>
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
              <h3 class="card-title">Form Form Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Promo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-stream"></i>
                      </span>
                    </div>
                    <input type="text" name="nama_promo" class="form-control" placeholder="Nama Promo" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Promo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-stream"></i>
                      </span>
                    </div>
                    <input type="text" name="kode_promo" class="form-control" placeholder="Kode Promo" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah Promo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                      </span>
                    </div>
                    <input type="number" name="jumlah_promo" class="form-control" placeholder="Jumlah Potongan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea name="description" id="summernote" required></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Image Promo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image_promo" class="custom-file-input" id="exampleInputFile" required>
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Expired At</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-thumbtack"></i>
                      </span>
                    </div>
                    <input type="date" name="expired_at" class="form-control" required>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="addPromo" class="btn btn-primary">Submit</button>
              </div>
            </form>
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