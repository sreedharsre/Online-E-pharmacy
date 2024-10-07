<?php
$servername = "localhost";
$username = "root"; // Change this if your MySQL username is different
$password = ""; // Change this if your MySQL password is different
$dbname = "pharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = $_POST['medicine_name'];
    $packing = $_POST['packing'];
    $genericname = $_POST['genericname'];

    $check_query = $conn->prepare("SELECT * FROM medicines WHERE NAME = ?");
    if ($check_query === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $check_query->bind_param("s", $medicine_name);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Medicine already exists.'); window.location.href = 'add_med_stock.php';</script>";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO medicines (NAME, PACKING, TYPE_MEDICINE) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sss", $medicine_name, $packing, $genericname);
        
        if ($stmt->execute()) {
            echo "<script>alert('New medicine added successfully'); window.location.href = 'add_med_stock.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'add_med_stock.php';</script>";
        }
        $stmt->close();
    }
    $check_query->close();
    $conn->close();
}
?>
