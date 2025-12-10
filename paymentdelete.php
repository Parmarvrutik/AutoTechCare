<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
$sid = $_GET['sid'];

if(isset($_GET['sid']))
{
    // SQL query to delete data from user table where id = $userid
    $query = "DELETE FROM pendingamounttracker WHERE sid = {$sid}"; 
    $delete_query= mysqli_query($link, $query);
    header("Location: viewpendingamount.php");
}
?>