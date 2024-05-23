
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>View Tasks</h1>
        <br><br>

        <?php
        // Get the username from the session
        $employee_username = $_SESSION['user'];

        // SQL query to get tasks assigned to the logged-in employee
        $sql = "SELECT * FROM tbl_tasks WHERE EmployeeUsername='$employee_username'";
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully or not
        if($res == true)
        {
            // Count the number of rows
            $count = mysqli_num_rows($res);

            // Check whether the employee has tasks assigned or not
            if($count > 0)
            {
                // Display tasks in a table
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>Task</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                <?php
                // Fetch and display tasks
                while($row = mysqli_fetch_assoc($res))
                {
                    $task = $row['Task'];
                    $deadline = $row['Deadline'];
                    $status = $row['Status'];
                    ?>
                    <tr>
                        <td><?php echo $task; ?></td>
                        <td><?php echo $deadline; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                            <?php if($status == 'inProgress') { ?>
                                <a href="<?php echo SITEURL; ?>Employee/mark-task-done.php?task=<?php echo $task; ?>&username=<?php echo $employee_username; ?>" class="btn-secondary">Mark as Done</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <?php
            }
            else
            {
                // No tasks assigned
                echo "<div class='error'>No Tasks Assigned</div>";
            }
        }
        else
        {
            // Query failed
            echo "<div class='error'>Failed to Retrieve Tasks</div>";
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
