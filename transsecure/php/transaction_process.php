<?php
session_start();

// Include the database connection file
require_once '../php/db.php';

// Fixed sender's account number (you can change this value later)
$fixed_sender_account = "70002004";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_transaction'])) {
    // Get form data
    $receiver_account = $_POST['receiver_account'];
    $amount = $_POST['amount'];
    $status = 'Pending'; // Initial status of the transaction

    // Validate input data (you can add more validation as needed)
    if (!empty($receiver_account) && !empty($amount)) {
        // Check if the receiver account exists in the users table
        $stmt = $conn->prepare("SELECT * FROM users WHERE account_no = ?");
        $stmt->bind_param("s", $receiver_account);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Receiver account exists, proceed with the transaction
            // Insert the transaction into the transaction status table
            $stmt = $conn->prepare("INSERT INTO transaction_status (sender_ac, receiver_ac, amount, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fixed_sender_account, $receiver_account, $amount, $status);
            $stmt->execute();
            $stmt->close();

            // Redirect to a success page or display a success message
            header("Location: transaction_success.php");
            exit();
        } else {
            // Receiver account does not exist, display an error message
            $error_message = "Receiver account not found.";
            // Redirect back to the transaction page with error message
            header("Location: transaction_page.php?error_message=" . urlencode($error_message));
            exit();
        }
    } else {
        // Display an error message if fields are empty
        $error_message = "Please fill in all fields.";
        // Redirect back to the transaction page with error message
        header("Location: transaction_page.php?error_message=" . urlencode($error_message));
        exit();
    }
}
?>
