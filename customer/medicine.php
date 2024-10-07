<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>

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
$sql = "SELECT * FROM medicines_stock WHERE 1=1"; // Base query with always-true condition

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

// Get categories for the filter dropdown
$categoryQuery = "SELECT DISTINCT category FROM medicines_stock";
$categories = $conn->query($categoryQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        main {
            margin-left: 210px;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .search-container, .filters {
            margin-bottom: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px;
        }

        .product {
            border: 1px solid #ddd;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product img {
            max-width: 100%;
            max-height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image fits well */
        }

        .product-details {
            margin-top: 10px;
        }

        .product button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        #popup {
            background-color: #f44336;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr); /* Two columns on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr; /* One column on very small screens */
            }
        }
    </style>
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
                                echo '<option value="' . $cat["category"] . '"' . ($category === $cat["category"] ? ' selected' : '') . '>' . $cat["category"] . '</option>';
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
                        // Convert the BLOB data to base64
                        $imageData = base64_encode($row["image"]);
                        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                        echo '<img src="' . $imageSrc . '" alt="' . $row["NAME"] . '">';
                        echo '<div class="product-details">';
                        echo '<p><strong>' . $row["NAME"] . '</strong></p>';
                        echo '<p>Expiry Date: ' . $row["EXPIRY_DATE"] . '</p>';
                        echo '<p>Quantity: ' . $row["QUANTITY"] . '</p>';
                        echo '<p>MRP: $' . $row["MRP"] . '</p>';
                        echo '<p>Discount: ' . $row["discount"] . '%</p>';
                        echo '<p>Category: ' . $row["category"] . '</p>';
                        echo '</div>';

                        echo '<button class="add-to-cart" data-name="' . htmlspecialchars($row["NAME"]) . '" data-expiry_date="' . htmlspecialchars($row["EXPIRY_DATE"]) . '" data-quantity="' . htmlspecialchars($row["QUANTITY"]) . '" data-mrp="' . htmlspecialchars($row["MRP"]) . '" data-discount="' . htmlspecialchars($row["discount"]) . '" data-category="' . htmlspecialchars($row["category"]) . '">Add to Cart</button>';
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

        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // Example JavaScript functions
        function toggleMenu() {
            // Add logic to toggle the menu visibility
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                var $button = $(this);
                var data = {
                    name: $button.data('name'),
                    expiry_date: $button.data('expiry_date'),
                    quantity: $button.data('quantity'),
                    mrp: $button.data('mrp'),
                    discount: $button.data('discount'),
                    category: $button.data('category')
                    // Removed image field
                };

                $.post('add_to_cart.php', data, function(response) {
                    alert(response); // Show the response from the server
                });
            });
        });
    </script>

</body>
</html>
