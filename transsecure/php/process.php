<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup_submit'])) {
        // Process signup form data
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $account = $_POST['account_number'];

        // Check if the account number exists in the bank table
        $stmt = $conn->prepare("SELECT * FROM IndianBankUsers WHERE Account_no = ?");
        $stmt->bind_param("s", $account);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $bank_row = $result->fetch_assoc(); // Fetch the result row
            $balance = $bank_row['balance'];
            // Account number exists, proceed with sign-up
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $signup_sql = "INSERT INTO users (username, email, password, account_no, balance) VALUES (?, ?, ?, ?, ?)";
            $signup_stmt = $conn->prepare($signup_sql);
            $signup_stmt->bind_param("sssss", $name, $email, $hashed_password, $account, $balance);
            $signup_stmt->execute();
            $signup_stmt->close();

            // Redirect to index.php with success message
            header("Location: ../index.php?signup_success=1");
            exit();
        } else {
            // Account number does not exist in the bank table
            $error_message = "Invalid account number. Please enter a valid account number.";
            header("Location: ../index.php?error_message=" . urlencode($error_message));
            exit();
        }
    } elseif (isset($_POST['signin_submit'])) {
        // Process sign-in form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query the database to check if the user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_email'] = $user['email'];
            echo "User email set in session: " . $_SESSION['user_email'];
            
            // Redirect to index.php with success message
            header("Location: ../templates/dashboard.php?signin_success=1");
            exit();
        } else {
            // Invalid credentials, set error message
            $error_message = "Invalid email or password. Please try again.";
            // Redirect back to index.php with error message
            header("Location: ../index.php?error_message=" . urlencode($error_message));
            exit();
        }
    }
    header("Location: index.php");
    exit();
}
?>
