<?php
session_start(); 
include("connection.php");
include("comman.php");
checklogin();

$sid2 = $_GET['sid'];
$query = "SELECT * FROM service WHERE sid = '$sid2'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
// Populate variables with fetched data
$sname = $row['sname'];
$sdelivername = $row['sdelivername'];
$ssreq = $row['ssreq'];
$svehiclenumber = $row['svehiclenumber'];
$snote = $row['snote'];
$sdatetime = $row['sdatetime'];
$sbikemake = $row['sbikemake'];
  
// INSERT 
if (isset($_POST['Submit'])) {
    // Collect form data
    $sname = $_POST['sname'];
    $sdelivername = $_POST['sdelivername'];
    $ssreq = $_POST['ssreq'];
    $svehiclenumber = $_POST['svehiclenumber'];
    $snote = $_POST['snote'];
    $sdatetime = $_POST['sdatetime'];
    $sbikemake = $_POST['sbikemake'];
    $pdatetime = $_POST['pdatetime'];
    $pdelivername = $_POST['pdelivername'];
    $pamount = $_POST['pamount'];

    // Check for duplicate entry
    $result1 = mysqli_query($link, "SELECT * FROM pdeliver WHERE sname='$sname' AND snote='$snote' AND sdatetime='$sdatetime' AND sdelivername='$sdelivername' AND ssreq='$ssreq' AND sbikemake='$sbikemake' AND svehiclenumber='$svehiclenumber' AND pdatetime='$pdatetime' AND pdelivername='$pdelivername' AND pamount='$pamount'");

    if (mysqli_num_rows($result1) > 0) {
        $message = "Duplicate entry detected.";
    } else {
        // Insert new service record
        $insert_query = "INSERT INTO pdeliver(sname, snote, sdatetime, sdelivername, ssreq, sbikemake, svehiclenumber, pdatetime, pdelivername, pamount) 
                         VALUES('$sname', '$snote', '$sdatetime', '$sdelivername', '$ssreq', '$sbikemake', '$svehiclenumber', '$pdatetime', '$pdelivername', '$pamount')";
        if (mysqli_query($link, $insert_query)) {
            mysqli_close($link);
            header("Location: viewdeliver.php");
            exit;
        } else {
            $message = "Error inserting record: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Customer Form</title>
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
            <h1>Customer General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer General Form</li>
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
                <h3 class="card-title">Customer Details</h3>
              </div>
              <form method="post" action="">
                <div class="card-body">
                  <div class="row">
                    <!-- Non-editable Fields (readonly) -->
                    <div class="form-group col-md-3">
                      <label for="sdatetime">Date and Time</label>
                      <input type="text" class="form-control" id="sdatetime" name="sdatetime" value="<?php echo $sdatetime; ?>" readonly>
                    </div>

                    <div class="form-group col-md-5">
                      <label for="ssreq">Service Required</label>
                      <input type="text" class="form-control" id="ssreq" name="ssreq" value="<?php echo $ssreq; ?>" readonly>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="sname">Customer Name</label>
                      <input type="text" class="form-control" id="sname" name="sname" value="<?php echo $sname; ?>" readonly>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="sbikemake">Bike Make</label>
                      <input type="text" class="form-control" id="sbikemake" name="sbikemake" value="<?php echo $sbikemake; ?>" readonly>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="svehiclenumber">Vehicle Number</label>
                      <input type="text" class="form-control" id="svehiclenumber" name="svehiclenumber" value="<?php echo $svehiclenumber; ?>" readonly>
                    </div>

                    <div class="form-group col-md-7">
                      <label for="sdelivername">Drop Person Name</label>
                      <input type="text" class="form-control" id="sdelivername" name="sdelivername" value="<?php echo $sdelivername; ?>" readonly>
                    </div>

                    <!-- Editable Fields (for Delivery) -->
                    <div class="form-group col-md-4">
                      <label for="pdatetime">Deliver Date and Time</label>
                      <input type="datetime-local" class="form-control" id="pdatetime" name="pdatetime" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="pdelivername">Deliver Person Name</label>
                      <input type="text" class="form-control" id="pdelivername" name="pdelivername" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="pamount">Amount</label>
                      <input type="text" class="form-control" id="pamount" name="pamount" required>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="snote">Note</label>
                      <input type="text" class="form-control" id="snote" name="snote" value="">
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
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
