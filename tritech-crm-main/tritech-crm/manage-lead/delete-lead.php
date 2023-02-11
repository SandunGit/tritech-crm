<?php
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_lead WHERE id=?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0)
    {
        $_SESSION['delete'] = "<div class='alert-success'> Lead Removed Successfully </div>";
        header('location: http://localhost/tritech-crm/manage-lead/manage-lead.php');
    }
    else
    {
        $_SESSION['delete']= "<div class='alert-failed'> Failed To Remove Lead </div>";
        header('location: http://localhost/tritech-crm/manage-lead/manage-lead.php');
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
