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
            width: 400px;
            height: 550px;
            margin-left: 30%;
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
            font-size: 24px;
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
    var username = document.getElementById("login-username").value;
    var password = document.getElementById("login-password").value;
    var userType = document.getElementById("user-type").value;
    
    if (username == "") {
        alert("Username must be filled out");
        return false;
    }  
    
    if (password == "") {
        alert("Password must be filled out");
        return false;
    }
    

    if (userType == "") {
        alert("Please select a user type");
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
                                
                <section class="featured-products">
                    <div class="login">
                        <form onsubmit="return validateForm()" action="login_server.php" method="post">
                    <h2>Login</h2>
                    <?php  if (isset($_SESSION['umsg'])) : ?>
			<h3>
				<?php 
					echo $_SESSION['umsg'];
					unset($_SESSION['umsg']);
				?>
			</h3>
	            <?php endif ?>
                    <?php  if (isset($_SESSION['upmsg'])) : ?>
			<h3>
				<?php 
					echo $_SESSION['upmsg'];
					unset($_SESSION['upmsg']);
				?>
			</h3>
	            <?php endif ?>
                    User Name:&ensp;<input type="text" id="login-username" name="un">
                    Password:&ensp;&ensp;<input type="password" id="login-password" name="pas">
                    UserType 
                    <select id="user-type" name="type">
                        <option value="">Select</option>
                        <option value="admin">Admin</option>
                        <option value="customer">customer</option>
                        
                    </select>
                    <button type="submit" name="login">Login</button><br>
                    <a href="forgot_pass.php" class="fp">Forgot Password</a><a class="fp" href="user_reg.php">New user ? Register</a>
                </form>
                    </div>
                </section>
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