<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:home.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connection.php';

// SQL query to fetch data
$sql = "SELECT * FROM medicines_stock";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Pharmacy</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                background-image: linear-gradient(#a51dba,#a12087,#2d47d7);
            }

            #medicineTable {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
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
            img {
                max-width: 100px;
                height: auto;
            }

            /* Table styling */
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 10px;
            }

            table, th, td {
                border: 2px solid #ddd;
            }

            th, td {
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            tbody tr:nth-child(odd) {
                background-color: #f9f9f9;
            }

            tbody tr:nth-child(even) {
                background-color: #fff;
            }

            table {
                border-spacing: 0;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* New CSS for the Update Stock button */
            .update-btn {
                padding: 5px 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                text-align: center;
            }

            .update-btn:hover {
                background-color: #45a049;
            }
            /* Ensure table cells align content to the middle vertically */
            #medicineTable td {
                vertical-align: middle;
                padding: 8px;
            }

            /* Update Stock button styling */
            .update-btn {
                padding: 5px 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                text-align: center;
                display: inline-block; 
                white-space: nowrap; 
            }
            .rotate-image {
            display: inline-block;
            transition: transform 0.3s ease;
        }

            .update-btn:hover {
                background-color: #45a049;
            }


            #medicineTable td {
                font-size: 14px;
                text-align: left;
            }

            @media screen and (max-width: 600px) {
                #medicineTable thead {
                    display: none;
                    background: white;
                }

                #medicineTable, #medicineTable tbody, #medicineTable tr, #medicineTable td {
                    display: block;
                    width: 100%;
                }

                #medicineTable tr {
                    margin-bottom: 15px;
                }

                #medicineTable td {
                    text-align: right;
                    padding-left: 50%;
                    position: relative;
                }

                #medicineTable td::before {
                    content: attr(data-label);
                    position: absolute;
                    left: 0;
                    width: 50%;
                    padding-left: 15px;
                    font-weight: bold;
                    text-align: left;
                }

                img {
                    
                    max-width:45%;
                    height: 45px;
                    
                }

                .update-btn {
                    width: 40%;
                    box-sizing: border-box; 
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
#cart-icon {
    position: fixed;
    top: 20px;
    right: 20px;
    font-size: 32px;
}

.fly-item {
    position: relative;
    display: inline-block;
    font-size: 24px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.fly-item.animate {
    position: fixed;
    z-index: 999;
    animation: fly-to-cart 1s ease forwards;
}

@keyframes fly-to-cart {
    0% {
        transform: translate(0, 0);
        opacity: 1;
    }
    100% {
        transform: translate(calc(100vw - 40px), -calc(100vh - 40px));
        opacity: 0;
    }
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

                    <h2>Product Details & Product Stock's</h2>
                    <input type="text" id="searchBar" placeholder="Search by Name" onkeyup="filterTable()">

                    <table id="medicineTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Expiry Date</th>
                                <th>Quantity</th>
                                <th>MRP</th>
                                <th>Discount</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Update Stock</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td data-label="ID"><?php echo htmlspecialchars($row['ID']); ?></td>
                                    <td data-label="Name"><?php echo htmlspecialchars($row['NAME']); ?></td>
                                    <td data-label="Expiry Date"><?php echo htmlspecialchars($row['EXPIRY_DATE']); ?></td>
                                    <td data-label="Quantity"><?php echo htmlspecialchars($row['QUANTITY']); ?></td>
                                    <td data-label="MRP"><?php echo htmlspecialchars($row['MRP']); ?></td>
                                    <td data-label="Discount"><?php echo htmlspecialchars($row['discount']); ?></td>
                                    <td data-label="Category"><?php echo htmlspecialchars($row['category']); ?></td>
                                    <td data-label="Image">
                                        <?php if (!empty($row['image'])) : ?>
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="Medicine Image">
                                        <?php else : ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                 


                                    <td data-label="Update Stock">
                                        <a href="edit_medicine_stock.php?id=<?php echo $row['ID']; ?>" class="update-btn"><img src='https://mir-s3-cdn-cf.behance.net/project_modules/disp/dab60938212491.5968c68fa9113.gif' alt='Update tracking' width='550' height='20' class='rotate-image' style='vertical-align: middle;' /><br>Update Stock</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
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
            const search = document.getElementById('searchBar').value.toLowerCase();
                    const table = document.getElementById('medicineTable');
                    const rows = table.getElementsByTagName('tr');
                    for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
                    const name = cells[1] ? cells[1].textContent.toLowerCase() : '';
                    if (name.indexOf(search) > - 1) {
            rows[i].style.display = "";
            } else {
            rows[i].style.display = "none";
            }
            }
            }              
        </script>
    </body>
</html>
