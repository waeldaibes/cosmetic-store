<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

                //get the search keyword 
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>
            
            <h2>Categories on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Categories Menu</h2>


            <?php

            //sql to categories based on search keyword
            //$search = burger'
            //"SELECT * FROM tbl_category WHERE title LIKE '%$search%' OR id LIKE '%%'";
            $sql = "SELECT * FROM tbl_category WHERE title LIKE '%$search%' OR id LIKE '%$search%'";

            //execut the query
            $res=mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whether food is available or not 
            if($count > 0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the details
                    $id=$row['id'];
                    $title=$row['title'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    $image_name = $row['image_name'];

                    ?>
                         <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //check whther image name is available or not
                                        if($image_name == "")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            //image is available
                                            ?>
                                                <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $featured ?></p>
                                    <p class="food-detail">
                                        <?php echo $active ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class='error'>Food not found.</div>";
            }
            
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>