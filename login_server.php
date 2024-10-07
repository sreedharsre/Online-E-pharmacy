<?php
session_start();
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "pharmacy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {

    $username = $_POST['un'];
    $pas = $_POST['pas'];
    $utype = $_POST['type'];

    if ($utype == "admin") {
        $query = "SELECT * FROM admin WHERE userName=? AND password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $pas);
        $stmt->execute();
        $results = $stmt->get_result();
        $user = $results->fetch_assoc();

        if ($user && $user['userName'] == $username && $user['password'] == $pas) {
            $_SESSION['username'] = $username;
            echo "<script> window.location.href='http://localhost/pharma/admin/dashboard.php';</script>";
        } else {
            echo "<script>alert('Wrong username/password combination.'); window.location.href='http://localhost/pharma/login.php';</script>";
        }
    } elseif ($utype == "customer") {
        $query = "SELECT * FROM customers WHERE NAME=? AND password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $pas);
        $stmt->execute();
        $results = $stmt->get_result();
        $user = $results->fetch_assoc();

        if ($user && $user['NAME'] == $username && $user['password'] == $pas) {
            $_SESSION['username'] = $username;
            echo "<script>window.location.href='http://localhost/pharma/customer/c_home.php';</script>";
        } else {
            echo "<script>alert('Wrong username/password combination.'); window.location.href='http://localhost/pharma/login.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with this username and user type.'); window.location.href='http://localhost/pharma/login.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>