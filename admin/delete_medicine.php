<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM medicines WHERE ID='$id'";
    mysqli_query($conn, $query);
}

header("Location: manage_medicine.php");
?>