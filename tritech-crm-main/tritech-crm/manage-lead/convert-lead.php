<?php
     include('../config/constants.php');
     include('../config/login-check.php');
     
     if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        $sql2 = "INSERT INTO tbl_customer (full_name,email,contact,reg_date,type)  
                 SELECT full_name,email,contact,date,'converted'
                 FROM tbl_lead   
                 WHERE id='$id'
                "; //copying data from table lead to customer table

        $res2 = mysqli_query($conn, $sql2);

        if($res2)
        {
            $_SESSION ['update'] = "<div class='alert-success'>Lead Added to Customers</div>";
            header('location: http://localhost/tritech-crm/manage-lead/manage-lead.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='alert-failed'>Failed to add Lead to Customers </div> ";
            header('location: http://localhost/tritech-crm/manage-lead/manage-lead.php');
        }

        $sql = "DELETE FROM tbl_lead WHERE id='$id'";  //Delete the lead after converting to customer
        $res = mysqli_query($conn, $sql);
     }
?>


