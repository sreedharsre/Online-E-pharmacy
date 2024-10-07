<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE cart SET quantity = '$quantity' WHERE cart_id = '$cart_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cart updated successfully";
    } else {
        echo "Error updating cart: " . $conn->error;
    }
}

$conn->close();
header("Location: view_cart.php");
?>