<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Employee</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])) // Checking whether the session is set or not 
            {
                echo $_SESSION['add']; // Display session message if set
                unset($_SESSION['add']); // Remove session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>

                <tr>
                    <td>Position: </td>
                    <td>
                        <select name="position">
                            <option value="Manager">Manager</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Employee" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database
    // Check whether the button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button clicked
        // 1. Get the data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // Password encryption with md5
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        // 2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            FullName='$full_name',
            Username='$username',
            Password='$password',
            Position='$position'
        ";

        // 3. Executing query and saving data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // 4. Check whether the query is executed (data is inserted) or not and display appropriate message
        if($res == true)
        {
            // Data inserted
            // Create a session variable to display message
            $_SESSION['add'] = "Employee Added Successfully";
            // Redirect to manage admin page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // Failed to insert data
            // Create a session variable to display message
            $_SESSION['add'] = "Failed to Add Employee";
            // Redirect to add admin page
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>
