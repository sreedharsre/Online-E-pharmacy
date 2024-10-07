<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Pharmacy</title>
        <link rel="stylesheet" href="styles.css">
        <style>          
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
            #searchBar {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                box-sizing: border-box;
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
                    <h2>Customer Details</h2>
                    <input type="text" id="searchBar" placeholder="Search by Name" onkeyup="filterTable()">
                    <table id="customerTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>CONTACT NUMBER</th>
                                <th>Email</th>
                                <th>ADDRESS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'db_connection.php';

                            $query = "SELECT ID, NAME, CONTACT_NUMBER, EMAIL, ADDRESS FROM customers";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['NAME']}</td>
                <td>{$row['CONTACT_NUMBER']}</td>
                <td>{$row['EMAIL']}</td>
                <td>{$row['ADDRESS']}</td>
                <td>
                  <a href='edit_customer.php?id={$row['ID']}'>Edit</a> | 
                  <a href='delete_customer.php?id={$row['ID']}' onclick='return confirm(\"Are you sure you want to delete this customer?\");'>Delete</a>
                </td>
              </tr>";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>

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

            function filterTable() {
            const searchValue = document.getElementById('searchBar').value.toLowerCase();
                    const rows = document.querySelectorAll('#customerTable tbody tr');
                    rows.forEach(row => {
                    const cell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                            if (cell.indexOf(searchValue) !== - 1) {
                    row.style.display = '';
                    } else {
                    row.style.display = 'none';
                    }
                    });
                    }
        </script>
    </body>
</html>
