<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
$result = mysqli_query($link,"SELECT * FROM service where status=1 ORDER BY sid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Customer DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php
    include("aside.php");
    include("nav.php");
  ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 style="color: green;">Services Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ServicesDataTables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Service Records</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Customer Name</th>
                      <th>Bike Make</th>
                      <th>Service Required</th>
                      <th>Date & Time</th>
                      <th>Note</th>
                      <th>Deliver Name</th>
                      <th>Vehiclenumber</th>
                      <th>Delivery</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){ ?>
                    <tr>
                      <td><?php echo $row['sid'];?></td>
                      <td><?php echo $row['sname'];?></td> <!-- Display Customer Name -->
                      <td><?php echo $row['sbikemake'];?></td>
                      <td><?php echo $row['ssreq'];?></td>
                      <td><?php echo $row['sdatetime'];?></td>
                      <td><?php echo $row['snote'];?></td>
                      <td><?php echo $row['sdelivername'];?></td>
                      <td><?php echo $row['svehiclenumber'];?></td>
                      <td><a href="deliverform.php?sid=<?php echo $row['sid'];?>"style="color: red;">Delivery</a></td> <!-- Pending Link -->
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
