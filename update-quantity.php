<?php
// Include database connection
include('partials-front/menu.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if item ID and action are set
    if (isset($_POST['item_id']) && isset($_POST['action'])) {
        $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
        $action = mysqli_real_escape_string($conn, $_POST['action']);

        // Retrieve current quantity
        $sql = "SELECT quantity FROM tbl_cart WHERE id = '$item_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row['quantity'];

            if ($action == 'increase') {
                $new_quantity = $current_quantity + 1;
            } elseif ($action == 'decrease') {
                $new_quantity = max(1, $current_quantity - 1); // Ensure quantity does not go below 1
            } else {
                $new_quantity = $current_quantity;
            }

            // Update quantity in database
            $sql_update = "UPDATE tbl_cart SET quantity = '$new_quantity' WHERE id = '$item_id'";
            mysqli_query($conn, $sql_update);
        }
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>
