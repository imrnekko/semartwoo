<?php
session_start();
include("../connection/db_connection.php");

if(isset($_POST['update']))
{
    $cust_id = $_POST['custID'];
    $name = $_POST['custName'];
    $email = $_POST['custEmail'];

    $sqlUpdateCust = "UPDATE customer set name = '".$name."',email = '".$email."' where customer_id = '".$cust_id."' ";

    $qryUpdateCust = mysqli_query($con,$sqlUpdateCust);

    if($qryUpdateCust){
    $qstring = '?status=succ';  
    }else{
        $qstring = '?status=err';  
    }

    header("Location: ../views/auth/customerlist.php".$qstring);
}

if(isset($_GET['delete']))
{
    $cust_id = $_GET['delete'];

    $sqlDeleteCust = "DELETE from customer where customer_id = '".$cust_id."' ";

    $qryDeleteCust = mysqli_query($con,$sqlDeleteCust);

    if($qryDeleteCust){
    $qstring = '?status=deleted';  
    }else{
        $qstring = '?status=err';  
    }

    header("Location: ../views/auth/customerlist.php".$qstring);
}

?>