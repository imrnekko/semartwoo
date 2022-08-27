<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"]) == false){

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SemartWoo - Register</title>

    <!-- Favicons -->
    <link href="../../assets/img/logo/logo.png" rel="icon">
    <link href="../../assets/img/logo/logo.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">



    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
        <form class="user" action="../../controller/registerController.php" method="post">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <h1 class="h5 text-gray-900 mb-4">Personal Information</h1>

                            </div>
                           
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstname" name="firstname"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select name="department" id="department" placeholder="Department" class="form-control form-control-user" required>
                                                <option value="">Please Select</option>
                                                <?php

                                                include ("../../connection/db_connection.php");


                                                $sql = "SELECT * FROM department";

                                                $qry = mysqli_query($con, $sql);
                                                $row = mysqli_num_rows($qry);

                                                if($row > 0 )
                                                {
                                                    while($r = mysqli_fetch_assoc($qry))
                                                    {
                                                        echo'<option value = "'.$r['department_id'].'">
                                                        '.$r['name'].'</option>';

                                                    }

                                                }

                                                ?>
                                            </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="mobilenum" name="mobilenum"
                                            placeholder="Mobile Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name = "password"
                                            id="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="passwordconfirm"
                                            id="passwordconfirm" placeholder="Confirm Password">
                                    </div>
                                </div>
                               
                                <hr>
                             
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h5 text-gray-900 mb-4">Contact Details</h1>
                            </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="address1" name="address1"
                                            placeholder="Address 1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="address2" name="address2"
                                            placeholder="Address 2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="postcode" name="postcode"
                                            placeholder="Postcode">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="city" name="city"
                                            placeholder="City">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="states" name="states"
                                            placeholder="State">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="country" name="country"
                                            placeholder="Country">
                                    </div>
                                </div>
                                
                                <hr>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../../index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>
<?php 
}else{

    header("Location: ../auth/dashboard.php".$qstring);
}

?>