<?php
session_start();
include("../../connection/db_connection.php");

if(isset($_SESSION["admin_id"])){

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'downloaded':
            $statusType = 'alert-primary';
            $statusMsg = 'Customer report downloaded.';
            break;
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Customer details updated.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Problem occurred, please try again.';
            break;
        case 'deleted':
            $statusType = 'alert-primary';
            $statusMsg = 'Customer deleted.';
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

    <title>SemartWoo - List of Customer</title>

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

                    <!-- Display status message -->
                    <?php if(!empty($statusMsg)){ ?>
                    <div class="col-xs-12">
                        <div class="alert <?php echo $statusType; ?>" id="alertMsg"><?php echo $statusMsg; ?></div>
                    </div>
                    <?php } ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <p>This report will be used for Sendy.</p>
                    <form action="../../controller/reportController.php" method="POST">
                        <label for="state">File format type:</label>
                            <select name="export_file_type" class="form-control">
                                <option value="xlsx">XLSX</option>
                                <option value="xls">XLS</option>
                                <option value="csv">CSV</option>
                            </select>

                            <button type="submit" name="export_excel_btn" class="btn btn-primary mt-3"><i
                            class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>

                    </form>
                       
                            
                    </div>

                     <!-- List of Admin -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Customer</h6>
                        </div>
                        <div class="card-body">

                        <div class="table-responsive">
                          
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:40%">Name</th>
                                            <th style="width:40%">Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php


                                        $sql = "SELECT c.customer_id,c.name,c.email from customer c";
                                        $qrydata = mysqli_query($con,$sql);

                                        $row = mysqli_num_rows($qrydata);


                                        if($row>0)
                                        {
                                        $counter = 1;

                                        while($res = mysqli_fetch_assoc($qrydata))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $res['name'];?></td>
                                            <td><?php echo $res['email'];?></td>
                                            <td>
                                            <a onclick="edit_cust()" data-toggle="modal" id="editBtn" data-target="#editForm" data-id="<?php echo $res['customer_id'];?>" data-name="<?php echo $res['name'];?>" data-email="<?php echo $res['email'];?>" class="btn btn-primary btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <a class="btn btn-danger btn-sm" name="delete" href="../../controller/customerController.php?delete=<?php echo $res['customer_id'];?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                                <span class="text">Delete</span>
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

            <!-- Edit Form Modal-->
            <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit <span id="custNameHeader"></span></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form method="post" action="../../controller/customerController.php" > 
                            <div class="modal-body">Update the customer details.
                            <hr>
                            <input type="hidden" class="form-control" name="custID" id="custID" value="" required/>
                                <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="custName" id="custName" value="" required/>
                                </div>

                                <div class="form-group col-md-12">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="custEmail" id="custEmail" value="" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit" name="update" >Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

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

    <script>

    function edit_cust() {
        $(document).on('click','#editBtn', function(e) {
            var customer_id = $(this).attr('data-id');
            var customer_name = $(this).attr('data-name');
            var customer_email = $(this).attr('data-email');
            document.getElementById("custID").value = ( customer_id );
            document.getElementById("custName").value = ( customer_name );
            document.getElementById("custNameHeader").innerHTML = ( customer_name );
            document.getElementById("custEmail").value = ( customer_email );
        });
    }
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
