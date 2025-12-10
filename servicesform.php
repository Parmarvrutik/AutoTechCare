<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
if (isset($_POST['Submit'])) {
    $sname = $_POST['sname'];
    $snote = $_POST['snote'];
    $sdatetime = $_POST['sdatetime'];
    $sdelivername = $_POST['sdelivername'];
    $ssreq = implode(',', $_POST['ssreq']); // Convert array to comma-separated string
    $sbikemake = $_POST['sbikemake'];
    $svehiclenumber = $_POST['svehiclenumber'];

    // Check for duplicate entry
    $result1 = mysqli_query($link, "SELECT * FROM service WHERE sname='$sname' AND snote='$snote' AND sdatetime='$sdatetime' AND sdelivername='$sdelivername' AND ssreq='$ssreq' AND sbikemake='$sbikemake' AND svehiclenumber='$svehiclenumber'");

    if (mysqli_num_rows($result1) > 0) {
        $message = "Duplicate entry";
    } else {
        // Insert new service record
        $result = mysqli_query($link, "INSERT INTO service(sname, snote, sdatetime, sdelivername, ssreq, sbikemake, svehiclenumber) VALUES('$sname', '$snote', '$sdatetime', '$sdelivername', '$ssreq', '$sbikemake', '$svehiclenumber')");
        mysqli_close($link);
        header("location: viewservicesform.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Services Form</title>

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
            <h1>Services General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Services General Form</li>
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
                <h3 class="card-title">Services Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="sdatetime">Date and Time <span style="color: red;">*</span></label>
                      <input type="datetime-local" class="form-control" id="sdatetime" name="sdatetime" required>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="svehiclenumber">Vehicle Number <span style="color: red;">*</span></label>
                      <input type="text" class="form-control" id="svehiclenumber" name="svehiclenumber" placeholder="Enter Vehicle Number" 
                      oninput="this.value = this.value.toUpperCase();" required>
                    </div>

                    <!-- Customer Name dropdown from customer table -->
                    <div class="form-group col-md-3">
                      <label for="sname">Customer Name <span style="color: red;">*</span></label>
                      <select class="form-control" id="sname" name="sname" required>
                        <option value="">Select Customer Name</option>
                        <?php
                        // Fetch customer names from the database
                        $query = "SELECT cname FROM customer";
                        $result = mysqli_query($link, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['cname'] . "'>" . $row['cname'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="sbikemake">Bike Make <span style="color: red;">*</span></label>
                      <select class="form-control" id="sbikemake" name="sbikemake">
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

                    <div class="form-group col-md-5">
                      <label for="ssreq">Service Required <span style="color: red;">*</span></label>
                      <select multiple class="form-control" id="ssreq" name="ssreq[]">
                        <option value="Accidental Repair">Accidental Repair</option>
                        <option value="Accessories Fitting">Accessories Fitting</option>
                        <option value="Air Filtter Cleaning">Air Filtter Cleaning</option>
                        <option value="All Kind of Two Wheeler Restoration">All Kind of Two Wheeler Restoration</option>
                        <option value="All Types of Two Wheeler Engine Repair">All Types of Two Wheeler Engine Repair</option>
                        <option value="All Types Two Wheeler Spare Parts Available">All Types Two Wheeler Spare Parts Available</option>
                        <option value="Accelerator Cable Lubrication">Accelerator Cable Lubrication</option>
                        <option value="Brek Drum Cleaning And Adjustment">Brek Drum Cleaning And Adjustment</option>
                        <option value="Bike Batteries">Bike Batteries</option>
                        <option value="Clutch Cable Lubrication">Clutch Cable Lubrication</option>
                        <option value="Clean The Spark Plug">Clean The Spark Plug</option>
                        <option value="Custom Works">Custom Works</option>
                        <option value="Dent & Paint">Dent & Paint</option>
                        <option value="Detailing">Detailing</option>
                        <option value="Disc Break Oli Check/Top-UP">Disc Break Oli Check/Top-UP</option>
                        <option value="Fuel line inspection">Fuel line inspection</option>
                        <option value="Inspect Clutch Lever Free Play">Inspect Clutch Lever Free Play</option>
                        <option value="Lights & Fitments">Lights & Fitments</option>
                        <option value="Lubricate The Side Stand and Main Stand">Lubricate The Side Stand and Main Stand</option>
                        <option value="Mirror Adjustment">Mirror Adjustment</option>
                        <option value="Nut and Bold Adjustment">Nut and Bold Adjustment</option>
                        <option value="Power Upgrade">Power Upgrade</option>
                        <option value="Replace Engine Oil">Replace Engine Oil</option>
                        <option value="Self Motor Checking">Self Motor Checking</option>
                        <option value="Tyre Change">Tyre Change</option>
                        <option value="Tyre Pressure Check">Tyre Pressure Check</option>
                        <option value="Vehicle Polishing">Vehicle Polishing</option>
                        <option value="Wash the Vehicle">Wash the Vehicle</option>
                        <option value="Wheel Care">Wheel Care</option>
                      </select>
                    </div>

                    <div class="form-group col-md-7">
                      <label for="sdelivername">Drop Person Name <span style="color: red;">*</span></label>
                      <input type="text" class="form-control" id="sdelivername" name="sdelivername" placeholder="Enter Drop Person Name"
                             oninput="this.value = this.value.toUpperCase();" required pattern="[A-Za-z]+">
                    </div>

                    <div class="form-group col-md-12">
                      <label for="snote">Note</label>
                      <input type="text" class="form-control" id="snote" name="snote" placeholder="Enter Your Note" oninput="this.value = this.value.toUpperCase();">
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="row">
                    <div class="col-12">
                      <?php if (!empty($message)) { echo "<p style='color:red;'>$message</p>"; } ?>
                      <input type="submit" class="btn btn-primary btn-block" value="Submit" name="Submit">
                    </div>
                  </div>  
                </div>
              </form>
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

