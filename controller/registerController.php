<?php
session_start();

  if(isset($_POST['submit']))
  {

    include("../connection/db_connection.php");

    $fullname = $_POST['firstname']. ' ' .$_POST['lastname'];
    $mobilenum = $_POST['mobilenum'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $department = $_POST['department'];

    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $states = $_POST['states'];
    $country = $_POST['country'];

    $sql="SELECT * FROM admin where email =  '".$email."' " ;
    $qry=mysqli_query($con,$sql);
    $row=mysqli_num_rows($qry);

    if($row == 0)
    {


     // $r = mysqli_fetch_assoc($qry);

      $sqlInsertAdmin = "INSERT INTO admin 
      (fullname,mobilenum,email,password,department_id,address_1,address_2,postcode,city,states,country) VALUES 
      ('".$fullname."','".$mobilenum."','".$email."','".$password."','".$department."','".$address1."','".$address2."',
      '".$postcode."','".$city."','".$states."','".$country."')";

      $qryInsertAdmin = mysqli_query($con,$sqlInsertAdmin);

     echo"<script language = 'javascript'>
      alert('New User has been added to the system!');
      window.location='../index.php';</script>";
    }
    else {
      echo"<script language = 'javascript'>
       alert('User has already registered!');
       window.location='../views/guest/register.php';</script>";
    }






  }



?>