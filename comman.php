<?php
function checklogin()
{
    if(!isset ($_SESSION['adminok']))
    echo "<script>window.open('index.php','_self')</script>";
}
?>