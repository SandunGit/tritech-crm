<?php include('../common/menu-manage.php'); ?> 

    <!-- Main Content Start -->
    <div class="top-header">
        <h1>Update Campaign Details</h1>
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
<?php

$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_campaign WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        
        $camp_name = $row['camp_name'];
        $budget = $row['budget'];
        $type = $row['type'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];  
    } else {
        header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
    }
}

mysqli_stmt_close($stmt);

?>

<form action="" method="POST">
        <table class="table-form">
            <tr>
                <td>Campaign Title </td>
                <td><input type="text" name="camp_name" value="<?php echo htmlspecialchars($camp_name); ?>" required></td>

            </tr>
            <tr>
                <td>Start Date</td>
                <td><input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" required></td>
            </tr>
            <tr>
                <td>End Date</td>
                <td><input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" required></td>
            </tr>
           
            <tr>
                <td>Budget: (Rs) </td>
                <td><input type="number" name="budget" value="<?php echo htmlspecialchars($budget); ?>" required></td>
            </tr>
            <tr>
                <td>Type: </td>
                <td>
                <Select name="type" required>
                        <option <?php if($type =="Youtube Commercial"){echo "selected";} ?> value="Youtube Commercial">Youtube Commercial</option>
                        <option <?php if($type =="Facebook Ad"){echo "selected";} ?>  value="Facebook Ad">Facebook Ad</option>
                        <option <?php if($type =="TV Commercial"){echo "selected";} ?>  value="TV Commercial">TV Commercial</option>
                        <option <?php if($type =="Leaflet"){echo "selected";} ?>  value="Leaflet">Leaflets</option>
                        <option <?php if($type =="Donation"){echo "selected";} ?>  value="Donation">Donations and Charities</option>
                            
                    </Select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" >
                    <input type="submit" name="submit" value="Update Campaign" class="btn-form">
                </td>
            </tr>
        </table>

        </form>


        

    </div>
    <!-- Main Content End -->

<?php
    if (isset($_POST['submit'])) {
        // Get All the Values from Form
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $camp_name = mysqli_real_escape_string($conn, $_POST['camp_name']);
        $start_date = date('y-m-d', strtotime($_POST['start_date']));
        $end_date = date('y-m-d', strtotime($_POST['end_date']));
        $budget = mysqli_real_escape_string($conn, $_POST['budget']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);

        // Update the Values
        $sql2 = "UPDATE tbl_campaign SET
            camp_name = '$camp_name',
            start_date = '$start_date',
            end_date = '$end_date',
            budget = $budget,
            type = '$type'
            WHERE id = $id";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == TRUE) {
            $_SESSION['update'] = "<div class='alert-success'>Campaign Updated Successfully</div>";
            header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
        } else {
            $_SESSION['update'] = "<div class='alert-failed'>Failed to Update Campaign </div>";
            header('location: http://localhost/tritech-crm/manage-campaign/manage-campaign.php');
        }
    }
?>


<?php include('../common/footer.php'); ?> 

