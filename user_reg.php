<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        .login {
            border: 1px solid black;
            width: 600px;
            height: 650px;
            margin-left: 25%;
            background: url('https://img.lovepik.com/free-png/20211107/lovepik-business-building-environmental-map-png-image_400437803_wh1200.png');
            color: white;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.75);
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }
        form {
            display: block;
            box-sizing: border-box;
            padding: 40px;
            width: 100%;
            height: 100%;
            backdrop-filter: brightness(40%);
            flex-direction: column;
            display: flex;
            gap: 5px;
        }
        h1 {
            font-weight: normal;
            font-size: 40px;
            font-family: initial;
            text-shadow: 0px 0px 2px rgba(0,0,0,0.5);
            margin-bottom: 20px; /* Adjusted margin */
        }
        .error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }
        label {
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
            padding-left: 10px;
        }
        input{
            background: rgba(255, 255, 255, 0.3);
            height: 40px;
            line-height: 40px;
            border-radius: 20px;
            padding: 0px 20px;
            border: none;
            margin-bottom: 20px;
            color: white;
        }
        .fp{
            color: white;
        }
        button {
            background: rgb(45, 126, 231);
            height: 40px;
            line-height: 40px;
            border-radius: 40px;
            border: none;
            margin: 10px 0px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
            color: white;
        }
        #user-type {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 20px;
        }
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            nav ul {
                display: none;
                flex-direction: column;
                background: #0073e6;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                padding: 10px;
            }
            nav ul.show {
                display: flex;
            }
            .sidebar {
                left: -250px;
            }
            .sidebar.show {
                left: 0;
            }
            .login {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 480px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            .logo, .menu-toggle {
                margin-bottom: 2px;
            }
            nav ul {
                top: 80px;
            }
            .sidebar {
                width: 100%;
            }
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
    </script>
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
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="sidebar">
     
       <img src="https://cdn3d.iconscout.com/3d/premium/thumb/man-holding-login-form-2937688-2426390.png" alt="Login Image">
       
    </div>
    <main>
        <div class="container">
            <section class="content">
                

                <div class="login">
                    <form action="user_reg_server.php" method="post" onsubmit="return validateForm()">
                        <h1>User Registration</h1>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name">

                        <label for="contact_number">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" placeholder="Your contact number">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your email">

                        <label for="address">Address</label>
                        <input id="address" name="address" placeholder="Your address">

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your password">

                        <button type="submit">Submit</button>
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