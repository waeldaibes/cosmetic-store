<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //1. Get the ID of selected admin
            $id = $_GET['id'];

            //2. Create SQL query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Check if the query is executed or not
            if($res == true)
            {
                //Check whether the data is available
                $count = mysqli_num_rows($res);

                //Check whether we have admin data or not
                if($count == 1)
                {
                    //Get the details
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['FullName'];
                    $username = $row['Username'];
                    $position = $row['Position'];
                }
                else
                {
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Position: </td>
                    <td>
                        <input type="text" name="position" value="<?php echo $position; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
   //Check whether the submit button is clicked or not
   if(isset($_POST['submit']))
   {
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $position = $_POST['position'];

        //Create an SQL query to update admin
        $sql = "UPDATE tbl_admin SET 
                FullName='$full_name',
                Username='$username',
                Position='$position'
                WHERE id='$id'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query is executed or not
        if($res == true)
        {
            //Query executed and admin is updated
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
   }
?>

<?php include('partials/footer.php'); ?>
