<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "marketim";

$con = mysqli_connect($host,$user,$password,$dbname);

if(!$con)
  echo "unable to connect to database!";
?>
