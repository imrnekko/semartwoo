<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"])){

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SemartWoo - List of Admin</title>

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

    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

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

                     <!-- List of Admin -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Admin</h6>
                        </div>
                        <div class="card-body">

                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php


                                        $sql = "SELECT a.fullname, d.name, a.email, a.avatarName from marketim.admin a join marketim.department d on a.department_id =  d.department_id ";
                                        $qrydata = mysqli_query($con,$sql);

                                        $row = mysqli_num_rows($qrydata);


                                        if($row>0)
                                        {
                                        $counter = 1;

                                        while($res = mysqli_fetch_assoc($qrydata))
                                        {
                                        ?>
                                        <tr>
                                            <td><img class="img-profile rounded-circle"
                                            src="../../assets/img/profile_photo/<?php echo $res['avatarName'];?>" width="40" height="40">
                                            <p><?php echo $res['fullname'];?></p></td>
                                            <td><?php echo $res['name'];?></td>
                                            <td><?php echo $res['email'];?></td>
                                            <td>
                                            <a href="#" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <?php 

                                        $counter++;
                                        }

                                        }
                                        
                                        
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                                  
                        </div>
                     </div>

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

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>
<?php 
}else{

    header("Location: ../../index.php".$qstring);
}

?>