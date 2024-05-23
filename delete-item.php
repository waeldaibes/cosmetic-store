<?php
include('partials-front/menu.php');

// Check if the item ID is provided via POST
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Delete the item from the cart table
    $sql = "DELETE FROM tbl_cart WHERE id = '$item_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Item deleted successfully
        header("Location: cart.php");
    } else {
        // Error handling (you can customize this part)
        echo "Error deleting item. Please try again.";
    }
} else {
    // Handle case when item ID is not provided
    echo "Invalid request.";
}
?>
