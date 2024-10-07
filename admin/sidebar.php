<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
             <div class="sidebar">
            <h2>Sidebar Menu</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                
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
                        <button class="dropbtn">Products</button>
                        <div class="dropdown-content">
                            <a href="add_med_stock.php">ADD NEW PRODUCT</a>
                            <a href="manage_medicine_stock.php">MANAGE-PRODUCT</a>
                        </div>
                    </div>
                </li>
                <li><a href="orders.php">Tracking</a></li>
                <li><a href="print_invoice.php">Invoice</a></li>
<!--                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Invoice</button>
                        
                        <div class="dropdown-content">
                            <a href="add_invoice.php">Add Invoice</a>
                            <a href="manage_invoice.php">Manage Invoice</a>
                        </div>
                    </div>
                </li>-->
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </div>
    </body>
</html>
