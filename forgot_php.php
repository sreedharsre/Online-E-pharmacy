<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Username from the form
    $npass = $_POST['npass']; // New password from the form
    $cpass = $_POST['cpass']; // Confirm password from the form
    $userType = $_POST['type']; // User type from the form (Admin or Customer)

    // Check if the password and confirm password match
    if ($npass !== $cpass) {
        echo "<script>alert('Passwords do not match.'); window.location.href = 'forgot_password.php';</script>";
        exit();
    }

    // Encrypt the new password
    $hashedPassword = md5($npass); // Change this to use md5 hashing

    // Determine the table based on user type and check if the user exists
    if ($userType == "Admin") {
        $check_query = $conn->prepare("SELECT * FROM admin_credentials WHERE username = ?");
        $check_query->bind_param("s", $username);
        $update_query = $conn->prepare("UPDATE admin_credentials SET password=? WHERE username=?");
    } elseif ($userType == "Customer") {
        $check_query = $conn->prepare("SELECT * FROM customers WHERE name = ?");
        $check_query->bind_param("s", $username);
        $update_query = $conn->prepare("UPDATE customers SET password=? WHERE name=?");
    } else {
        echo "<script>alert('Invalid user type.'); window.location.href = 'forgot_password.php';</script>";
        exit();
    }

    // Execute the check query
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        // Bind and execute the update query
        $update_query->bind_param("ss", $hashedPassword, $username);
        if ($update_query->execute()) {
            echo "<script>alert('Password updated successfully'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error updating password. Please try again.'); window.location.href = 'forgot_password.php';</script>";
        }
        $update_query->close();
    } else {
        echo "<script>alert('User not found. Please check your username.'); window.location.href = 'forgot_password.php';</script>";
    }

    // Close the check query and connection
    $check_query->close();
    $conn->close();
}
?>