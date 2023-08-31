<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: select_role.php"); // Redirect to role selection page
    exit();
}

if (!isset($_SESSION['admin_connection_data'])) {
    die("Database connection data not available.");
}

$connection_data = $_SESSION['admin_connection_data'];

$connection = mysqli_connect($connection_data['host'], $connection_data['username'], $connection_data['password'], $connection_data['database']);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user ID from query parameter
$user_id = $_GET['id'];

// Remove subscription from user
$sql_remove_subscription = "UPDATE users SET subscription_amount = NULL WHERE id = $user_id";

if (mysqli_query($connection, $sql_remove_subscription)) {
    header("Location: admin_dashboard.php"); // Redirect back to admin dashboard
    exit();
} else {
    echo "Error removing subscription: " . mysqli_error($connection);
}
?>