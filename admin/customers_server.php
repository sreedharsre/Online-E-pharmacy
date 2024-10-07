<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pharmacy";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Check for duplicate entries
    $check_query = $conn->prepare("SELECT * FROM customers WHERE name = ? OR contact_number = ? OR email = ?");
    $check_query->bind_param("sss", $name, $contact_number, $email);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('User already exists. Please try with different details.'); window.location.href = 'customer.php';</script>";
    } else {
        // Encrypt the password
       // $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Encrypt the password

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO customers (name, contact_number, email, address, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $contact_number, $email, $address, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('New customer added successfully'); window.location.href = 'customer.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'customer.php';</script>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the check query and connection
    $check_query->close();
    $conn->close();
}
?>
