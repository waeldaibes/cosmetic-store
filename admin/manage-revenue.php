<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Revenue</h1>
        <br><br>

        <!-- Filter Form -->
        <form action="" method="GET" class="filter-form">
            <label for="filter">Filter by:</label>
            <select name="filter" id="filter">
                <option value="today">Today</option>
                <option value="last_7_days">Last 7 Days</option>
                <option value="last_month">Last Month</option>
                <option value="last_year">Last Year</option>
            </select>
            <input type="submit" value="Apply" class="btn-primary">
        </form>
        <br><br>

        <?php 
            // Default SQL Query to Get all Orders
            $sql = "SELECT product, price, qty, total FROM tbl_order WHERE status='Delivered'";

            // Check if filter is set
            if(isset($_GET['filter'])) {
                $filter = $_GET['filter'];

                // Modify SQL query based on selected filter
                switch($filter) {
                    case 'today':
                        $sql .= " AND DATE(order_date) = CURDATE()";
                        break;
                    case 'last_7_days':
                        $sql .= " AND order_date >= CURDATE() - INTERVAL 7 DAY";
                        break;
                    case 'last_month':
                        $sql .= " AND order_date >= CURDATE() - INTERVAL 1 MONTH";
                        break;
                    case 'last_year':
                        $sql .= " AND order_date >= CURDATE() - INTERVAL 1 YEAR";
                        break;
                }
            }

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // Error Handling
            if (!$res) {
                die('Query Failed: ' . mysqli_error($conn));
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php 
                // Check whether we have data in the database or not
                if($res == TRUE)
                {
                    // Count Rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res); // Function to get all the rows in database

                    if($count > 0)
                    {
                        // We have data in the database
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            // Get individual data
                            $product = $rows['product'];
                            $price = $rows['price'];
                            $qty = $rows['qty'];
                            $total = $rows['total'];

                            // Display the values in our table
                            ?>
                            <tr>
                                <td><?php echo $product; ?></td>
                                <td>$<?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td>$<?php echo $total; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        // We do not have data in database
                        ?>
                        <tr>
                            <td colspan="4"><div class="error">No Orders Found.</div></td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>

        <?php 
            // Create SQL Query to Get Total Revenue Generated based on filter
            $sql2 = "SELECT SUM(total) AS TotalRevenue FROM tbl_order WHERE status='Delivered'";

            if(isset($filter)) {
                switch($filter) {
                    case 'today':
                        $sql2 .= " AND DATE(order_date) = CURDATE()";
                        break;
                    case 'last_7_days':
                        $sql2 .= " AND order_date >= CURDATE() - INTERVAL 7 DAY";
                        break;
                    case 'last_month':
                        $sql2 .= " AND order_date >= CURDATE() - INTERVAL 1 MONTH";
                        break;
                    case 'last_year':
                        $sql2 .= " AND order_date >= CURDATE() - INTERVAL 1 YEAR";
                        break;
                }
            }

            // Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            // Error Handling
            if (!$res2) {
                die('Query Failed: ' . mysqli_error($conn));
            }

            // Get the Value
            $row2 = mysqli_fetch_assoc($res2);
            // Get the Total Revenue
            $total_revenue = $row2['TotalRevenue'];
        ?>

        <div class="total-revenue">
            <h2>Total Revenue Generated: $<?php echo $total_revenue; ?></h2>
        </div>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>
