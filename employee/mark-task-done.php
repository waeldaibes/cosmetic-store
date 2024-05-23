<?php
include('../config/constants.php');

// Check whether task and username are set or not
if(isset($_GET['task']) && isset($_GET['username']))
{
    // Get the task and username
    $task = $_GET['task'];
    $username = $_GET['username'];

    // SQL query to update the task status to completed
    $sql = "UPDATE tbl_tasks SET Status='completed' WHERE Task='$task' AND EmployeeUsername='$username'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res == true)
    {
        // Task marked as done
        $_SESSION['task_status'] = "<div class='success'>Task marked as completed.</div>";
    }
    else
    {
        // Failed to mark the task as done
        $_SESSION['task_status'] = "<div class='error'>Failed to mark task as completed.</div>";
    }

    // Redirect to the view tasks page
    header('location:'.SITEURL.'Employee/view-tasks.php');
}
else
{
    // Redirect to the view tasks page if task and username are not set
    header('location:'.SITEURL.'Employee/view-tasks.php');
}
?>
