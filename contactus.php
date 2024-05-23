<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            box-sizing: border-box;
        }
        *, *::before, *::after {
            box-sizing: inherit;
        }
        .contact-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .contact-form h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }
        .contact-form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .contact-form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .contact-form input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="contact-form">
        <h2>Contact Us</h2>
        <form action="submit-contact.php" method="POST">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phonenumber">Phone Number:</label>
            <input type="text" id="phonenumber" name="phonenumber">

            <label for="text">Message:</label>
            <textarea id="text" name="text" rows="4" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
