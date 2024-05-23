<?php include_once('../config/constants.php'); ?>

<?php
    if(isset($_GET['task']) && isset($_GET['employee_username']) && isset($_GET['deadline']) && isset($_GET['status']))
    {
        // Get the details of the task to be deleted
        $task = urldecode($_GET['task']);
        $employee_username = urldecode($_GET['employee_username']);
        $deadline = urldecode($_GET['deadline']);
        $status = urldecode($_GET['status']);

        // Create SQL query to delete the task
        $sql = "DELETE FROM tbl_tasks WHERE Task='$task' AND EmployeeUsername='$employee_username' AND Deadline='$deadline' AND Status='$status'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully or not
        if($res == true)
        {
            // Task deleted successfully
            $_SESSION['delete'] = "<div class='success'>Task deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-tasks.php');
        }
        else
        {
            // Failed to delete task
            $_SESSION['delete'] = "<div class='error'>Failed to delete task. Try again later.</div>";
            header('location:'.SITEURL.'admin/manage-tasks.php');
        }
    }
    else
    {
        // Redirect to manage tasks page if required parameters are not set
        header('location:'.SITEURL.'admin/manage-tasks.php');
    }
?>
