<?php include('partials-front/menu.php'); ?>

    <!-- products sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>products-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Product by its name or id.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php 
            
                //create sql query to display ctegories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res=mysqli_query($conn, $sql);
                //count rows to check whether the categories is available or not
                $count=mysqli_num_rows($res);

                if($count > 0)
                {
                    //catrgories is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title, image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                            <a href="<?php echo SITEURL ?>category-products.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        //check whether the image is available or not
                                        if($image_name == "")
                                        {
                                            //display message
                                            echo "<div class='error'>image not available</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="image not found" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                             </a>

                        <?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>

  
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- Product MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Porducts View</h2>

            <?php 
            //Display Foods that are Active
            $sql = "SELECT * FROM tbl_products WHERE active='Yes'";
            $res=mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                //Foods Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $id = $row['id'];
                    $title = $row['tittle'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="products..." class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>

                            <!-- Change the "Order Now" button to "Add to Cart" -->
                            <form action="add-to-cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //product Not Available 
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Products</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>