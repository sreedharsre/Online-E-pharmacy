<?php
// Include database connection
include 'db_connect.php';

// Query to fetch Baby Care products
$sql_baby = "SELECT * FROM products WHERE category = 'Baby Care'";
$result_baby = $conn->query($sql_baby);

// Query to fetch Women Care products
$sql_women = "SELECT * FROM products WHERE category = 'Women Care'";
$result_women = $conn->query($sql_women);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy - Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Baby Care Products</h2>
<div class="product-grid">
    <?php
    if ($result_baby->num_rows > 0) {
        while($row = $result_baby->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
            echo "<div class='product-details'>";
            echo "<p><strong>" . $row['product_name'] . "</strong></p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Discount: " . $row['discount'] . "% Off</p>";
            echo "<p>Expiry Date: " . $row['expiry_date'] . "</p>";
            echo "</div>";
            echo "<form action='add_to_cart.php' method='POST'>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' value='1' min='1'>";
            echo "<button type='submit'>Add to Cart</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No Baby Care products found.</p>";
    }
    ?>
</div>

<h2>Women Care Products</h2>
<div class="product-grid">
    <?php
    if ($result_women->num_rows > 0) {
        while($row = $result_women->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
            echo "<div class='product-details'>";
            echo "<p><strong>" . $row['product_name'] . "</strong></p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Discount: " . $row['discount'] . "% Off</p>";
            echo "<p>Expiry Date: " . $row['expiry_date'] . "</p>";
            echo "</div>";
            echo "<form action='add_to_cart.php' method='POST'>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' value='1' min='1'>";
            echo "<button type='submit'>Add to Cart</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No Women Care products found.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>