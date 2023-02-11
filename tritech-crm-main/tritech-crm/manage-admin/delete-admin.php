<?php
  include('../config/constants.php');

  $id = $_GET['id'];

  $stmt = mysqli_prepare($conn, "DELETE FROM tbl_admin WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $_SESSION['delete'] = "<div class='alert-success'> User Deleted Successfully </div>";
    header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
  } else {
    $_SESSION['delete']= "<div class='alert-failed'> Failed To Delete User </div>";
    header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
  }
  mysqli_stmt_close($stmt);
?>
