<?php

session_start();
require_once "config.php";

$sid = $_GET['id1']; // get id through query string
$cid = $_GET['id2'];

$query = "DELETE FROM apply WHERE sid='$sid' AND cid='$cid'";

$del = mysqli_query($adress,$query); // delete query

if($del)
{

    $queryUpdate = "UPDATE company SET quota = quota +1 WHERE cid='$cid'";
    mysqli_query($adress, $queryUpdate);
    echo '<script>alert("Deletion Successfull")</script>';
    echo "<script LANGUAGE='JavaScript'>
          window.location.href = 'welcome.php';
          </script>";
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
    echo "<script LANGUAGE='JavaScript'>
          window.location.href = 'welcome.php';
          </script>";
    exit;
}
?>