<?php
    include('../config/constants.php');

    $id = intval($_GET['id']);
    $sql = "DELETE FROM tbl_campaign WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    $res = mysqli_stmt_execute($stmt);

    if ($res)
    {
        $_SESSION['delete'] = "<div class='alert-success'> Campaign Deleted Successfully </div>";
        header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
    }
    else
    {
        $_SESSION['delete']= "<div class='alert-failed'> Failed To Delete Campaign </div>";
        header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
    }
?>
