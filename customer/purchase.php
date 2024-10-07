<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    die("User not logged in.");
}

$sessionUsername = $_SESSION['username']; // Get the session username

// Retrieve POST data
$address = $_POST['address'];
$invoiceId = $_POST['invoice_id'];
$totalAmount = $_POST['total_amount'];
$totalDiscount = $_POST['total_discount'];
$products = $_POST['products']; // This should be an array

// Create invoice
$sql = "INSERT INTO invoices (INVOICE_ID, NET_TOTAL, INVOICE_DATE, TOTAL_AMOUNT, TOTAL_DISCOUNT, Tracking, NAME, address) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddsss", $invoiceId, $totalAmount, $totalDiscount, $invoiceId, $sessionUsername, $address);
if ($stmt->execute()) {
    $response = 'Invoice created successfully.';
} else {
    $response = 'Error: ' . $stmt->error;
}
$stmt->close();
$conn->close();

echo $response;
?>
