<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();

// Fetching the data from the database (assuming you want to fetch by service ID or another condition)
if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    $query = "SELECT * FROM service WHERE sid = '$sid'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $sname = $row['sname'];
        $snote = $row['snote'];
        $sdatetime = $row['sdatetime'];
        $sdelivername = $row['sdelivername'];
        $ssreq = $row['ssreq'];
        $sbikemake = $row['sbikemake'];
        $svehiclenumber = $row['svehiclenumber'];
    } else {
        echo "Service not found.";
        exit;
    }
} else {
    echo "No service ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Service Details</title>

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
            <h1>Service Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service Details</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Service Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">

                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="sdatetime">Date and Time</label>
                      <input type="text" class="form-control" value="<?php echo $sdatetime; ?>" disabled>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="svehiclenumber">Vehicle Number</label>
                      <input type="text" class="form-control" value="<?php echo $svehiclenumber; ?>" disabled>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="sname">Customer Name</label>
                      <input type="text" class="form-control" value="<?php echo $sname; ?>" disabled>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="sbikemake">Bike Make</label>
                      <input type="text" class="form-control" value="<?php echo $sbikemake; ?>" disabled>
                    </div>

                    <div class="form-group col-md-5">
                      <label for="ssreq">Service Required</label>
                      <input type="text" class="form-control" value="<?php echo $ssreq; ?>" disabled>
                    </div>

                    <div class="form-group col-md-7">
                      <label for="sdelivername">Drop Person Name</label>
                      <input type="text" class="form-control" value="<?php echo $sdelivername; ?>" disabled>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="snote">Note</label>
                      <input type="text" class="form-control" id="snote" name="snote" value="<?php echo $snote; ?>">
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                      <label for="snote">Pending</label>
                      <input type="text" class="form-control" id="snote" name="snote" value="<?php echo $snote; ?>">
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="row">
                    <div class="col-12">
                      <input type="submit" class="btn btn-primary btn-block" value="Update Note" name="UpdateNote">
                    </div>
                  </div>  
                </div>
              </form>

              <?php
              if (isset($_POST['UpdateNote'])) {
                  $updatedNote = $_POST['snote'];

                  // Update the note in the database
                  $updateQuery = "UPDATE service SET snote = '$updatedNote',status=1 WHERE sid = '$sid'";
                  if (mysqli_query($link, $updateQuery)) {
                      echo "<p style='color: green;'>Note updated successfully.</p>";
                  } else {
                      echo "<p style='color: red;'>Error updating note: " . mysqli_error($link) . "</p>";
                  }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
