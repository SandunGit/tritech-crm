<?php include('../common/menu-manage.php'); ?> 

    <!-- Content Start -->
    
    <div class="top-header">
        <h1>Change Password</h1> 
        <div class="date-time">
        <div class="date">
            <span id="daynum">00</span>-
            <span id="dayname">Day</span> 
            <span id="month">Month</span>
 
            <span id="year">Year</span>
        </div>

        <div class="time">
            <span id="hour">00</span>:
            <span id="minutes">00</span>:
            <span id="seconds">00</span>
            <span id="period">AM</span>
        </div>
        <!--digital clock end-->
        </div>
    </div>

    <div class="main-content">
    <div class="alert-header"> 
            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>
    </div>

        <form action="" method="POST">
  <table class="table-form">
    <tr>
      <td>Current Password: </td>
      <td><input type="password" name="current_password" placeholder="Current Password"></td>
    </tr>
    <tr>
      <td>New Password:  </td> 
      <td><input type="password" name="new_password" placeholder="New Password"></td>          
    </tr>
    <tr>
      <td>Confirm Password:  </td>
      <td><input type="password" name="confirm_password" placeholder="Old Password"></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>" >
        <input type="submit" name="submit" value="Change Password" class="btn-form">
      </td>
    </tr>
  </table>
</form>

    </div>
    <!-- Content End -->

<?php 

if(isset($_POST['submit']))
{
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $sql = "SELECT password FROM tbl_admin WHERE id='$id'";
    $res = mysqli_query($conn, $sql);

    if($res)
    {
        $user = mysqli_fetch_assoc($res);

        if(password_verify($current_password, $user['password']))
        {

            if($new_password == $confirm_password)
            {
                $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);

                $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password_hashed' 
                    WHERE id='$id'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2)
                {

                    $_SESSION['change-pwd'] = "<div class='alert-success'>Password Changed Successfully. </div>";
                    header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
                    echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>"; 
                }
                else
                {

                    $_SESSION['change-pwd'] = "<div class='alert-failed'>Failed to Change Password</div>";
                    header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
                    echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>"; 
                }
            }
            else
            {
                $_SESSION['pwd-not-match'] = "<div class='alert-failed'>Entered New Passwords does not match</div>";
                header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
                echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>"; 

            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='alert-failed'>Current Password is entered incorrectly</div>";
            header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
            echo "<script>window.location.href='http://localhost/tritech-crm

        }
    }

}

?>




<?php include('../common/footer.php'); ?> 
