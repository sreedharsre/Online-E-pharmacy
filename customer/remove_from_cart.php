<?php
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

// Get the NAME from the POST request
$name = isset($_POST['name']) ? $_POST['name'] : '';

if (!empty($name)) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM cart WHERE NAME = ?");
    
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo 'Item removed successfully.';
    } else {
        echo 'Error removing item: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Invalid NAME.';
}

$conn->close();
?>
