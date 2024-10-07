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

// Handle the purchase request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address'])) {
    $address = $conn->real_escape_string($_POST['address']);
    $totalAmount = floatval($_POST['totalAmount']);
    $totalDiscount = floatval($_POST['totalDiscount']);
    $invoiceId = 'INV' . time(); // Generate a unique invoice ID
    $name = $_SESSION['username']; // Assuming session name is stored in 'username'

    // Insert invoice into the database
    $insertInvoice = "INSERT INTO invoices (INVOICE_ID, NET_TOTAL, INVOICE_DATE, TOTAL_AMOUNT, TOTAL_DISCOUNT, Tracking, NAME, address)
                      VALUES (?, ?, NOW(), ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertInvoice);
    $stmt->bind_param("ssdssss", $invoiceId, $totalAmount, $totalAmount, $totalDiscount, $invoiceId, $name, $address);
    $stmt->execute();
    $stmt->close();

    // Optionally, clear the cart here if needed
    $clearCart = "DELETE FROM cart WHERE 1=1";
    $conn->query($clearCart);

    echo "Order created successfully.";
    exit;
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
    <style>
        /* Inline CSS */
        #customerTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #customerTable, #customerTable th, #customerTable td {
            border: 1px solid #ddd;
        }

        #customerTable th, #customerTable td {
            padding: 8px;
            text-align: left;
        }

        #customerTable th {
            background-color: #f4f4f4;
        }

        #customerTable tbody {
            display: block;
            max-height: 300px;
            overflow-y: auto;
        }

        #customerTable thead, #customerTable tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #customerTable tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .purchase-form {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>E-Pharmacy</h1>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
    </header>
    <?php include 'sidebar.php'; ?>
    </div>
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
                        // Check for empty product values and skip if necessary
                        if (empty($row["NAME"]) || empty($row["MRP"])) {
                            continue;
                        }

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
                    echo '<p>Sorry, no products found.</p>';
                }
                ?>
            </div>

            <!-- Buy All Button -->
            <button id="buy-all" class="buy-all"> Click here to </button>

            <!-- Purchase Form -->
            <div class="purchase-form">
                <h3>Enter your Delivery Details</h3>
                <p>Total Amount: $<span id="total-amount">0.00</span></p>
                <p>Total Discount: $<span id="total-discount">0.00</span></p>
                <form id="purchase-form" method="POST">
                    <label for="address">Delivery Address:</label>
                    <textarea id="address" name="address" rows="4" required></textarea>
                    <input type="hidden" id="total-amount-hidden" name="totalAmount">
                    <input type="hidden" id="total-discount-hidden" name="totalDiscount">
                    <button type="submit">Confirm Purchase</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // JavaScript functions
        function toggleMenu() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('show');
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }

        $(document).ready(function () {
            $(".remove-from-cart").click(function () {
                var $button = $(this);
                var name = $button.data('name'); // Retrieve NAME value

                console.log('Removing item with NAME:', name); // Debugging line

                if (confirm('Are you sure you want to remove this item?')) {
                    $.post('remove_from_cart.php', { name: name }, function (response) {
                        if (response === 'Item removed successfully.') {
                            $button.closest('.product').remove(); // Remove the row from the page
                        } else {
                            alert(response);
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

                // Update hidden fields and show the purchase form
                $("#total-amount").text(totalAmount.toFixed(2));
                $("#total-discount").text(totalDiscount.toFixed(2));
                $("#total-amount-hidden").val(totalAmount.toFixed(2));
                $("#total-discount-hidden").val(totalDiscount.toFixed(2));

                $(".purchase-form").show();
            });

            // Handle form submission
            $("#purchase-form").submit(function (event) {
                event.preventDefault();
                var address = $("#address").val();
                var totalAmount = $("#total-amount-hidden").val();
                var totalDiscount = $("#total-discount-hidden").val();

                $.post('', { address: address, totalAmount: totalAmount, totalDiscount: totalDiscount }, function (response) {
                    alert(response);
                    if (response === ' order Success -Invoice created successfully.') {
                        // Optionally, clear the cart on the server-side
                        $(".product").remove(); // Remove all products from the page
                        $(".purchase-form").hide(); // Hide the purchase form
                    }
                });
            });
        });
    </script>
</body>
</html>