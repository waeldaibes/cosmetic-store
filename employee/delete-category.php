<?php
    include('../config/constants.php');
    //check whether the id and image name value is set or not
    if(isset($_GET['id'])  && isset($_GET['image_name']))
    {
        //get the value and delete
       // echo 'get value and delete';
       $id=$_GET['id'];
       $image_name=$_GET['image_name'];

       //remove the physical image file if avialable
       if($image_name !="")
       {
            //image is available.so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_session['remove'] = "<div class='error'>failed to remove category image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
       }

       //delete data from datbase
       //sql query delete data from database
       $sql="DELETE FROM tbl_category WhERE id=$id";

       //execute the query
       $res = mysqli_query($conn, $sql);

       //check if the data is delete from database or not
       if($res==true)
       {
        //set success message
        $_SESSION['delete'] = "<div class='success'>Category Deleted successfully.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
       }
       else
       {
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>failed to delete category.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
       }

       //redirect to manange category page with message
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>