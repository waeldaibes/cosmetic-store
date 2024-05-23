<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Cosmetics Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- login form ends here -->

            <p class="text-center">Created by Wael. Visit our second website - <a href="http://www.alluringelegance.org">Visit my website</a></p>
        </div>

    </body>
</html>

<?php

    // Check if the submit button is clicked
    if(isset($_POST['submit']))
    {
        // Process for login
        // 1. Get the data from login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));


        // 2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // User available
            $row = mysqli_fetch_assoc($res);
            $position = $row['Position'];

            $_SESSION['login'] = "<div class='success'>Login successful.</div>";
            $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it

            // Redirect based on position
            if($position == 'Manager')
            {
                // Redirect to admin page
                header('location:' . SITEURL . 'admin/');
            }
            else if($position == 'Employee')
            {
                // Redirect to employee page
                header('location:' . SITEURL . 'employee/');
            }
        }
        else
        {
            // User not available
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
            // Redirect to login page
            header('location:' . SITEURL . 'admin/login.php');
        }
    }

?>
