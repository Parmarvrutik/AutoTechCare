<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
$cid = $_GET['cid'];

if(isset($_GET['cid']))
{
    // SQL query to delete data from user table where id = $userid
    $query = "DELETE FROM customer WHERE cid = {$cid}"; 
    $delete_query= mysqli_query($link, $query);
    header("Location: viewcustomer.php");
}
?>