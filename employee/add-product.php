<?php include('partials/menu.php')?>

<div class="main-content">
  <div class="wrapper">
       <h1>Add product</h1>
       <br><br>

       <?php
       
       if(isset($_SESSION['upload']))
       {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
       }
       
       ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tittle: </td>
                    <td>
                        <input type="text" name="title" placeholder="tittle of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="20" rows="5" placeholder="Description of the product"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            

                            <?php
                                //create php code to display categories from data base
                                //1.create sql to get all active categries from database
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query
                                $res=mysqli_query($conn, $sql) ;

                                //count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count is > 0 we have categories else we not have categroies

                                if($count > 0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categroy 
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //we do not have category
                                    ?>
                                    <option value="0">No categroy found</option>
                                    <?php
                                }

                                //2.display on dropdown
                            
                            ?>
                            
                         
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>




            </table>

        </form>


        <?php
        
            //check the button is click or not

            if(isset($_POST['submit']))
            {
                //add the food in the database
                
                //1.get the data from form

                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                //check whether radio button checked or not

                if(isset($_POST['featured']))
                {
                    $feautured=$_POST['featured'];
                }
                else
                {
                    $feautured="No";//setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";//setting the default value
                }

                //2.upload the image if selected
                //check whether the select image is clicked or not and upload the iamge only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //image is selkected
                        //A.rename te image
                        //get the extension of selected image(jpg, png...)
                        $ext=end(explode('.', $image_name));

                        //create new name of image
                        $image_name="beauty-picture".rand(0000,9999).".".$ext;//new iamge name

                        //B.upload the image
                        //get the source path and the destination path

                        //source path is the current location of the iamge
                        $src=$_FILES['image']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst="../images/products/".$image_name;

                        //finally upload the food image
                        $upload=move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image 
                            //rediirected to product page with fault message
                            $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                    
                }
                else
                {
                    $image_name="";//setting default value as blank
                }

                //3.insert into database

                //create sql query to save or add product
                $sql2="INSERT INTO tbl_products SET
                    tittle = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$feautured',
                    active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether data insertd or not
                //4.redirect with message to manage food page
                if($res2 == true)
                {
                    //data iserted successfully
                    $_SESSION['add']="<div class='success'>product added successfully</div>";
                    header('location:'.SITEURL.'admin/manage-products.php');
                }
                else
                {
                    //fail to unsert data
                    $_SESSION['add']="<div class='error'>failed to add product</div>";
                    header('location:'.SITEURL.'admin/manage-products.php');
                }            

            }
        
        ?>


  </div>

</div>







<?php include('partials/footer.php')?>