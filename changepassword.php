<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();


$msg = "";

if (!isset($_SESSION['adminok'])) {
    header("Location: logout.php"); // If the user is not logged in, redirect to login page.
    exit();
}

if (isset($_POST['Submit'])) {
    $username = $_SESSION['username']; // Username is stored in the session after login.
    $old_password = mysqli_real_escape_string($link, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($link, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($link, $_POST['confirm_password']);
    
    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        $msg = "New password and confirm password do not match!";
    } else {
        // Query to get the current password of the logged-in user
        $result = mysqli_query($link, "SELECT * FROM admin WHERE username='$username'");
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_BOTH);
            
            // Check if the old password matches
            if ($old_password == $row['password']) {
                // Update password in the database
                $update_query = "UPDATE admin SET password='$new_password' WHERE username='$username'";
                if (mysqli_query($link, $update_query)) {
                  header("Location: logout.php");
                    $msg = "Password successfully updated!";
                } else {
                    $msg = "Error updating password.";
                }
            } else {
                $msg = "Old password is incorrect.";
            }
        } else {
            $msg = "Username not found.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Change Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
<body class="hold-transition login-page">
<section class="content-header">
<div class="container-fluid">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>AUTO TECH CARE</b></a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Change your password</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Old Password" name="old_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="New Password" name="new_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm New Password" name="confirm_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- Display message if there is one -->
        <?php if (!empty($msg)) { echo "<p style='color:red;'>$msg</p>"; } ?>

        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Update Password" name="Submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
