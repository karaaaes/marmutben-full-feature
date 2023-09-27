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
          <h1>Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Form General Settings</li>
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
                  <label for="exampleInputEmail1">Email Notifications</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-stream"></i>
                      </span>
                    </div>
                    <input type="email" name="email_notifications" class="form-control" id="email_notifications" 
                      placeholder="Notifications Email Disini" required>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="add_config" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->


          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">List of Config</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table" border="1">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Type</th>
                    <th scope="col">Value</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $dataConfig = getListConfig();
                    $i = 1;
                    foreach ($dataConfig as $data) :
                  ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $data['type']; ?></td>
                    <td><?= $data['value']; ?></td>
                    <input type="text" value="<?= $data['value'];?>" id="email_value" hidden>
                    <td>
                      <button href="" class="btn btn-warning" id="edit_email" onclick="MoveEmailScript();">Edit</button>
                    </td>
                  </tr>
                  <?php 
                    $i += 1;
                    endforeach
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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

<script>
  function MoveEmailScript() {
    var email = document.getElementById("email_value").value;
    document.getElementById("email_notifications").value = email;
}

</script>