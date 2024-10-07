<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $mrp = $_POST['mrp'];
    $discount = $_POST['discount'];
    $category = $_POST['category'];
    $image = $_FILES['image']['tmp_name'];

    
    $check_query = "SELECT * FROM medicines_stock WHERE name = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Medicine already exists, please update only.'); window.history.back();</script>";
    } else {
      
        $image_data = addslashes(file_get_contents($image)); 

        $insert_query = "INSERT INTO medicines_stock (name, expiry_date, quantity, mrp, discount, category, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssiddss", $name, $expiry_date, $quantity, $mrp, $discount, $category, $image_data);

        if ($stmt->execute()) {
            echo "<script>alert('Medicine added successfully!'); window.location.href = 'add_med_stock.php';</script>";
        } else {
            echo "<script>alert('Error adding medicine.'); window.history.back();</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
