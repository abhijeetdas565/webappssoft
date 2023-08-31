<?php
session_start();

$connection = mysqli_connect("localhost", "root", "1234", "color_prediction_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user details based on the logged-in user's email stored in session
$email = $_SESSION['user_email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
$user = mysqli_fetch_assoc($result);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .user-info {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $user['name']; ?>!</h1>

    <div class="user-info">
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
      
    </div>
</body>
</html>
