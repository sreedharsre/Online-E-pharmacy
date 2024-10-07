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
    <style>
        body{
            background-image: linear-gradient(#a51dba,#a12087,#2d47d7);
        }
        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: 20px auto;
            margin-left: 5%;
        }

        form label {
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }

        form input, form textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 0.5%;
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
       
    </style>
    <script>
        function validateForm() {
            let name = document.getElementById('name').value;
            let contactNumber = document.getElementById('contact_number').value;
            let email = document.getElementById('email').value;
            let address = document.getElementById('address').value;
            let pas = document.getElementById('password').value;

            if (!name) {
                alert('Please enter your name');
                return false;
            }

            if (!contactNumber || !/^\d{10}$/.test(contactNumber)) {
                alert('Please enter a valid contact number (10 digits)');
                return false;
            }

            if (!email || !/\S+@\S+\.\S+/.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            if (!address) {
                alert('Please enter your address');
                return false;
            }

            if (pas === "") {
                alert("Please enter Password.");
                return false;
            } else if (pas.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            } else if (!(/[A-Z]/.test(pas))) {
                alert("Password must contain at least one uppercase letter.");
                return false;
            } else if (!(/[a-z]/.test(pas))) {
                alert("Password must contain at least one lowercase letter.");
                return false;
            } else if (!(/\d/.test(pas))) {
                alert("Password must contain at least one number.");
                return false;
            } else if (!(/[!@#$%^&*]/.test(pas))) {
                alert("Password must contain at least one special character (!@#$%^&*).");
                return false;
            }
            if (confirmPassword === "") {
                alert("Confirm Password is required.");
                return false;
            }
            if (pas !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        function redirectToPage(event) {
            const selectedValue = event.target.value;
            if (selectedValue) {
                window.location.href = selectedValue;
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
            <ul>
                 
            </ul>
        </nav>
    </header>
<?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <section class="content">
                <h2> Welcome to E-Pharmacy </h2><h2>Add Customer</h2>
                    <hr style="border-top: 4px solid #ff5252;">
                <form action="customers_server.php" method="post" onsubmit="return validateForm()">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name">

                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" placeholder="Your contact number">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your email">

                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="Your address"></textarea>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your password">

                    <button type="submit">Submit</button>
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