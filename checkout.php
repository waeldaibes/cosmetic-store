<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include database connection
include('partials-front/menu.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order details from the form
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $location = $_POST["location"];

    // Retrieve cart items
    $sql_cart = "SELECT * FROM tbl_cart";
    $result_cart = mysqli_query($conn, $sql_cart);

    // Insert each cart item into tbl_order
    while ($row_cart = mysqli_fetch_assoc($result_cart)) {
        $product = $row_cart['product'];
        $price = $row_cart['price'];
        $quantity = $row_cart['quantity'];
        $total = $price * $quantity;

        $sql_order = "INSERT INTO tbl_order (product, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
                      VALUES ('$product', '$price', '$quantity', '$total', NOW(), 'Ordered', '$fullname', '$phone', '$email', '$location')";

        if (!$conn->query($sql_order)) {
            echo "Error: " . $sql_order . "<br>" . $conn->error;
        }
    }

    // Clear the cart after inserting the order
    $sql_clear_cart = "DELETE FROM tbl_cart";
    $conn->query($sql_clear_cart);

    // Send email to the user
    $to = $email;
    $subject = "Order Confirmation";
    $message = "Dear $fullname,<br><br>Your order has been successfully submitted.<br><br>Order Details:<br>Full Name: $fullname<br>Phone: $phone<br>Email: $email<br>Location: $location<br><br>Thank you for your order!";
    $sendFrom = 'waelandbahaa@gmail.com'; 
    $pass = 'hozf spst vnfz ovzk'; // Replace with your email password

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $sendFrom;
        $mail->Password   = $pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($sendFrom, 'Wael daibes');
        $mail->addAddress($to, $fullname);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect to the homepage
    header("Location: index.php");
    exit();
} else {
    // Direct access, redirect to the homepage
    echo "Direct access detected";
    header("Location: index.php");
    exit();
}
?>
