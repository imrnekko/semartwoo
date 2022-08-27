<?php
session_start();

  if(isset($_POST['submit']))
  {

    include("../connection/db_connection.php");

    $adminid = $_POST['admin_id'];
    $fullname = $_POST['fullname'];
    $mobilenum = $_POST['mobilenum'];
    $email = $_POST['email'];
    $password = $_POST['passwordconfirm'];
    $passwordconfirm = $_POST['password'];
    $department = $_POST['department'];
    $avatar = $_FILES['avatar_file'];

    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $states = $_POST['states'];
    $country = $_POST['country'];

    $sql="SELECT * FROM admin where admin_id =  '".$adminid."' " ;
    $qry=mysqli_query($con,$sql);
    $row=mysqli_num_rows($qry);

    if($row > 0)
    {

    
     if(isset($password) && !($password == "")){

      if($password == $passwordconfirm){

        $sqlUpdateAdmin = "UPDATE admin set fullname = '".$fullname."', mobilenum = '".$mobilenum."',
        email = '".$email."', password = '".$password."', department_id = '".$department."',
        address_1 = '".$address1."', address_2 = '".$address2."', postcode = '".$postcode."',
        city = '".$city."', states = '".$states."', country = '".$country."', avatarName = '".$avatarName."' where admin_id = '".$adminid."' ";
  
        $qryUpdateAdmin = mysqli_query($con,$sqlUpdateAdmin);

         echo"<script language = 'javascript'>
         alert('Profile details updated!');
         window.location='../views/auth/dashboard.php';</script>";

      }else
      {
        echo"<script language = 'javascript'>
        alert('Password does not match.');
        window.location='../views/auth/profile.php';</script>";

      }


     }else{

      $sqlUpdateAdmin = "UPDATE admin set fullname = '".$fullname."', mobilenum = '".$mobilenum."',
      email = '".$email."', department_id = '".$department."',
      address_1 = '".$address1."', address_2 = '".$address2."', postcode = '".$postcode."',
      city = '".$city."', states = '".$states."', country = '".$country."' where admin_id = '".$adminid."' ";

      $qryUpdateAdmin = mysqli_query($con,$sqlUpdateAdmin);

      $_SESSION['fullname']=$fullname;
      $_SESSION['email']=$email;
      $_SESSION['department']=$department;


      if (!($_FILES['avatar_file']['name'] == ""))
      {
          $dir = '../assets/img/profile_photo/';

          $avatarName = addslashes($_FILES["avatar_file"]["name"]);
          $avatarData = addslashes(file_get_contents($_FILES["avatar_file"]["tmp_name"]));
          $avatarType = addslashes($_FILES["avatar_file"]["type"]);
          $target_file = $dir . basename($avatarName);
          $avatarSize= getimagesize($_FILES['avatar_file']['tmp_name']);
    
          move_uploaded_file($_FILES["avatar_file"]["tmp_name"], $target_file);
          $location= $dir . $avatarName;

          $sqlUpdateAvatar = "UPDATE admin set avatarName = '".$avatarName."' where admin_id = '".$adminid."' ";

          $qryUpdateAvatar = mysqli_query($con,$sqlUpdateAvatar);

          $_SESSION['avatarName']= $avatarName;
      }


      
      

       echo"<script language = 'javascript'>
       alert('Profile details updated!');
       window.location='../views/auth/dashboard.php';</script>";

     }

    }
    else {
      echo"<script language = 'javascript'>
       alert('Incomplete information!');
       window.location='../views/auth/profile.php';</script>";
    }






  }



?>