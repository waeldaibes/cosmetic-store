<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>products-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for product.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Products</h2>

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
                // Product not Available
                echo "<div class='error'>Food not found.</div>";
            }
        ?>
        
        <div class="clearfix"></div>

    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
