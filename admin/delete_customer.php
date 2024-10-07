<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM customers WHERE ID = $id";

    if (mysqli_query($conn, $query)) {
        header('Location: manage_customer.php');
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
