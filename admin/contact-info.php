<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Info</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="contact-info">
        <h2>Contact Information</h2>
        <?php
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cosmetic-store";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data
        $sql = "SELECT FullName, email, phonenumber, text, created_at FROM tbl_contactus";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Full Name</th><th>Email</th><th>Phone Number</th><th>Message</th><th>Date</th></tr>";
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["FullName"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phonenumber"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["text"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No contact information found.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</body>
</html>
