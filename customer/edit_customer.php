<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE ID = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching record: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $updateQuery = "UPDATE customers SET NAME='$name', CONTACT_NUMBER='$contact_number', email='$email', ADDRESS='$address' WHERE ID = $id";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: manage_customer.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Customer</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            /* Additional CSS for form styling */
            .form-container {
                width: 100%;
                max-width: 800px;
                margin: auto;
                padding: 20px;
                background-color: #f4f4f4;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .form-container h2 {
                margin-bottom: 20px;
                text-align: center;
            }

            .form-container input[type="text"], 
            .form-container input[type="email"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .form-container button {
                padding: 10px 15px;
                background-color: #5cb85c;
                border: none;
                color: white;
                cursor: pointer;
                border-radius: 5px;
                width: 100%;
                font-size: 16px;
            }

            .form-container button:hover {
                background-color: #4cae4c;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="logo">
                <h1>E-Pharmacy</h1>
            </div>
            <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="user_reg.php">User Registration</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </header>
        <div class="sidebar">
            <h2>Sidebar Menu</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Invoice</button>
                        <div class="dropdown-content">
                            <a href="add_invoice.php">Add Invoice</a>
                            <a href="manage_invoice.php">Manage Invoice</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Customer</button>
                        <div class="dropdown-content">
                            <a href="http://localhost/pharma/admin/customer.php">Add Customer</a>
                            <a href="manage_customer.php">Manage Customer</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Medicine</button>
                        <div class="dropdown-content">
                            <a href="http://localhost/pharma/admin/add_medicine.php">Add Medicine</a>
                            <a href="manage_medicine.php">Manage Medicine</a>
                            <a href="manage_stock_medicine.php">Manage Medicine stock</a>
                        </div>
                    </div>
                </li>
                <li><a href="#">Help</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <main>
            <div class="container">
                <section class="content">
                    <h2>Edit Customer</h2>
                    <div class="form-container">
                        <form method="POST" action="edit_customer.php">
                            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['NAME']; ?>" required>
                            <label for="contact_number">Contact Number</label>
                            <input type="text" id="contact_number" name="contact_number" value="<?php echo $row['CONTACT_NUMBER']; ?>" required>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo $row['ADDRESS']; ?>" required>
                            <button type="submit">Update</button>
                        </form>
                    </div>
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
