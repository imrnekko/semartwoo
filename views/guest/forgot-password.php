<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"]) == false){

    // Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'We have e-mailed your password reset link!';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'The email you entered does not belong to any account, please try again.';
            break;
      
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SemartWoo - Forgot Password</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="post" action="../../mail/email-reset-password.php">
                                        <div class="form-group">
                                            <input type="email" name="email" maxlength="30" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email Address" required>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                                            Reset Password
                                        </button>
                                    </form>
                                    <br>
                                    <!-- Display status message -->
                                    <?php if(!empty($statusMsg)){ ?>
                                    <div class="col-xs-12">
                                        <div class="alert <?php echo $statusType; ?>" id="alertMsg"><?php echo $statusMsg; ?></div>
                                    </div>
                                    <?php } ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../../index.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Alert pop-up message -->
    <script>
        setTimeout(function(){
        if ($('#alertMsg').length > 0) {
            $('#alertMsg').fadeOut();
        }
        }, 5000);

    </script>

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
