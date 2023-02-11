<?php
     include('../config/constants.php');
     include('../config/login-check.php');

     $id = (int)$_GET['id']; //casting the variable to int type to prevent SQL injection

     $sql2 = "INSERT INTO tbl_customer (full_name,email,contact,reg_date,type)  
              SELECT full_name,contact,email,date,'converted'
              FROM tbl_lead   
              WHERE id=?";  //using placeholder instead of directly inserting the $id variable

     // preparing and executing the query
     $stmt = mysqli_prepare($conn, $sql2);
     mysqli_stmt_bind_param($stmt, "i", $id);
     $res2 = mysqli_stmt_execute($stmt);

     if($res2)
     {
        $_SESSION['update'] = "<div class='alert-success'>Lead Added to Customers</div>";
        header('location: http://localhost/tritech-crm/user-home/manage-lead.php');
     }
     else
     {
        $_SESSION['update'] = "<div class='alert-failed'>Failed to add Lead to Customers </div> ";
        header('location: http://localhost/tritech-crm/user-home/manage-lead.php');
     }

     $sql = "DELETE FROM tbl_lead WHERE id=?";  //using placeholder instead of directly inserting the $id variable

     // preparing and executing the query
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "i", $id);
     $res = mysqli_stmt_execute($stmt);
?>


