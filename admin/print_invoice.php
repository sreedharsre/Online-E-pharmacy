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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f0f8ff; 
        }

        .logo h1 {
            text-align: center;
            color: white; 
        }

        .sidebar li select {
            width: 100%;
            padding: auto;
            font-size: 15px;
            background: #555555;
            color: white;
            border: none;
        }

        .grid-container {
            width: 100%;
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #B6B6B6;
            padding: 10px;
            font-size: 10px;
            text-align: center;
        }

        .grid-item img {
            height: 50px;
            width: 50px;
        }

        .grid-ite {
            background-color: #A5B0C7;
            border: 1px solid #B6B6B6;
            padding: 5px;
            font-size: 20px;
            text-align: center;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: #444444;
            color: white;
            padding: 10px;
            border: none;
            width: 400%;
            overflow: hidden;
            cursor: pointer;
            border-radius: 5px;
            text-align: left;
            transition: background-color 0.3s ease;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #555555;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #555555;
        }

        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background-color: #f9e0ec; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid #ddd;
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .form-container:hover {
            transform: scale(1.02); 
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #333; 
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #555; 
        }

        .form-container input {
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease, box-shadow 0.3s ease; 
        }

        .form-container input:focus {
            border-color: #4CAF50; 
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.2); 
            outline: none;
        }

        .form-container button {
            padding: 12px 24px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease; 
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        h1, h2 {
            text-align: center;
            color: #333; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            background-color: skyblue;
        }

        th {
            background-color: pink;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        @media print {
            body {
                background-color: greenyellow;
                color: greenyellow;
                margin: 0;
                padding: 0;
                border: none;
            }

            header, footer, .no-print {
                display: none;
            }

            .container {
                width: 100%;
                padding: 0;
                border: none;
            }

            table {
                border: 2px solid greenyellow;
                border-collapse: collapse;
            }

            h1 {
                background-color: orange;
                color: orange;
            }

            th {
                background-color: pink;
                color: #ffffff;
                font-weight: bold;
            }

            td {
                background-color: skyblue;
                color: skyblue;
            }

            .button {
                background-color: white;
                color: white;
                border: 1px solid white;
                text-decoration: none;
                display: inline-block;
                padding: 10px 20px;
                font-size: 1px;
            }

            .button:hover {
                background-color: white;
                border-color: white;
            }

            .page-break {
                page-break-before: always;
                margin: 20px 0;
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
                <!-- <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Login</a></li> -->
            </ul>
        </nav>
    </header>
    <?php include 'sidebar.php'; ?>
    <main>
        <?php
     
        include 'db_connection.php';

     
        $INVOICE_ID = '';
        $invoiceDetails = null;

      
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['INVOICE_ID']) && !empty($_POST['INVOICE_ID'])) {
            $INVOICE_ID = $_POST['INVOICE_ID'];

         
            if (is_numeric($INVOICE_ID)) {
              
                if ($stmt = $conn->prepare("SELECT INVOICE_ID, NET_TOTAL, INVOICE_DATE, CUSTOMER_ID, TOTAL_AMOUNT, TOTAL_DISCOUNT, Tracking, Name FROM invoices WHERE INVOICE_ID = ?")) {
                    $stmt->bind_param("i", $INVOICE_ID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    
                    if ($row = $result->fetch_assoc()) {
                        $invoiceDetails = $row;
                    } else {
                        $invoiceDetails = "No record found for INVOICE_ID = " . htmlspecialchars($INVOICE_ID);
                    }
                    $stmt->close();
                } else {
                    $invoiceDetails = "Error preparing statement: " . $conn->error;
                }
            } else {
                $invoiceDetails = "Invalid INVOICE_ID format.";
            }
        }

        mysqli_close($conn);
        ?>

        <div class="form-container">
            <?php if (!$invoiceDetails): ?>
                <h2>Enter Invoice ID</h2>
                <form method="post">
                    <label for="INVOICE_ID">Invoice ID:</label>
                    <input type="text" name="INVOICE_ID" id="INVOICE_ID" value="<?php echo htmlspecialchars($INVOICE_ID); ?>" required>
                    <button class="button" type="submit">Fetch Details</button>
                </form>
            <?php else: ?>
                <?php if (is_array($invoiceDetails)): ?>
                    <h1>BSIT Pharmacy</h1>
                    <h2>Invoice Details</h2>
                    <table>
                        <tr>
                            <th>Invoice ID</th>
                            <td><?php echo htmlspecialchars($invoiceDetails['INVOICE_ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo htmlspecialchars($invoiceDetails['Name']); ?></td>
                        </tr>
                        <tr>
                            <th>Net Total</th>
                            <td>$<?php echo number_format($invoiceDetails['NET_TOTAL'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Invoice Date</th>
                            <td><?php echo htmlspecialchars($invoiceDetails['INVOICE_DATE']); ?></td>
                        </tr>
                        <tr>
                            <th>Customer ID</th>
                            <td><?php echo htmlspecialchars($invoiceDetails['CUSTOMER_ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>$<?php echo number_format($invoiceDetails['TOTAL_AMOUNT'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Total Discount</th>
                            <td>$<?php echo number_format($invoiceDetails['TOTAL_DISCOUNT'], 2); ?></td>
                        </tr>
                        <tr>
                            <th>Tracking</th>
                            <td><?php echo htmlspecialchars($invoiceDetails['Tracking']); ?></td>
                        </tr>
                    </table>
                    <br>
                    <button class="button" onclick="window.print()">Print Invoice</button>
                    <a href="print_invoice.php" class="button">Search Invoice</a>
                <?php else: ?>
                    <p><?php echo htmlspecialchars($invoiceDetails); ?></p>
                <?php endif; ?>
            <?php endif; ?>
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