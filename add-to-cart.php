<?php
// Start the session to access session variables
session_start();

// Include database connection
include('partials-front/menu.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID is set and not empty
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        // Sanitize the product ID
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

        // Retrieve product details from tbl_products
        $sql_product = "SELECT * FROM tbl_products WHERE id = '$product_id' AND active = 'Yes'";
        $result_product = mysqli_query($conn, $sql_product);

        if ($result_product) {
            if (mysqli_num_rows($result_product) == 1) {
                $row_product = mysqli_fetch_assoc($result_product);

                // Extract product details
                $product_name = $row_product['tittle'];
                $product_price = $row_product['price'];
                $product_image = $row_product['image_name'];

                // Set the default quantity to 1
                $quantity = 1;

                // Calculate subtotal
                $subtotal = $product_price * $quantity;

                // Insert the product into tbl_cart
                $sql_insert = "INSERT INTO tbl_cart (product, quantity, price, subtotal, product_image) VALUES ('$product_name', '$quantity', '$product_price', '$subtotal', '$product_image')";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert) {
                    // Product added to cart successfully
                    $_SESSION['success_message'] = "Product added to cart successfully!";
                    header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
                    exit();
                } else {
                    // Failed to add product to cart
                    $_SESSION['error_message'] = "Failed to add product to cart. Please try again later.";
                    header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
                    exit();
                }
            } else {
                // Product not found or inactive
                $_SESSION['error_message'] = "Product not found or inactive.";
                header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
                exit();
            }
        } else {
            // Query execution error
            $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
            header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
            exit();
        }
    } else {
        // Product ID is not set or empty
        $_SESSION['error_message'] = "Invalid product ID.";
        header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
        exit();
    }
} else {
    // Redirect to the homepage if accessed directly
    header("Location: index.php");
    exit();
}
?>
