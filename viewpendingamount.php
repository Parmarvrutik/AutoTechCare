<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
// Correct SQL query without an incomplete WHERE clause
$result = mysqli_query($link, "SELECT pdeliver.sdatetime, pdeliver.pamount, pdeliver.sname, pdeliver.sid, pendingamounttracker.pdebit, pendingamounttracker.pcredit, pendingamounttracker.pending FROM pdeliver LEFT JOIN pendingamounttracker ON pdeliver.sid = pendingamounttracker.sid WHERE pendingamounttracker.pending > 0 ORDER BY pdeliver.sid");
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
            <h1>Pending Amount Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pending Amount DataTables</li>
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
                <h3 class="card-title">Pending Amount Records</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Date & Time</th>
                      <th>BillNo</th>
                      <th>Customer Name</th>
                      <th>Amount</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Pending</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) { ?>
                    <tr>
                      <td><?php echo $row['sdatetime']; ?></td>
                      <td><?php echo $row['sid']; ?></td>
                      <td><?php echo $row['sname']; ?></td>
                      <td><?php echo $row['pamount']; ?></td>
                      <td><?php echo $row['pdebit']; ?></td>
                      <td><?php echo $row['pcredit']; ?></td>
                      <td><?php echo $row['pending']; ?></td>
                      <td><a href="paymentedit.php?sid=<?php echo $row['sid'];?>"class="btn btn-success btn-sm">Edit</a></td> <!-- Edit Link -->
                      <td><a href="paymentdelete.php?sid=<?php echo $row['sid'];?>"class="btn btn-danger btn-sm">Delete</a></td>
                      </td>
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

<script>
  $(document).ready(function () {
    $('#example1').DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    });
  });
</script>

</body>
</html>
