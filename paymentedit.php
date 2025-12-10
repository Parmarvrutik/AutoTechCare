<?php
session_start(); 
include("connection.php");
include("comman.php");
checklogin();

// Fetching sid from the URL
$sid2 = $_GET['sid'];
$query = "SELECT pdeliver.sname, pdeliver.pamount, pdeliver.sdatetime, pendingamounttracker.pdebit, pendingamounttracker.pcredit 
          FROM pdeliver LEFT JOIN pendingamounttracker ON pdeliver.sid = pendingamounttracker.sid 
          WHERE pdeliver.sid = '$sid2'";

$result = mysqli_query($link, $query);

// Check if record is found
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Populate variables with fetched data
    $pname = $row['sname'];
    $amount = $row['pamount'];
    $sdatetime = $row['sdatetime'];
    $pdebit = $row['pdebit'];
    $pcredit = $row['pcredit'];

    // Calculate the adjusted amount (pamount - pdebit + pcredit)
    $adjusted_amount = $amount - $pdebit + $pcredit;
    $pending_amount = $adjusted_amount; // This will be the pending amount after debit and credit
} else {
    // Handle the case where no record is found
    die("Record not found");
}

// INSERT new data for pending amount tracker (for credit)
if (isset($_POST['Submit'])) {
    // Collect form data
    $sname = $_POST['sname'];
    $pamount = $_POST['pamount']; // Amount from the form (not to be modified)
    $pdebit = $_POST['pdebit'];
    $pcredit = $_POST['pcredit'];
    $sdatetime = $_POST['sdatetime'];
    $sid = $_POST['sid'];
    $pending = $_POST['pending'];

    // Adjusting the amount after debit and credit
    $adjusted_payment = $pamount - $pdebit + $pcredit; // Adjust the pamount by subtracting pdebit and adding pcredit

    // Insert the new record for pending amount with the adjusted payment
    $insert_query = "INSERT INTO pendingamounttracker(sname, pamount, pdebit, pcredit, pending, sdatetime, sid) 
                     VALUES('$sname', '$adjusted_payment', '$pdebit', '$pcredit', '$pending', '$sdatetime', '$sid')";
    if (!mysqli_query($link, $insert_query)) {
        die("Error inserting pending amount record: " . mysqli_error($link));
    }

    // Redirect back to the view page
    mysqli_close($link);
    header("Location: viewpendingamount.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Edit Payment Form</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
            <h1>Edit Payment Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment Form</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Payment Details</h3>
              </div>
              <form method="post" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="sdatetime">Date and Time</label>
                      <input type="text" class="form-control" id="sdatetime" name="sdatetime" value="<?php echo $sdatetime; ?>" readonly>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="sid">BillNo</label>
                      <input type="text" class="form-control" id="sid" name="sid" value="<?php echo $sid2; ?>" readonly>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="sname">Name</label>
                      <input type="text" class="form-control" id="sname" name="sname" value="<?php echo htmlspecialchars($pname); ?>" readonly>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="pamount">Amount</label>
                      <input type="text" class="form-control" id="pamount" name="pamount" value="<?php echo $amount; ?>" readonly>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="pdebit">Debit</label>
                      <input type="text" class="form-control" id="pdebit" name="pdebit" value="<?php echo $pdebit; ?>">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="pcredit">Credit</label>
                      <input type="text" class="form-control" id="pcredit" name="pcredit" value="<?php echo $pcredit; ?>">
                    </div>

                    <!-- New field to show adjusted amount -->
                    <div class="form-group col-md-4">
                      <label for="pending">Pending Amount</label>
                      <input type="text" class="form-control" id="pending" name="pending" value="<?php echo isset($pending_amount) ? number_format($pending_amount, 2) : ''; ?>" readonly>
                    </div>
                  </div>     
                </div>

                <div class="row">
                  <div class="col-12">
                    <?php if (!empty($message)) { echo "<p style='color:red;'>$message</p>"; } ?>
                    <input type="submit" class="btn btn-primary btn-block" value="Submit" name="Submit">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
$(document).ready(function() {
    function calculateAdjustedAmount() {
        var pamount = parseFloat($('#pamount').val()) || 0;
        var pdebit = parseFloat($('#pdebit').val()) || 0;
        var pcredit = parseFloat($('#pcredit').val()) || 0;

        var adjustedAmount = pamount - pdebit + pcredit;
        $('#pending').val(adjustedAmount.toFixed(2));
    }

    $('#pdebit, #pcredit').on('input', function() {
        calculateAdjustedAmount();
    });

    calculateAdjustedAmount(); // Initial calculation
});
</script>
</body>
</html>
