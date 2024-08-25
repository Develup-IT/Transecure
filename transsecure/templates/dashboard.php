<?php
require_once '../php/db.php';

// Get the logged-in user's account ID (you need to have this information from your authentication process)
$loggedInUserAccountID = 70002004; // Replace with the actual account ID

// Query for pending transactions
$pendingTransactionsQuery = "SELECT * FROM transaction_status WHERE sender_ac = $loggedInUserAccountID AND status = 'pending'";

// Check if the connection is successful before executing the query
if ($conn) {
    $pendingTransactionsResult = $conn->query($pendingTransactionsQuery);

    // Check for errors in the query execution
    if (!$pendingTransactionsResult) {
        die("Query failed: " . $conn->error);
    }
} else {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transecure</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
    body {
        background: linear-gradient(to right, #3498db, #2c3e50);
        color: #fff;
        padding-top: 60px; /* Adjusted for fixed navbar */
    }

    .dashboard-container {
        margin: 20px;
    }

    .navbar {
        background: linear-gradient(to right, #3498db, #2c3e50);
    }

    .navbar-dark .navbar-nav .nav-link {
        color: #fff;
    }

    .transaction-section {
        margin-top: 20px;
    }

    table {
        width: 100%;
        margin-bottom: 20px;
        background-color: #fff; /* White background for the table */
        border-radius: 8px;
        overflow: hidden; /* Added to hide overflow in small screens */
    }

    table th, table td {
        padding: 12px;
        text-align: center; /* Center text in table cells */
        border: none; /* Remove borders between cells */
    }

    table thead {
        background-color: #333; /* Header background color (dark grey) */
        color: #fff; /* Header text color */
    }

    table tbody tr {
        background-color: #f5f5f5; /* Alternate row background color (light grey) */
    }

    h1 {
        color: #000; /* Black text color for Transecure */
      
    }
    h3{
        color:#000
    }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Transecure</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="process_transaction.php">Transfer Money</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="container dashboard-container">
    <h1 class="mt-5">Transecure </h1> 

    <!-- Past Transactions -->
    <div class="transaction-history mt-4">
        <!-- Pending Transactions -->
        <div class="transaction-section">
            <h3>Pending Transactions</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sent to </th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>70002003</td>
                    <td>9000</td>
                    <td>2024-01-17</td>
                </tr>
                <tr>
                    <td>70002005</td>
                    <td>8000</td>
                    <td>2024-02-17</td>
                </tr>
                <tr>
                    <td>70002002</td>
                    <td>7000</td>
                    <td>2024-02-17</td>
                </tr>
            
                </tbody>
            </table>
        </div>

        <!-- Approved Transactions -->
        <div class="transaction-section">
            <h3>Approved Transactions</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sent to</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>70002002</td>
                    <td>4500</td>
                    <td>2022-01-01</td>
                </tr>
                <tr>
                    <td>70002005</td>
                    <td>8056</td>
                    <td>2022-02-01</td>
                </tr>
                <tr>
                    <td>70002002</td>
                    <td>8945</td>
                    <td>2022-02-01</td>
                </tr>
            
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
