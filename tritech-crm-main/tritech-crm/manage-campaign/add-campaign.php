<?php include('../common/menu-manage.php'); ?> 

    <!-- Main Content Start -->
    <div class="top-header">
        <h1>Add a New Campaign</h1> 
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
                <td>Campaign Title: </td>
                <td><input type="text" name="camp_name" placeholder="Campaign Title" required></td>
            </tr>
            <tr>
                <td>Start Date: </td>
                <td><input type="date" name="start_date" required></td>
            </tr>
            <tr>
                <td>End Date: </td>
                <td><input type="date" name="end_date"  required></td>
            </tr>
            <tr>
                <td>Budget: (Rs) </td>
                <td><input type="number" name="budget" placeholder="Enter the Budget" required></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                <Select name="type" required>
                        <option value="Youtube Commercial">Youtube commercial</option>
                        <option value="Facebook Ad">Facebook & Instagram</option>
                        <option value="TV Commercial">TV Commercial</option>
                        <option value="Leaflet">Leaflets</option>
                        <option value="Donation">Donations & Charities</option>
                    </Select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Campaign" class="btn-form">
                </td>
            </tr>
        </table>

        </form>
    </div>
    <!-- Main Content End -->

<?php include('../common/footer.php'); ?> 

<?php 

   if(isset($_POST['submit'])) {
    $camp_name = $_POST['camp_name'];
    $start_date = date('y-m-d',strtotime($_POST['start_date']));
    $end_date = date('y-m-d',strtotime($_POST['end_date']));
    $budget = $_POST['budget'];
    $type = $_POST['type'];
    
    $sql = "INSERT INTO tbl_campaign (camp_name, start_date, end_date, budget, type) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssds", $camp_name, $start_date, $end_date, $budget, $type);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['add'] = "<div class='alert-success'>Campaign Successfully Added </div>";
        header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
    } else {
        $_SESSION['add'] = "<div class='alert-failed'>Failed to Add Campaign </div> ";
        header('location: http://localhost/tritech-crm/manage-campaign/add-campaign.php');
    }
    mysqli_stmt_close($stmt);
}



?>
