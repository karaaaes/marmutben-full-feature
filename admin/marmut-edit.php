<?php
  include('template/sidebar.php');
  include('core/core_functions.php');

  $idMarmut = $_GET['id'];
  $getMarmut = checkMarmut($idMarmut);
  if (empty($getMarmut)) {
    echo '<script>alert("Marmut tidak ada di database");</script>';
    echo '<script>window.location.href = "marmut-list.php";</script>';
  }
  $getCategories = getCategories($getMarmut[0]['categories_marmut']);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Form Edit Marmut</h1>
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
            <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
              <input type="text" name="id_marmut" class="form-control" value="<?= $getMarmut[0]['id'] ?>" hidden>
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Marmut</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-stream"></i>
                      </span>
                    </div>
                    <input type="text" name="jenis_marmut" class="form-control" value="<?= $getMarmut[0]['jenis_marmut'] ?>" placeholder="Jenis Marmut">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga Marmut</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                      </span>
                    </div>
                    <input type="number" name="harga_marmut" class="form-control" value="<?= $getMarmut[0]['harga']; ?>" placeholder="Harga">
                  </div>
                </div>
                <div class="form-group">
                  <label>Kategori Marmut</label>
                  <select class="form-control" name="categories_marmut">
                    <option value="<?= $getMarmut[0]['categories_marmut'];?>" selected><?= $getMarmut[0]['categories']; ?></option>
                    <?php 
                    foreach($getCategories as $categories) : 
                    ?>
                    <option value="<?= $categories['id']; ?>"><?= $categories['categories']; ?></option>
                    <?php 
                    endforeach
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea id="summernote" name="description"><?= $getMarmut[0]['description']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload Image Marmut</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image_marmut" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="editMarmut" class="btn btn-primary">Submit</button>
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
