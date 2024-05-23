<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/cart.css">
    <style>
        /* Adjustments for product image size and layout */
        .cart-item-info {
            display: flex;
            align-items: center;
        }
        .cart-item-photo {
            width: 80px; /* Adjust image width as needed */
            margin-right: 20px; /* Add some spacing between image and description */
        }
        .cart-item-title {
            margin-bottom: 5px; /* Add some spacing below title */
        }
        .cart-item-actions {
            display: flex;
            align-items: center;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-controls button {
            background-color: #ff6b81; /* Adjust button color */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin: 0 5px;
        }
        .quantity-controls button:hover {
            background-color: #ff4757; /* Adjust button hover color */
        }
        .quantity-controls input {
            width: 40px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php 
// Include header
include('partials-front/menu.php');


// Retrieve cart items from database
$sql = "SELECT * FROM tbl_cart";
$result = mysqli_query($conn, $sql);
?>

<!-- Cart section -->
<section class="cart-section">
    <div class="container">
        <h2 class="section-heading">Shopping Cart</h2>

        <!-- Display cart items -->
        <div class="cart-items">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <!-- Cart item -->
                    <div class="cart-item">
                        <div class="cart-item-info">
                            <!-- Product photo -->
                            <?php if (!empty($row['product_image'])) : ?>
                                <img src="images/products/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product']; ?>" class="cart-item-photo">
                            <?php else : ?>
                                <img src="images/placeholder.jpg" alt="Placeholder" class="cart-item-photo"> <!-- Placeholder image if product image is not available -->
                            <?php endif; ?>
                            <div>
                                <h3 class="cart-item-title"><?php echo $row['product']; ?></h3>
                                <p class="cart-item-price">$<?php echo $row['price']; ?></p>
                                <div class="quantity-controls">
                                    <form action="update-quantity.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit">-</button>
                                    </form>
                                    <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" readonly>
                                    <form action="update-quantity.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cart-item-actions">
                            <!-- Delete option -->
                            <form action="delete-item.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </div>
                    <!-- End of cart item -->
                <?php endwhile; ?>
            <?php else : ?>
                <!-- No items in cart -->
                <p>Your shopping cart is empty.</p>
            <?php endif; ?>
        </div>

        <!-- Checkout button -->
        <div class="checkout-btn">
            <a href="checkout.html" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

</body>
</html>
