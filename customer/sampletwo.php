<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .sidebar li select {
            width: 100%;
            font-size: 15px;
            background: #333;
            color: #fff;
            border: none;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo h1 {
            text-align: center;
            color: #333;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .dropbtn {
            background-color: #555;
            color: #fff;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
            text-align: left;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #666;
        }

        @media (max-width: 600px) {
            .grid-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .grid-item, .grid-ite {
                font-size: 16px;
                padding: 15px;
            }

            .grid-item img {
                height: 80px;
                width: 80px;
            }
        }

        .container {
            background-color: #ffffff; /* Updated to a clean white color */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
        }

        .welcome-container {
            background-color: #f8f9fa; /* Light gray background */
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .welcome-container:hover {
            background-color: #e9ecef; /* Slightly darker gray background on hover */
            transform: scale(1.03); /* Slight zoom effect on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }

        .welcome-container h2 {
            color: #333;
            margin: 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            padding: 10px;
        }

        .grid-item, .grid-ite {
            border-radius: 12px;
            padding: 20px;
            font-size: 18px;
            text-align: center;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .grid-item {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        }

        .grid-item img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            transition: transform 0.3s ease, filter 0.3s ease;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
        }

        .grid-item:hover {
            transform: scale(1.05) rotate(-1deg);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #1e90ff 0%, #00bfff 100%);
        }

        .grid-item img:hover {
            transform: scale(1.15);
            filter: brightness(110%);
        }

        .grid-ite {
            background: linear-gradient(135deg, #ff8c00 0%, #ff4500 100%);
        }

        .grid-ite:hover {
            transform: scale(1.05) rotate(1deg);
            background: linear-gradient(135deg, #ff6347 0%, #ff4500 100%);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .grid-ite a {
            text-decoration: none; /* Remove underline from links */
            color: #fff; /* Ensure text color is white */
        }

        .user-session {
            color: #28a745;
            font-weight: bold;
            font-size: 24px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>E-Pharmacy</h1>
            </div>
            <button class="menu-toggle" onclick="toggleMenu()">Menu</button>
            <nav>
                <ul>
                    <!-- Navigation links can go here -->
                </ul>
            </nav>
        </div>
    </header>
    <?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <div class="welcome-container">
                <h2>Welcome to BSIT E-Pharmacy</h2>
            </div>
            <section class="content">
                <div class="grid-container">
                    <div class="grid-item">
                        <img src="profile.png" alt="Profile">
                    </div>
                    <div class="grid-item">
                        <img src="order.png" alt="Order">
                    </div>
                    <div class="grid-item">
                        <img src="box.png" alt="Box">
                    </div>

                    <div class="grid-ite">
                        <a href="customer.php"><b>View Profile</b></a>
                    </div>
                    <div class="grid-ite">
                        <a href="orders.php"><b>Order Something</b></a>
                    </div>
                    <div class="grid-ite">
                        <a href="add_med_stock.php"><b>My Orders</b></a>
                    </div>

                    <div class="grid-item">
                        <img src="cart.png" alt="Cart">
                    </div>
                    <div class="grid-item">
                        <img src="printer.png" alt="Printer">
                    </div>
                    <div class="grid-item">
                        <img src="shutdown.png" alt="Shutdown">
                    </div>

                    <div class="grid-ite">
                        <a href="manage_medicine_stock.php"><b>Manage Cart</b></a>
                    </div>
                    <div class="grid-ite">
                        <a href="http://localhost/pharma/index.php"><b>Print Invoice</b></a>
                    </div>
                    <div class="grid-ite">
                        <a href="print_invoice.php"><b>Log Out</b></a>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 E-Pharmacy. All rights reserved.</p>
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
