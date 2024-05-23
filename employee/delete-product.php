<?php
include ('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //process to delete

    //1.get id and image name\
    $id=$_GET['id'];
    $image_name = $_GET['image_name'];



    //2.remove the image if available
    //check whether the image is available or not and delete only if available
    if($image_name !="")
    {
        //it has image AND NEED to remove from folder
        //get the image path
        $path = "../images/products/".$image_name;

        //remove image file from folder
        $remove = unlink($path);//this method will remove the image from folder

        //check whether the image is removed or not
        if($remove == false)
        {
            //failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process of deleting food
            die();
        }


    }

    //3.delete product from database
    $sql = "DELETE FROM tbl_products WHERE id=$id";
    //execut query
    $res=mysqli_query($conn, $sql);
    //check wheter the query executed successfully or not
    //4.redirect to manage food with session message
    if($res ==true)
    {
        //query executed successfully and admin deleted
        //echo "product deleted";
        //created session variable to display message
        $_SESSION['delete'] = "<div class='success'>Product deleted successfully.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-products.php');
    }
    else
    {
        //failed to delete admin
        //echo "failed to deleted";

        $_SESSION['delete']="<div class='error'>Failed to delete product. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    
    
}
else
{
    //redirect to manage product page
    $_SESSION['unauthorize'] = "<div class='error'>unathorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-products.php');
}


?>
