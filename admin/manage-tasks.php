<?php include('partials/menu.php')?>

<?php include_once('../config/constants.php'); ?>

<html>
<head>
    <title>Task Management - Cosmetics Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Tasks</h1>
            <br><br>

            <?php
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br><br>

            <!-- Add Task Button -->
            <a href="add-task.php" class="btn-primary">Add Task</a>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>Task</th>
                    <th>Employee Username</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // SQL query to get all tasks
                    $sql = "SELECT * FROM tbl_tasks";
                    $res = mysqli_query($conn, $sql);

                    if($res == true)
                    {
                        $count = mysqli_num_rows($res);

                        if($count > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $task = $row['Task'];
                                $employee_username = $row['EmployeeUsername'];
                                $deadline = $row['Deadline'];
                                $status = $row['Status'];
                                ?>

                                <tr>
                                    <td><?php echo $task; ?></td>
                                    <td><?php echo $employee_username; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <?php if($status == 'completed') { ?>
                                            <a href="delete-task.php?task=<?php echo urlencode($task); ?>&employee_username=<?php echo urlencode($employee_username); ?>&deadline=<?php echo urlencode($deadline); ?>&status=<?php echo urlencode($status); ?>" class="btn-danger">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='5' class='error'>No tasks found.</td></tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
