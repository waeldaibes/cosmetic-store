


<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Include database connection
include('partials-front/menu.php');

// Debugging output
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order details from the form
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $location = $_POST["location"];

    // Debugging output
    echo "Form submitted: $fullname, $phone, $email, $location";

    // Insert order details into the database
    $sql_order = "INSERT INTO tbl_order (customer_name, customer_contact, customer_email, customer_address, order_date, status)
                  VALUES ('$fullname', '$phone', '$email', '$location', NOW(), 'Ordered')";

    if ($conn->query($sql_order) === TRUE) {
        // Retrieve the inserted order ID
        $order_id = $conn->insert_id;

        // Retrieve cart items and insert them into tbl_order_items
        $sql_cart = "SELECT * FROM tbl_cart";
        $result_cart = mysqli_query($conn, $sql_cart);

       
        // Clear the cart after inserting the order
        $sql_clear_cart = "DELETE FROM tbl_cart";
        $conn->query($sql_clear_cart);

        // Send email to the user
        $to = $email;
        $subject = "Order Confirmation";
        $message = "Dear $fullname,<br><br>Your order has been successfully submitted.<br><br>Order Details:<br>Full Name: $fullname<br>Phone: $phone<br>Email: $email<br>Location: $location<br><br>Thank you for your order!";
        $sendFrom = 'waelandbahaa@gmail.com'; // Replace with your email address
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

            $mail->setFrom($sendFrom, 'wael daibes');
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
        // Error inserting order into database
        echo "Error: " . $sql_order . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Direct access, redirect to the homepage
    echo "Direct access detected";
    header("Location: index.php");
    exit();
}
?>