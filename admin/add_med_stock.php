<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body{
            background-image: linear-gradient(#a51dba,#a12087,#2d47d7);
        }
        .form-container {
            width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-family: Arial, sans-serif;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .form-group input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
           @media (max-width: 768px) {
            .form-container {
                width: 90%;
                margin: 20px auto;
                padding: 20px;
            }

            .form-group label {
                margin-bottom: 5px;
                font-size: 14px;
            }

            .form-group input,
            .form-group select {
                padding: 10px;
                font-size: 14px;
            }

            .form-group input[type="submit"] {
                font-size: 16px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                width: 95%;
                padding: 15px;
            }

            .form-group label {
                margin-bottom: 4px;
                font-size: 13px;
            }

            .form-group input,
            .form-group select {
                padding: 8px;
                font-size: 13px;
            }

            .form-group input[type="submit"] {
                font-size: 15px;
                padding: 8px;
            }
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
    <script>
        function validateForm(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const expiryDate = document.getElementById('expiry_date').value;
            const quantity = document.getElementById('quantity').value;
            const mrp = document.getElementById('mrp').value;
            const discount = document.getElementById('discount').value;
            const image = document.getElementById('image').value;
            const errors = [];

            if (name.trim() === "") {
                errors.push("Medicine Name is required.");
            }

            const expiryRegex = /^\d{2}\/\d{2}$/;
            if (!expiryRegex.test(expiryDate)) {
                errors.push("Expiry Date must be in MM/YY format.");
            } else {
                const [month, year] = expiryDate.split('/').map(Number);
                const now = new Date();
                const expiry = new Date(`20${year}`, month - 1);
                if (expiry < now) {
                    errors.push("Expiry Date must be a future date.");
                }
            }

            if (quantity.trim() === "" || isNaN(quantity) || Number(quantity) <= 0) {
                errors.push("Quantity must be a positive number.");
            }

            if (mrp.trim() === "" || isNaN(mrp) || Number(mrp) <= 0) {
                errors.push("MRP must be a positive number.");
            }

            if (discount !== "" && (isNaN(discount) || Number(discount) < 0 || Number(discount) > 100)) {
                errors.push("Discount must be a number between 0 and 100.");
            }

            if (image.trim() === "") {
                errors.push("Please upload an image.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
            } else {
                document.querySelector('form').submit();
            }
        }  
    </script>
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
            <ul></ul>
        </nav>
    </header>
    <?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <section class="content">
                <h2>ADD NEW PRODUCT</h2>
                <div class="form-container">
                    
                    <form action="insert_medicine.php" method="post" enctype="multipart/form-data" onsubmit="validateForm(event)">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" id="name" name="name" placeholder="enter name">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date (MM/YY)</label>
                            <input type="text" id="expiry_date" name="expiry_date" pattern="\d{2}/\d{2}" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" min="1" placeholder="enter quantity">
                        </div>
                        <div class="form-group">
                            <label for="mrp">MRP</label>
                            <input type="number" id="mrp" name="mrp" step="0.01"placeholder="enter mrp">
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount (%)</label>
                            <input type="number" id="discount" name="discount" min="0" max="100" step="0.01" placeholder="enter discount">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category">
                                <option value="Baby Care">Baby Care</option>
                                <option value="Women Care">Women Care</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" id="image" name="image" accept="image/*" placeholder="upload image">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit">
                        </div>
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
