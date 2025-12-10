<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>
<?php
$cid = $_GET['cid']; 
 
$query="SELECT * FROM customer WHERE cid = $cid ";
$view_users= mysqli_query($link,$query);

$row = mysqli_fetch_assoc($view_users)

//$cname = $row['cname'];        
//$cnumber = $row['cnumber'];         
//$ccity = $row['ccity'];


?>
<?php

if (isset ($_POST['Submit']))
{
$cname = $_POST['cname'];
$cnumber = $_POST['cnumber'];
$ccity = $_POST['ccity'];

$result = mysqli_query($link,"UPDATE customer SET cname = '{$cname}' , cnumber = '{$cnumber}' , ccity = '{$ccity}' WHERE cid = $cid");

mysqli_close($link);
header ("location: viewcustomer.php");
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
            <h1>Customer Edit Form</h1>
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
                    <label for="Name">Customer Name</label>
                    <input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['cname'];?>"
                    oninput="this.value = this.value.toUpperCase();">
                  </div>
                  <div class="form-group">
                    <label for="mobileNumber">Mobile</label>
                    <input 
                    type="tel"
                     class="form-control"
                      id="cnumber"
                       name="cnumber" 
                       placeholder="9228302801"
                       pattern="[0-9]{10}" 
                      maxlength="10" 
                      required 
                      aria-label="Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="ccity" name="ccity" value="<?php echo $row['ccity'];?>"
                    oninput="this.value = this.value.toUpperCase();">
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
