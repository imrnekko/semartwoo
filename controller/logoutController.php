<?php
session_start();
include("../connection/db_connection.php");

if(isset($_POST['logout']))
{
  session_destroy();
  header("Location: ../index.php");
}

?>