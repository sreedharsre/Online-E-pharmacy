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

// Get the filter values from POST request
$category = isset($_POST['category']) ? $_POST['category'] : 'all';
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Start building the SQL query
$sql = "SELECT * FROM cart WHERE 1=1"; // Base query with always-true condition

// Add category filter if not 'all'
if ($category !== 'all') {
    $sql .= " AND category = '$category'";
}

// Add search term filter if provided
if (!empty($searchTerm)) {
    $sql .= " AND NAME LIKE '%$searchTerm%'";
}

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Get categories for the filter dropdown
$categoryQuery = "SELECT DISTINCT category FROM cart";
$categories = $conn->query($categoryQuery);

// Check for query execution errors
if (!$categories) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="c.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <h1>E-Pharmacy</h1>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
    </header>
    <?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <form method="POST" action="">
                <div class="search-container">
                    <input type="text" id="search-bar" placeholder="Search for medicines..." name="search" value="<?php echo htmlspecialchars(isset($_POST['search']) ? $_POST['search'] : ''); ?>">
                    <button type="submit">🔍</button>
                </div>
                <div class="filters">
                    <label for="category">Category:</label>
                    <select id="category" name="category">
                        <option value="all">All Categories</option>
                        <?php
                        if ($categories->num_rows > 0) {
                            while ($cat = $categories->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($cat["category"]) . '"' . ($category === $cat["category"] ? ' selected' : '') . '>' . htmlspecialchars($cat["category"]) . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button type="submit">Filter</button>
                </div>
            </form>

            <div class="product-grid">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        
                        // Display product details
                        echo '<div class="product-details">';
                        echo '<p><strong>' . htmlspecialchars($row["NAME"]) . '</strong></p>';
                        echo '<p>Expiry Date: ' . htmlspecialchars($row["EXPIRY_DATE"]) . '</p>';
                        echo '<p>Quantity: ' . htmlspecialchars($row["QUANTITY"]) . '</p>';
                        echo '<p>MRP: $' . htmlspecialchars($row["MRP"]) . '</p>';
                        $discount = isset($row["discount"]) ? $row["discount"] : '0';
                        echo '<p>Discount: ' . htmlspecialchars($discount) . '%</p>';
                        echo '<p>Category: ' . htmlspecialchars($row["category"]) . '</p>';
                        echo '</div>';

                        echo '<button class="remove-from-cart" data-name="' . htmlspecialchars($row["NAME"]) . '">Remove</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<div id="popup">';
                    echo '<p>Sorry, no products found.</p>';
                    echo '<button onclick="closePopup()">Close</button>';
                    echo '</div>';
                }
                ?>
            </div>

            <!-- Buy All Button -->
            <button id="buy-all" class="buy-all">Buy All</button>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // JavaScript functions
        function toggleMenu() {
            // Add logic to toggle the menu visibility
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        $(document).ready(function () {
            $(".remove-from-cart").click(function () {
                var $button = $(this);
                var name = $button.data('name'); // Retrieve NAME value

                console.log('Removing item with NAME:', name); // Debugging line

                if (confirm('Are you sure you want to remove this item?')) {
                    $.post('remove_from_cart.php', { name: name }, function (response) {
                        alert(response);
                        if (response === 'Item removed successfully.') {
                            $button.closest('.product').remove(); // Remove the row from the page
                        }
                    });
                }
            });

            $("#buy-all").click(function () {
                var totalAmount = 0;
                var totalDiscount = 0;
                var products = [];
                
                $(".product").each(function () {
                    var $product = $(this);
                    var name = $product.find('.product-details strong').text();
                    var mrp = parseFloat($product.find('.product-details p:nth-of-type(4)').text().replace('MRP: $', ''));
                    var discount = parseFloat($product.find('.product-details p:nth-of-type(5)').text().replace('Discount: ', '').replace('%', ''));
                    var discountedPrice = mrp - (mrp * (discount / 100));
                    totalAmount += discountedPrice;
                    totalDiscount += mrp * (discount / 100);
                    products.push({ name: name, discountedPrice: discountedPrice });
                });

                // Show the total amount and prompt for address
                var address = prompt("Total amount after discount: $" + totalAmount.toFixed(2) + "\nTotal discount: $" + totalDiscount.toFixed(2) + "\nPlease enter your delivery address:");
                
                if (address) {
                    var confirmation = confirm("Do you want to proceed with the purchase?");
                    if (confirmation) {
                        // Send the purchase details to the server
                        $.post('purchase.php', { address: address, products: products, totalAmount: totalAmount, totalDiscount: totalDiscount }, function (response) {
                            alert(response);
                            if (response === 'Invoice created successfully.') {
                                window.location.href = 'c_home.php'; // Redirect to home page
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>
