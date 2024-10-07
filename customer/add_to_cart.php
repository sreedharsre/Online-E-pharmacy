<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "You need to be logged in to add items to your cart.";
    exit();
}

$userid = $_SESSION['username'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize POST data
$name = $conn->real_escape_string($_POST['name']);
$expiry_date = $conn->real_escape_string($_POST['expiry_date']);
$quantity = $conn->real_escape_string($_POST['quantity']);
$mrp = $conn->real_escape_string($_POST['mrp']);
$discount = $conn->real_escape_string($_POST['discount']);
$category = $conn->real_escape_string($_POST['category']);

$sql = "INSERT INTO cart (NAME, EXPIRY_DATE, QUANTITY, MRP, DISCOUNT, category)
        VALUES ('$name', '$expiry_date', '$quantity', '$mrp', '$discount', '$category')";

if ($conn->query($sql) === TRUE) {
    echo "New item added to cart successfully!";
} else {
    // Handle SQL errors
    if ($conn->errno == 1062) {
        echo "Medicine already exists, please update only.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
