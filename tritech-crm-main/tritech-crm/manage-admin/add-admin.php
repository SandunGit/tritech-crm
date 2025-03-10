<?php include('../common/menu-manage.php'); ?> 

    <!-- Main Content Start -->
    <div class="top-header">
        <h1>Add a New User</h1>
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

                <form action="" method="POST">
                <table class="table-form">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Full Name" required></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Username" required></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type="text" name="user_email" placeholder="Enter Email" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Password" required></td>
                    </tr>
                    <tr>
                        <td>User Type: </td>
                        <td>    <Select name="user_type" required>
                                <option selected></option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                        </Select>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add User" class="btn-form">
                        </td>
                    </tr>
                </table>
                </form>
    </div>
    <!-- Main Content End -->

<?php include('../common/footer.php'); ?> 

<?php 

   if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $password = md5($_POST['password']);
    $user_type = $_POST['user_type'];       

    $sql1 = "SELECT * FROM tbl_admin WHERE username = ?"; 
    $stmt = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res1 = mysqli_stmt_get_result($stmt);

    if ($res1)
    {
        $count = mysqli_num_rows($res1);

        if($count == 1)
        {
            $_SESSION['add'] = "<div class='alert-failed'>Entered Username Already Exists. Please Try again</div> ";
            header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php'); 
            echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>"; 
        }
        else
        {
            $sql = "INSERT INTO tbl_admin (full_name, username, password, user_email, user_type) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $full_name, $username, $password, $user_email, $user_type);
            $res = mysqli_stmt_execute($stmt);

            if($res)
            {
                $_SESSION['add'] = "<div class='alert-success'> User Account Successfully Added </div>";
                header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
                echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>"; 
            }
            else
            {
                $_SESSION['add'] = "<div class='alert-failed'>Failed to Add User </div> ";
                header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
                echo "<script>window.location.href='http://localhost/tritech-crm/manage-admin/manage-admin.php'; </script>";
            } 
        }  
    }
    else
    {
        $_SESSION['add'] = "<div class='alert-failed'>Failed to Add User </div> ";
        header('location: http://localhost/tritech-crm/manage-admin/manage-admin.php');
        echo "<script>window.location.href='http://localhost/tritech



?>
