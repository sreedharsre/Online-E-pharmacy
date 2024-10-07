<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<?php
// Include your database connection file
include 'db_connection.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch the medicine details
    $query = "SELECT * FROM medicines_stock WHERE ID = $id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful and if the medicine exists
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the medicine details
        $row = mysqli_fetch_assoc($result);

        // Extracting expiry date in MM/YY format
        $expiry_date = $row['EXPIRY_DATE'];
    } else {
        echo "Medicine not found!";
        exit();
    }
} else {
    echo "No medicine ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine - E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
                body{
            background-image: linear-gradient(#a51dba,#a12087,#2d47d7);
        }
        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: 20px auto;
        }

        form label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input, form textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }
        .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 20px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.user-session {
    margin-left:auto ;
    color: #33ff33;
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 30px;
    margin-right: 50px;
}
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>E-Pharmacy</h1>
        </div>
        <div class="user-session">
             <?php echo htmlspecialchars($userid); ?>
            </div>
        <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
        <nav>
            <ul>
                <!-- Menu items here -->
            </ul>
        </nav>
    </header>
   <?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <section class="content">
                <h2>Edit Medicine</h2>
                <form action="update_medicine_stock.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['NAME']; ?>" readonly>
                    <label for="expiry_date">Expiry Date (MM/YY):</label>
                    <input type="text" id="expiry_date" name="expiry_date" value="<?php echo $expiry_date; ?>">

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="<?php echo $row['QUANTITY']; ?>">

                    <label for="mrp">MRP:</label>
                    <input type="text" id="mrp" name="mrp" value="<?php echo $row['MRP']; ?>">

                    <label for="discount">DISCOUNT:</label>
                    <input type="number" id="discount" name="discount" value="<?php echo $row['discount']; ?>">

                    <button type="submit">Update Stock</button>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('show');
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>
