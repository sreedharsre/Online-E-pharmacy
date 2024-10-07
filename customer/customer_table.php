<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy Customer Module</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* General Styles */
        body, html {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex-grow: 1;
        }

        /* Header Styles */
        header {
            background-color: #004d61;
            color: #fff;
            padding: 15px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo h1 {
            margin: 0;
            font-size: 24px;
            padding-left: 20px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #007c91;
        }
        .menu-toggle {
            display: none;
            cursor: pointer;
            padding: 10px;
            background-color: #004d61;
            color: white;
            border: none;
            font-size: 16px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            position: fixed;
            top: 60px;
            bottom: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        .sidebar h2 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            border-bottom: 1px solid #555;
            padding-bottom: 10px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #ddd;
            padding: 10px;
            display: block;
            background-color: #444;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: #555;
        }

        /* Main Content Styles */
        main {
            margin-left: 270px;
            padding: 80px 20px 20px;
            flex-grow: 1;
        }
        .content {
            text-align: center;
        }
        .featured-products, .categories, .special-offers {
            margin-bottom: 40px;
        }
        .featured-products h3, .categories h3, .special-offers h3 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .product-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .product-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
            text-align: center;
            transition: transform 0.3s;
        }
        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product-item h4, .product-item p, .product-item a {
            margin: 10px 0;
        }
        .product-item a {
            text-decoration: none;
            color: #007bff;
        }
        .product-item a:hover {
            text-decoration: underline;
        }
        .categories ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .categories ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .categories ul li a:hover {
            text-decoration: underline;
        }

        /* Footer Styles */
        footer {
            background-color: #004d61;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
                margin: 0 20px;
            }
            nav ul {
                display: none;
                flex-direction: column;
                align-items: center;
            }
            nav ul.show {
                display: flex;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            main {
                margin-left: 0;
            }
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
                <li><a href="c_home.php">Home</a></li>
                <li><a href="medicine.php">Medicine Seacrh</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="sidebar">
        <h2>Sidebar Menu</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
    <main>

<h2>Pharmacy Customer Table</h2>

<table>
    <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Prescription Details</th>
    </tr>
    <tr>
        <td>001</td>
        <td>John Doe</td>
        <td>123 Elm Street</td>
        <td>(555) 123-4567</td>
        <td>john.doe@example.com</td>
        <td>Prescription A, Prescription B</td>
    </tr>
    <tr>
        <td>002</td>
        <td>Jane Smith</td>
        <td>456 Oak Avenue</td>
        <td>(555) 987-6543</td>
        <td>jane.smith@example.com</td>
        <td>Prescription C</td>
    </tr>
    <!-- Additional customer rows can be added here -->
</table>
    </main>

</body>
</html>