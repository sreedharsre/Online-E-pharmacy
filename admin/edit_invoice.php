<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<?php
include 'db_connection.php';

// Initialize $row with default values using array() syntax for older PHP versions
$row = array('INVOICE_ID' => '', 'Tracking' => '');

// Check if INVOICE_ID is set in GET parameters
if (isset($_GET['INVOICE_ID'])) {
    $INVOICE_ID = $_GET['INVOICE_ID'];

    // Ensure INVOICE_ID is numeric to prevent SQL injection
    if (!is_numeric($INVOICE_ID)) {
        die("Invalid INVOICE_ID");
    }
    
    // Use a prepared statement for security
    if ($stmt = $conn->prepare("SELECT * FROM invoices WHERE INVOICE_ID = ?")) {
        $stmt->bind_param("i", $INVOICE_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
        } else {
            echo "Error fetching record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $INVOICE_ID = $_POST['INVOICE_ID'];
    $Tracking = $_POST['Tracking'];

    // Ensure INVOICE_ID is numeric to prevent SQL injection
    if (!is_numeric($INVOICE_ID)) {
        die("Invalid INVOICE_ID");
    }
    
    // Use a prepared statement for security
    if ($stmt = $conn->prepare("UPDATE invoices SET Tracking = ? WHERE INVOICE_ID = ?")) {
        $stmt->bind_param("si", $Tracking, $INVOICE_ID);

        if ($stmt->execute()) {
            header('Location: orders.php');
            exit(); // Always exit after a redirect
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <link rel="stylesheet" href="styles.css">
    <style>
              body{
            background-image: linear-gradient(#a51dba,#a12087,#2d47d7);
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
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
                <!-- <li><a href="index.php">Home</a></li>
                <li><a href="user_reg.php">User Registration</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Login</a></li> -->
            </ul>
        </nav>
    </header>
  <?php include 'sidebar.php';?>
    <main>
        <div class="container">
            <section class="content">
                <h2>Update Tracking</h2>
                <form method="post">
                    <label for="INVOICE_ID">Invoice ID:</label>
                    <input type="text" name="INVOICE_ID" id="INVOICE_ID" value="<?php echo htmlspecialchars($row['INVOICE_ID']); ?>" required><br>
                    <label for="Tracking">Tracking Details:</label>
                    <input type="text" name="Tracking" id="Tracking" value="<?php echo htmlspecialchars($row['Tracking']); ?>" required><br>
                    <button type="submit" name="update">Update</button>
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