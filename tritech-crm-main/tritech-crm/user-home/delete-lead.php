<?php
    include('../config/constants.php');

    $id = $_GET['id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM tbl_lead WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    $res = mysqli_stmt_execute($stmt);

    if ($res==TRUE)
    {
        $_SESSION['delete'] = "<div class='alert-success'> Lead Removed Successfully </div>";
        header('location: http://localhost/tritech-crm/user-home/manage-lead.php');
    }
    else
    {
        $_SESSION['delete']= "<div class='alert-failed'> Failed To Remove Lead </div>";
        header('location: http://localhost/tritech-crm/user-home/manage-lead.php');
    }

    mysqli_stmt_close($stmt);
?>
