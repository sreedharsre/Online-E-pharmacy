<?php
// Include your database connection
include 'db_connection.php';

// Function to fetch total sales based on date
function fetchTotalSales($date) {
    global $conn;

    // Prepare the SQL query to sum the total amount for the given date
    $query = "SELECT SUM(TOTAL_AMOUNT) as total_sales FROM invoices WHERE INVOICE_DATE = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Return the total sales amount
    return $row['total_sales'] !== null ? $row['total_sales'] : 0;
}

// Default to today's date if no date is provided
$date = date('Y-m-d');
if (isset($_POST['invoice_date'])) {
    $date = $_POST['invoice_date'];
}

// Fetch total sales for the selected date
$totalSales = fetchTotalSales($date);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
</head>
<body>
    <h1>Sales Report</h1>

    <!-- Form to select a date -->
    <form method="POST" action="">
        <label for="invoice_date">Select Date:</label>
        <input type="date" id="invoice_date" name="invoice_date" value="<?php echo $date; ?>">
        <input type="submit" value="Show Sales">
    </form>

    <!-- Display the total sales -->
    <p>Sales on <?php echo $date; ?>: <?php echo $totalSales; ?></p>
</body>
</html>
