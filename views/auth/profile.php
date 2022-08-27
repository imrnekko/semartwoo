<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"])){

$admin_id = $_SESSION['admin_id'];

$sqlAdmin = "SELECT * FROM admin a join department d on a.department_id = d.department_id WHERE a.admin_id = '".$admin_id."'  ";
$qryAdmin = mysqli_query($con, $sqlAdmin);
$row = mysqli_num_rows($qryAdmin);
$rAdmin = mysqli_fetch_assoc($qryAdmin);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SemartWoo - My Profile</title>

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

<body id="page-top">

<style>
    #avatar {
    vertical-align: middle;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    }

    
</style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
          <?php include("../partials/sidebar_nav.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <!-- Topnav -->
                <?php include("../partials/topnav.php"); ?>
                <!-- End of Topnav -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                
                <form method="post" action="../../controller/profileController.php" id="profile_form" enctype='multipart/form-data'> 
                     <!-- Personal Information Section -->
                     <div class="card shadow mb-4">
                                
                     
                                <div class="card-body">
                                    <div >
                                        <center>
                                        <div class="profile-pic">
                                        <label class="-label" for="file">
                                            <span class="glyphicon glyphicon-camera"></span>
                                            <span>Change Image</span>
                                        </label>
                                        <input id="avatar_file" name="avatar_file" type="file" onchange="checkPhoto(this)"/>
                                            <img src="../../assets/img/profile_photo/<?php echo $_SESSION["avatarName"]?>" class="avatar" id="avatar" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        </center>
                                    </div>
                                </div>
              

                    
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Profile Info</h6>
                                </div>
                                <div class="card-body">

                                <input type="hidden" class="form-control" name="admin_id" id="admin_id"  value="<?php echo $rAdmin["admin_id"];?>" required>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="state">Full Name</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo $rAdmin["fullname"];?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">Department</label>
                                            <select name="department" id="department"  class="select2 form-control custom-select" required>
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
                                                       


                                                        if($rAdmin["department_id"] == $r['department_id'])
                                                        {
                                                            echo "<option value='".$r['department_id']."' selected>".$r['name']. "</option>";
                                                        }
                                                        else {
                                                            echo "<option value='".$r['department_id']."' >".$r['name']. "</option>";
                                                        }

                                                    }

                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="state">Mobile Number</label>
                                            <input type="text" class="form-control" name="mobilenum" id="mobilenum" placeholder="Mobile Number" value="<?php echo $rAdmin["mobilenum"];?>" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $rAdmin["email"];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="state">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" minlength="8"  >
                                            <span id='message'></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="">Confirm Password</label>
                                            <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="Confirm Password" >
                                        </div>
                                    </div>
                                </div>
                     </div>

                       <!-- Contact Details Section -->
                       <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Contact Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="state">Address 1</label>
                                                <input type="text" class="form-control" name="address1" id="address1" placeholder="Address 1" value="<?php echo $rAdmin["address_1"];?>" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Address 2</label>
                                                <input type="text" class="form-control" name="address2" id="address2" placeholder="Address 2" value="<?php echo $rAdmin["address_2"];?>" required>
                                            </div>
                                    </div>
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="state">Postcode</label>
                                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" value="<?php echo $rAdmin["postcode"];?>" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">City</label>
                                                <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $rAdmin["city"];?>" required>
                                            </div>
                                    </div>
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" name="states" id="states" placeholder="State" value="<?php echo $rAdmin["states"];?>" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Country</label>
                                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="<?php echo $rAdmin["country"];?>" required>
                                            </div>
                                    </div>
                                </div>
                     </div>

                    <button class="btn btn-danger btn-icon-split" type="reset" name="reset">
                        <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Reset</span>
                    </a>

                    <button class="btn btn-primary btn-icon-split" type="submit" name="submit" >
                        <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Update</span>
                    </button>

                </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

            <!-- Footer -->
            <?php include("../partials/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top -->
    <?php include("../partials/scrolltotop.php"); ?>
    <!-- End of Scroll to Top -->

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>

        $('#password, #passwordconfirm').on('keyup', function () {
        if ($('#password').val() == $('#passwordconfirm').val()) {
            $('#message').html('Password match').css('color', 'green');
        } else 
            $('#message').html('Password does not match').css('color', 'red');
        });
    </script>

    <script>

   
  
        $("#avatar_file").change(function (e) {
        var img = document.getElementById("avatar");
        img.src = window.URL.createObjectURL(event.target.files[0])
        img.onload = () => {
            if(img.width <= 800 && img.height <= 800){
                if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#receiptView')
                        .attr('src', e.target.result)
                        .attr('class', 'my-4 img-fluid mx-auto d-block');
                };

                reader.readAsDataURL(input.files[0]);
            }
            } 
            else {
                alert(`Sorry, this image doesn't look like the size we wanted. It's 
                ${img.width} x ${img.height} but we require below 800 x 800 size image.`);
                document.getElementById("avatar_file").value = "";
            }                
        }
        img.onerror = function() {
                alert( "Not a valid file type. Please insert image only ");
                document.getElementById("avatar_file").value = "";
        };
        
        });

       
    </script>

  <!--  <script>  
        function matchPassword() 
        {  
            var pw1 = document.getElementById("password").value;  
            var pw2 = document.getElementById("passwordconfirm").value;  

            if(pw1 != pw2)  
            {   
                alert("Passwords did not match");  
                alert.pop();
            }else 
            {  
                var form = document.getElementById("profile_form");
                form.submit();
            }  
        }  
    </script>  
    -->
</body>

</html>
<?php 
}else{

    header("Location: ../../index.php".$qstring);
}

?>