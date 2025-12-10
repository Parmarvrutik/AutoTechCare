<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();

if (isset($_GET['sid'])) {
    // Get the service ID from the URL
    $sid = $_GET['sid'];
    
    // Fetch the service details using the provided SID
    $result = mysqli_query($link, "SELECT * FROM pdeliver WHERE sid = '$sid'");
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);

    // If no data found, show an error message
    if (!$row) {
        echo "No data found for this invoice.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AutoTechCare | Invoice</title>
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .invoice-card {
            width: 100%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-card .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f1f1f1;
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

        .details strong {
            font-weight: bold;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .invoice-table th, .invoice-table td {
            padding: 12px;
            border-bottom: 1px solid #f1f1f1;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f9fa;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            text-align: right;
            margin-top: 30px;
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
    </style>
</head>
<body>
<div class="wrapper">
<?php
    include("aside.php");
    include("nav.php");
  ?>
  <div class="content-wrapper">

<div class="invoice-card">
    <div class="header">
        <div class="logo">
            <img src="logo.png" alt="AutoTechCare Logo">
            <span class="invoice-title">AutoTechCare</span>
        </div>
        <div class="clinic-info">
            <strong>AutoTechCare</strong><br>
            A/3 Tribhuvan Building , Surat, Gujrat<br>
            (922) 830-2801 
        </div>
    </div>

    <div class="details">
        <p><strong>Invoice #:</strong> <?php echo $row['sid']; ?></p>
        <p><strong>Date:</strong> <?php echo $row['sdatetime']; ?></p>
        <p><strong>Customer Name:</strong> <?php echo $row['sname']; ?></p>
        <p><strong>Service:</strong> <?php echo $row['ssreq']; ?></p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Service Required</th>
                <th>Deliver Name</th>
                <th>Vehicle Number</th>
                <th>Deliver Person Name</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['sname']; ?></td>
                <td><?php echo $row['ssreq']; ?></td>
                <td><?php echo $row['sdelivername']; ?></td>
                <td><?php echo $row['svehiclenumber']; ?></td>
                <td><?php echo $row['pdelivername']; ?></td>
                <td><?php echo $row['pamount']; ?></td>
                <td><?php echo $row['sstatus']; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="total-amount">
        Total Amount: ₹<?php echo number_format($row['pamount'], 2); ?>
    </div>

    <div class="action-buttons">
        <button class="print-button" onclick="window.print()">Print Invoice</button>
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
