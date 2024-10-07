<?php
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];    
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $mrp = $_POST['mrp'];
    $discount=$_POST['discount'];

    
    $query = "UPDATE medicines_stock SET EXPIRY_DATE='$expiry_date', QUANTITY='$quantity', MRP='$mrp',discount='$discount'  WHERE ID=$id";

    
    if (mysqli_query($conn, $query)) {
        
        echo "<script>
                alert('Product stock updated successfully!');
                window.location.href = 'manage_medicine_stock.php';
              </script>";
        exit(); 
    } else {
      
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conn);
?>
