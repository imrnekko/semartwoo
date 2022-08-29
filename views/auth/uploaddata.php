<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"])){

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Customers data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
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

    <title>SemartWoo - Upload Data</title>

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

                
                <!-- Display status message -->
                <?php if(!empty($statusMsg)){ ?>
                <div class="col-xs-12">
                    <div class="alert <?php echo $statusType; ?>" id="alertMsg"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>

                    <!-- Upload Data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Upload Data</h6>
                        </div>
                        <div class="card-body">

                        <form method="post" action="../../controller/uploadDataController.php" enctype="multipart/form-data" id="upload_form">
                            <p>Please upload the excel file that you obtained from the Google Forms.</p>
                            
                            <input type="file" name="file_upload" id="file_upload"  onchange="checkfile(this);" class="btn btn-sm btn-secondary shadow-sm" required>
                          
                            <button class="btn btn-primary btn-icon-split" type="submit" name="import" >
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Import</span>
                            </button>
                        </form>
                        </div>
                     </div>

                    <!-- Customer Upload Data -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Upload Data</h6>
                        </div>
                        <div class="card-body">

                        <div class="table-responsive">
                          
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">No.</th>
                                            <th style="width:45%">Name</th>
                                            <th style="width:45%">Email</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php

                                        if(isset($_GET['id'])){

                                            
                                        
                                        $sql = "SELECT c.customer_id,c.name,c.email,c.upload_id from customer c where c.upload_id = '".$_GET['id']."' ";
                                        $qrydata = mysqli_query($con,$sql);

                                        $row = mysqli_num_rows($qrydata);


                                        if($row>0)
                                        {
                                        $counter = 1;

                                        while($res = mysqli_fetch_assoc($qrydata))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter;?></td>
                                            <td><?php echo $res['name'];?></td>
                                            <td><?php echo $res['email'];?></td>
                                            
                                        </tr>
      
                                        
                                        <?php 

                                        $counter++;
                                        }

                                        }else{ ?>

                                            <tr>
                                            <td colspan="3" align="center">No records found</td>
                                           
                                            </tr> <?php
                                        } 

                                        }else{
                                            ?>

                                            <tr>
                                            <td colspan="3" align="center">No records. Please upload the data first.</td>
                                           
                                            </tr> <?php

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

            <script type="text/javascript" language="javascript">
            function checkfile(sender) {
                var validExts = new Array(".xlsx", ".xls", ".csv");
                var fileExt = sender.value;
                fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
                if (validExts.indexOf(fileExt) < 0) {
                alert("Invalid file selected, valid files are of " +
                        validExts.toString() + " types.");
                        document.getElementById("file_upload").value = "";
                return false;
                }
                else return true;
            }
            </script>

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
