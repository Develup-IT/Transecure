<?php
session_start();
require_once '../php/signin.php';

// Check if the user is logged in
// if (!isset($_SESSION['email'])) {
//     // Redirect to the sign-in page if the user is not logged in
//     header("Location: signin.php");
//     exit();
// }

// Retrieve the username and account number from the session
$username = $_SESSION['username'];
$account_number = $_SESSION['account_no'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome , <?php echo $username; ?>!</h1>
    <p>Your account number is: <?php echo $account_number; ?></p>
    <!-- Other dashboard content goes here -->
</body>
</html>
