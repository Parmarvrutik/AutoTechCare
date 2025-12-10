<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>
<?php

if (isset ($_POST['Submit']))
{
  $bikemake = mysqli_real_escape_string($link, $_POST['bikemake']);
  // fetch mobile
  $result1 = mysqli_query($link,"Select * From bikemakemaster where bikemake='$bikemake'");
  if(mysqli_num_rows($result1)>0)
  {
    $message = "Duplicate entry";
  }
  else
  {
    $result = mysqli_query($link,"Insert into bikemakemaster(bikemake) values('$bikemake')");
    mysqli_close($link);
    header ("location: viewbikemake.php");
   }  

}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Bike Make Master Form </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
            <h1>Bike Make General Form</h1>
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
                <h3 class="card-title">Bike Make Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                <div class="card-body">
                <div class="form-group">
                    <label for="bikemake">Bike Make <span style="color: red;">*</span></label>
                    <input 
                    type="text" 
                    class="form-control" 
                    id="bikemake" 
                    name="bikemake" 
                    placeholder="Enter Your Bike Make"
                    oninput="this.value = this.value.toUpperCase();" 
                    required 
                    pattern="[A-Za-z]+">
                  </div>

                  
                <div class="row">
              <div class="col-12">
                <br><?php if (!empty($message)) { echo "<p style='color:red;'>$message</p>"; } ?><br>
            <input type="submit" class="btn btn-primary btn-block" value="Submit" name="Submit">
          </div>
        </div>  
                  <div class="row">
                    <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-6">
              <!-- /.card-body -->
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