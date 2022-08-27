<?php
include("../connection/db_connection.php");

if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($con,$_POST["email"]);
    $password = mysqli_real_escape_string($con,$_POST["password"]);
    $sql = "SELECT * FROM admin a join department d on a.department_id = d.department_id WHERE a.email ='".$email."' and a.password = '".$password."' ";
    $qry = mysqli_query($con,$sql);
    $row =mysqli_num_rows($qry);


    if($row>0)
    {
      session_start();
      $data = mysqli_fetch_assoc($qry);
      $_SESSION['userlogged']=1;
      
      $_SESSION['admin_id']=$data['admin_id'];
      $_SESSION['fullname']=$data['fullname'];
      $_SESSION['email']=$data['email'];
      $_SESSION['department']=$data['name'];
      $_SESSION['avatarName']=$data['avatarName'];
      

      date_default_timezone_set("Asia/Kuala_Lumpur");
      $datetime = date('Y/m/d H:i:s');

      if($_SESSION['userlogged']=1)
      {
        //$sqlNewLogin = "INSERT into auditlogin (admin_id,logintime,ipaddress) VALUES ('".$data['admin_id']."','".$datetime."','".$_SERVER['REMOTE_ADDR']."')";
        //$queryNewLogin=mysqli_query($con,$sqlNewLogin) or die ("Error: ". mysqli_error($con));

        $_SESSION['logintime']=$date;



      }

      header("Location: ../views/auth/dashboard.php");



    }
    else {
  {

      echo "<script language = 'javascript'>
      alert ('Mismatched User ID or Password. Please try again.');
      window.location='../index.php';
      </script>";
  }

  }
}

?>