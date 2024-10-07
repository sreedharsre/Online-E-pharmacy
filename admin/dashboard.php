<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<?php

include 'db_connection.php';


function fetchTotalSales($date) {
    global $conn;

    
    $query = "SELECT SUM(TOTAL_AMOUNT) as total_sales FROM invoices WHERE INVOICE_DATE = ?";

    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();

    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    
    return $row['total_sales'] !== null ? $row['total_sales'] : 0;
}


$date = date('Y-m-d');
if (isset($_POST['invoice_date'])) {
    $date = $_POST['invoice_date'];
}


$totalSales = fetchTotalSales($date);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Pharmacy</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            .sidebar li select {
                width: 100%;
                font-size: 15px;
                background: #555555;
                color: white;
                border: none;
            }

            .grid-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                background-color: #2196F3;
                padding: 10px;
            }

            .grid-item, .grid-ite {
                border: 1px solid #B6B6B6;
                padding: 20px;
                font-size: 20px;
                text-align: center;
                border-radius: 15px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                color: white;
                transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
            }

            .grid-item {
                background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            }

            .grid-item img {
                height: 100px;
                width: 100px;
                border-radius: 50%;
                transition: transform 0.4s ease, filter 0.4s ease;
                filter: drop-shadow(0 4px 4px rgba(0, 0, 0, 0.2));
            }

            .grid-item:hover {
                transform: translateY(-10px) rotate(-3deg);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            }

            .grid-item img:hover {
                transform: scale(1.3);
                filter: brightness(120%);
            }

            .grid-ite {
                background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
            }

            .grid-ite:hover {
                transform: translateY(-5px) rotate(3deg);
                background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
            }

            .logo h1 {
                text-align: center;
                color: #fff;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            }

            .dropbtn {
                background-color: #444444;
                color: white;
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
                background-color:#555555;
            }

            @media (max-width: 600px) {
                .grid-container {
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                }

                .grid-item, .grid-ite {
                    font-size: 18px;
                    padding: 15px;
                }

                .grid-item img {
                    height: 80px;
                    width: 80px;
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
            .sales {
                background-color: #1D84D6;
                font-size: 20px;
                border-radius: 10px;
                padding: 20px;
                margin: 20px 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .sales h1 {
                font-size: 28px;
                color: #333;
                margin-bottom: 20px;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            }

            .sales form {
                margin-bottom: 20px;
            }

            .sales label {
                font-size: 18px;
                color: white;
            }

            .sales input[type="date"] {
                padding: 8px 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin: 10px 0;
                width: calc(100% - 22px);
                max-width: 300px;
            }

            .sales input[type="submit"] {
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .sales input[type="submit"]:hover {
                background-color: #0056b3;
            }
            .sales p span{
                color: #00FF33;
            }
            .sales p {
                font-size: 20px;
                color: white;
                margin-top: 15px;
                text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
            }

            .sales:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

                </ul>
            </nav>
        </header>
        <?php include 'sidebar.php'; ?>
        <main>
            <div class="container">
                <section class="content">
                    <h2>Welcome to BSIT E-Pharmacy Dash Board</h2>
                    <div class="sales">
                        <h1>Sales Report</h1>
                        <form method="POST" action="">
                            <label for="invoice_date"><b>Select Date:</b></label>
                            <input type="date" id="invoice_date" name="invoice_date" value="<?php echo $date; ?>">
                            <input type="submit" value="Show Sales">
                        </form>
                        <p><b>Sales on <italic><?php echo $date; ?>:</italic> <span><?php echo $totalSales; ?>&ensp;Rs</span></b></p>
                    </div>
                    <div class="grid-container">

                        <div class="grid-item">
                            <img src="data:image/jpeg;base64,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">
                        </div>
                        <div class="grid-item">
                            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRMWl9T_nCsbFphrFnu6y9VpPE7OnDk904ueJ8OI2UDwDQtpKqN">
                        </div>
                        <div class="grid-item">
                            <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTnkLkzhSKTPpsVO7cJhnOVBPw9NeYdMH9h9rXD_nMjNIrbnKl_">
                        </div>


                        <div class="grid-ite">
                            <a href="customer.php"><b>Add New Customer</b></a>
                        </div>
                        <div class="grid-ite">
                            <a href="orders.php"><b>Order Tracking</b></a>
                        </div>
                        <div class="grid-ite">
                            <a href="add_med_stock.php"><b>Add New Product</b></a>
                        </div>


                        <div class="grid-item">
                            <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRDzVlcZ6nRSPeqkPEfzsd4nP5yOq-2qGafT0ld4VrnE_ADlB0a">
                        </div>
                        <div class="grid-item">
                            <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcS9-2OVGU1aQC-bosiZF9eRt5PxhNoJbe5_C6MJlTwMTmOR-K0w">
                        </div>
                        <div class="grid-item">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxAhPhr1YcDy7QSjuE4GS2XJx2BW58DS8eO981vzfaM7keJeEk">
                        </div>


                        <div class="grid-ite">
                            <a href="manage_medicine_stock.php"><b>Manage Products</b></a>
                        </div>
                        <div class="grid-ite">
                            <a href="http://localhost/pharma/index.php"><b>Logout</b></a>
                        </div>
                        <div class="grid-ite">
                            <a href="print_invoice.php"><b>Invoice</b></a>
                        </div>
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
