<?php
session_start();
include("../connection/db_connection.php");



if(isset($_POST['import'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file_upload']['name']) && in_array($_FILES['file_upload']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file_upload']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file_upload']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            //insert new upload
            $uploadQry = mysqli_query($con, "INSERT INTO upload (admin_id, upload_time) VALUES ('".$_SESSION['admin_id']."', NOW())");

            $upload_id = mysqli_insert_id($con);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $name   = $line[0];
                $email  = $line[1];
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT customer_id FROM customer WHERE email = '".$line[1]."'";
                $prevResult = mysqli_query($con,$prevQuery);
                $num_rows = mysqli_num_rows($prevResult);
                
                if($num_rows > 0){
                    // Update member data in the database
                    $con->query("UPDATE customer SET name = '".$name."', updated_time = NOW(), upload_id = '".$up_id."' WHERE email = '".$email."'");
                }else{
                    
                    // Insert member data in the database
                    $con->query("INSERT INTO customer (name, email, created_time, updated_time, upload_id) VALUES ('".$name."', '".$email."', NOW(), NOW(), '".$upload_id."' )");
              
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);

            
            $qstring = 'status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }

    // Redirect to the listing page
    header("Location: ../views/auth/uploaddata.php?id=".$upload_id."&".$qstring);
}

?>
