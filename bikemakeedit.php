<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>
<?php
$bid = $_GET['bid']; 
 
$query="SELECT * FROM bikemakemaster WHERE bid = $bid ";
$view_users= mysqli_query($link,$query);

$row = mysqli_fetch_assoc($view_users)

?>
<?php

if (isset ($_POST['Submit']))
{

$bname = $_POST['bname'];
$bikemake = $_POST['bikemake'];

$result = mysqli_query($link,"UPDATE bikemakemaster SET bikemake = '{$bikemake}' WHERE bid = $bid");

mysqli_close($link);
header ("location: viewbikemake.php");
} 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Customer Form </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

  <?php
  include("aside.php");
  include("nav.php");
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer General Form</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                 <h3 class="card-title">Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label for="bikeMake">Bike Make</label>
                        <select class="form-control" id="bikemake" name="bikemake">
                        <option value="">Select Bike Make</option>
    <option value="Aprilia">Aprilia</option>
    <option value="Benelli">Benelli</option>
    <option value="BMW Motorrad">BMW Motorrad</option>
    <option value="Ducati">Ducati</option>
    <option value="Harley Davidson">Harley Davidson</option>
    <option value="Honda">Honda</option>
    <option value="Indian Motorcycle">Indian Motorcycle</option>
    <option value="Kawasaki">Kawasaki</option>
    <option value="KTM">KTM</option>
    <option value="Mahindra">Mahindra</option>
    <option value="Moto Guzzi">Moto Guzzi</option>
    <option value="Royal Enfield">Royal Enfield</option>
    <option value="Suzuki">Suzuki</option>
    <option value="Triumph">Triumph</option>
    <option value="TVS">TVS</option>
    <option value="Vespa">Vespa</option>
    <option value="Yamaha">Yamaha</option>
                        </select>
                      </div>

                <div class="row">
              <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Submit" name="Submit">
          </div>
        </div>
            </div>
                </div>
                  </div>
                  <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            </div>
            </div>
            </div>
                  <div class="row">
                    <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-6">
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
