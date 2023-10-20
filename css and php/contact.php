<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Database connection
    $db_host = "localhost"; // Change to your MySQL host if it's different
    $db_user = "root"; // Change to your MySQL username
    $db_pass = ""; // Change to your MySQL password
    $db_name = "E-commerce"; // Change to the name of your database

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert form data into the database
    $sql = "INSERT INTO submissions (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
