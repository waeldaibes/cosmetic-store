<?php include_once('../config/constants.php'); ?>

<html>
<head>
    <title>Add Task - Cosmetics Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Task</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Task: </td>
                        <td><input type="text" name="task" placeholder="Enter Task Name" required></td>
                    </tr>
                    <tr>
                        <td>Employee Username: </td>
                        <td><input type="text" name="employee_username" placeholder="Enter Employee Username" required></td>
                    </tr>
                    <tr>
                        <td>Deadline: </td>
                        <td><input type="date" name="deadline" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Task" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $task = mysqli_real_escape_string($conn, $_POST['task']);
                    $employee_username = mysqli_real_escape_string($conn, $_POST['employee_username']);
                    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

                    // Check if the EmployeeUsername exists in the tbl_admin table
                    $sql_check = "SELECT * FROM tbl_admin WHERE Username='$employee_username'";
                    $res_check = mysqli_query($conn, $sql_check);
                    
                    if(mysqli_num_rows($res_check) > 0)
                    {
                        // EmployeeUsername exists, proceed with insert
                        $sql2 = "INSERT INTO tbl_tasks (Task, EmployeeUsername, Deadline, Status) 
                                 VALUES ('$task', '$employee_username', '$deadline', 'inProgress')";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == true)
                        {
                            $_SESSION['add'] = "<div class='success'>Task added successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-tasks.php');
                        }
                        else
                        {
                            $_SESSION['add'] = "<div class='error'>Failed to add task. Try again later.</div>";
                            header('location:'.SITEURL.'admin/add-task.php');
                        }
                    }
                    else
                    {
                        // EmployeeUsername does not exist
                        $_SESSION['add'] = "<div class='error'>Employee Username does not exist. Please enter a valid Employee Username.</div>";
                        header('location:'.SITEURL.'admin/add-task.php');
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
