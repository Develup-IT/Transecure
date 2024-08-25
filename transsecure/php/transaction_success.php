<!-- success.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(to right, #3498db, #2c3e50);
            color: #fff;
            padding-top: 60px; /* Adjusted for fixed navbar */
        }

        .success-container {
            text-align: center;
            margin-top: 100px;
        }

        h1 {
            color: white; /* Black text color for Transecure */
            font-size: 50px; /* Increased font size */
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .return-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745; /* Green color for button */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Navbar (if needed) -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Transecure</a>
    <!-- Add other navigation links if needed -->
</nav>

<!-- Success Content -->
<div class="container success-container">
    <h1 class="mt-5">Transaction Successful</h1>
    <p>Your transaction has been sent. Once the transaction is approved, your money will be transferred soon.</p>
    
    <!-- Return to Dashboard Button -->
    <a href="../templates/dashboard.php" class="return-btn">Click to return to Dashboard</a>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
