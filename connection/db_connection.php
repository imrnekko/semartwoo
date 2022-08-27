<?php

$host = "sg-nme-web427.main-hosting.eu";
$user = "u674073926_imran";
$password = "Uz5*[vo~Z4M~";
$dbname = "u674073926_semartwoo";

$con = mysqli_connect($host,$user,$password,$dbname);

if(!$con)
  echo "unable to connect to database!";
?>
