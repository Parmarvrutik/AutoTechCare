<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();

// Check if form is submitted with date range
$from_date = '';
$to_date = '';
$query = "SELECT * FROM pdeliver WHERE 1"; // Default query

if (isset($_POST['submit_date_range'])) {
    // Get the date range from the form
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    
    // Validate dates and modify the query
    if (!empty($from_date) && !empty($to_date)) {
        $query .= " AND sdatetime BETWEEN '$from_date' AND '$to_date'";
    }
}

$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoTechCare | Invoice Report</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        /* Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .invoice-card {
            width: 100%;
            max-width: 1000px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .clinic-info {
            text-align: right;
            font-size: 14px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }

        .details p {
            font-size: 16px;
            line-height: 1.6;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th, .invoice-table td {
            padding: 12px;
            border-bottom: 1px solid #007bff;
            text-align: left;
        }

        .invoice-table th {
            background-color: #007bff;
            color: white;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            text-align: right;
            margin-top: 20px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #218838;
        }

        .print-button {
            background-color: #007bff;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        .date-filter {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .date-filter input {
            padding: 10px;
            margin: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include("aside.php"); include("nav.php"); ?>
    <div class="content-wrapper">
        <!-- Date Filter -->
        <div class="date-filter">
            <form method="POST" action="">
                <input type="date" name="from_date" value="<?php echo $from_date; ?>" />
                <input type="date" name="to_date" value="<?php echo $to_date; ?>" />
                <button type="submit" name="submit_date_range">Filter</button>
            </form>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table id="example1" class="table invoice-table">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Deliver Name</th>
                        <th>Vehicle Number</th>
                        <th>Deliver Person Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?php echo $row['sid']; ?></td>
                            <td><?php echo $row['sdatetime']; ?></td>
                            <td><?php echo $row['sname']; ?></td>
                            <td><?php echo $row['ssreq']; ?></td>
                            <td><?php echo $row['sdelivername']; ?></td>
                            <td><?php echo $row['svehiclenumber']; ?></td>
                            <td><?php echo $row['pdelivername']; ?></td>
                            <td>₹<?php echo number_format($row['pamount'], 2); ?></td>
                            <td><?php echo $row['sstatus']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="invoice-card">
                <p>No data found for the selected date range.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
