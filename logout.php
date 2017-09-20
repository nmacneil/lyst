<?php
echo "test";//Kills everything and returns to login screen
include "config.php";
session_start();
session_destroy();
mysqli_close($con);
header("Location: login.php"); 
?>