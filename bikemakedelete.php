<?php
session_start();
include("connection.php");
include("comman.php");
checklogin();
?>

<?php
$bid = $_GET['bid'];

if(isset($_GET['bid']))
{
    // SQL query to delete data from user table where id = $userid
    $query = "DELETE FROM bikemakemaster WHERE bid = {$bid}"; 
    $delete_query= mysqli_query($link, $query);
    header("Location: viewbikemake.php");
}
?>