<?php include('../common/menu-manage.php'); ?> 
    <div class="top-header">
    <h1>Lead Details</h1>
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
    <!-- Main Content Start -->
    <div class="main-content">
<?php
$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_lead WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result) {
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $rows = mysqli_fetch_assoc($result);

        $id = $rows['id'];
        $full_name = $rows['full_name'];
        $contact = $rows['contact'];
        $status = $rows['status'];
        $email = $rows['email'];
        $campaign_id = $rows['campaign_id'];
        $source = $rows['source'];
        $date = $rows['date'];
    } else {
        header('location: http://localhost/divitech-crm/manage-lead/manage-lead.php');
    }
}
?>



<div class="lead-view">
            <div class="lead-container">
                <p class="lead-header">Lead ID: </p>
                <p> <?php echo htmlspecialchars($id); ?></p>
        </div>
            <div class="lead-container">
                <p class="lead-header">Lead Name: </p>
                <p> <?php echo htmlspecialchars($full_name); ?></p>

            </div>
            <div class="lead-container">
                <p class="lead-header">Contact: </p>
                <p> <?php echo htmlspecialchars($contact); ?></p>
            </div>
            <div class="lead-container">
                <p class="lead-header">Email: </p>
                <p> <?php echo htmlspecialchars($email); ?></p>
            </div>
           
            <div class="lead-container">
                <p class="lead-header">Date: </p>
                <p> <?php echo htmlspecialchars($date); ?></p>
            </div>
            <div class="lead-container">
                <p class="lead-header">Status:  </p>
                <p> <?php echo htmlspecialchars($status); ?> </p>
            </div>
            <div class="lead-container">
                <p class="lead-header">Campaign ID:  </p>
                <p><?php echo htmlspecialchars($campaign_id); ?> </p>
               
            </div>
            <div class="lead-container">
                <p class="lead-header">Source:  </p>
                <p><?php echo htmlspecialchars($source); ?></p> 
            </div>
        </div>

    <!-- Main Content End -->

<?php include('../common/footer.php'); ?> 

