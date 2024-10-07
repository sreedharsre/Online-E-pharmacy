<?php
session_start();
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
    <title>Profile</title>
    <link rel="stylesheet" href="cssfile.css">
    <style>
        .sidebar img {
            height: 79%;
        }
        .we {
            color: red;
        }
        .sidebar {
            background-color: white;
        }
        .form-container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 16px;
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
    </style>
    <script>
        function toggleMenu() {
            var nav = document.querySelector('.nav ul');
            nav.classList.toggle('show');
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BSIT Hospital</h1>
            <img src="https://media.istockphoto.com/id/2099357117/vector/heart-pulse-and-heartbeat-heartbeat-lone-cardiogram-beautiful-healthcare-medical-background.jpg?s=612x612&w=0&k=20&c=5agokqkO2Ls-JGCXC5eYl8mH_EO1ZnihZc-pEYtVBOI=" alt="BSIT Hospital">
        </div>
        <nav class="nav">
            <span style="color:black;" class="menu-toggle" onclick="toggleMenu()">&#9776</span>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="appointment_pa.php">Book Appointment</a></li>
                <li><a href="status.php">Status</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        <div class="content">
            <div class="main">
                <div class="AboutUs">
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
            <div class="sidebar">
                <h2 class="we">Welcome</h2>
                <h2><span><?php echo htmlspecialchars($userid); ?></span></h2>
                <img src="https://ouch-cdn2.icons8.com/oukCQ4IbYhPQVNvwn0D8gfKil_TD5uTVrXA7vSTef3c/rs:fit:368:673/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9wbmcvODA3/LzFiMTQ0ZjhjLWVj/OTMtNGNkNy1iNTg2/LTQ0ZmE1NzRlZTY4/ZS5wbmc.png">
            </div>
        </div>
        <footer>
            <p>&copy; 2024 BSIT Hospitals .com</p>
        </footer>
    </div>
</body>
</html>
