<?php

session_start();
include("connection.php");

$msg = "";

if (isset ($_POST['Submit']))
{
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $password = mysqli_real_escape_string($link,$_POST['password']);
    $captcha = mysqli_real_escape_string($link,$_POST['captcha']);
    
    $result = mysqli_query($link,"Select * From admin where username='$username'");
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        if ($password == $row["password"] && $captcha == $_SESSION['captcha']) 
{
    $_SESSION['adminok'] = "ok";
    $_SESSION['username'] = $username;
    // $_SESSION['password'] = "password";
    header("Location: main.php");
}
else
{
    $msg = "Password incorrect";
}

    }
    else
    {
        $msg = "Username incorrect";
    }
}
$number1 = rand(1,10);
$number2 = rand(1,10);
$_SESSION['captcha'] = $number1 + $number2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AUTOTECHCARE | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>AUTO TECH CARE</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="captcha" class="sr-only">Captcha</label>
          <input type="text" name="captcha" id="captcha" class="form-control form-control-lg" placeholder="<?php echo $number1; ?> + <?php echo $number2; ?> = ?" required>
        </div>

        <!-- Display message if there is one -->
        <?php if (!empty($msg)) { echo "<p style='color:red;'>$msg</p>"; } ?>

        <div class="row">
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block" value="Submit" name="Submit">
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
