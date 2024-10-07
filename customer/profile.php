<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?><?php

if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pharmacy"; // Updated database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userid = $_SESSION['username'];
$sql = "SELECT ID, NAME, CONTACT_NUMBER, email, ADDRESS FROM customers WHERE NAME = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Pharmacy</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            /* styles.css */

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
            table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
          
        </header>
    
        
        
        
          <?php include 'sidebar.php'; ?>
            
        </div>
        <main>
          
    <div class="container">
        <div class="intro">
            <h2>Welcome to E-Pharmacy</h2>
           
            
                    <h1>Profile</h1>
                    <table align="center">
                        <tr>
                            <th>ID</th>
                            <td><?php echo htmlspecialchars($customer['ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo htmlspecialchars($customer['NAME']); ?></td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td><?php echo htmlspecialchars($customer['CONTACT_NUMBER']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo htmlspecialchars($customer['ADDRESS']); ?></td>
                        </tr>
                    </table>
            
            
            
            
            
        </div>

               
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
