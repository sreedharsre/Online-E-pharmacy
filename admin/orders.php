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
       
        
        #medicineTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th{
            background-color: skyblue;
            color: skyblue;
        }

        #medicineTable, #medicineTable th, #medicineTable td {
            border: 1px solid #ddd;
        }

        #medicineTable th, #medicineTable td {
            padding: 8px;
            text-align: left;
        }

        #medicineTable th {
            background-color: #f4f4f4;
        }

        #searchBar {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #medicineTable tbody {
            display: block;
            max-height: 300px;
            overflow-y: scroll;
        }

        #medicineTable thead, #medicineTable tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        #medicineTable tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
         .rotate-image {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .rotate-image:hover {
            transform: rotate(360deg); /* Rotate effect on hover */
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
                <li><a href="user_reg.php">User Registration</a></li>                
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Login</a></li> -->
            </ul>
        </nav>
    </header>
<?php include 'sidebar.php'; ?>
    <main>
        <div class="container">
            <section class="content"> <img src="pin.png" width='60' height='54' class='rotate-image'>
                <h2>Tracking Details</h2> 
                <input type="number" id="searchBar" placeholder="Search by customer_id" onkeyup="filterTable()">
                <table id="medicineTable">
                    <thead>
                        <tr>
                            <th>INVOICE ID</th>
                            <th>NET TOTAL</th>
                            <th>INVOICE DATE</th>
                            <th>CUSTOMER ID</th>
                            <th>TOTAL AMOUNT</th>
                            <th>TOTAL DISCOUNT</th>
                            <th>TRACKING</th>
                             <th>Update Tracking</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connection.php';

                        $query = "SELECT INVOICE_ID, NET_TOTAL, INVOICE_DATE, CUSTOMER_ID,TOTAL_AMOUNT,TOTAL_DISCOUNT,Tracking FROM INVOICES";
                        
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['INVOICE_ID']}</td>
                                <td>{$row['NET_TOTAL']}</td>
                                <td>{$row['INVOICE_DATE']}</td>
                                <td>{$row['CUSTOMER_ID']}</td>
                                 <td>{$row['TOTAL_AMOUNT']}</td>
                                     <td>{$row['TOTAL_DISCOUNT']}</td>
                                         <td>{$row['Tracking']}</td>
                                <td>
                               <a href='edit_invoice.php?INVOICE_ID={$row['INVOICE_ID']}'>
    <img src='https://upload.wikimedia.org/wikipedia/commons/7/7f/Rotating_earth_animated_transparent.gif' alt='Update tracking' width='60' height='54' class='rotate-image' style='vertical-align: middle;' /><br>
    
    Update tracking
</a> |

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
            const rows = document.querySelectorAll('#medicineTable tbody tr');
            rows.forEach(row => {
                const cell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                if (cell.indexOf(searchValue) !== -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>