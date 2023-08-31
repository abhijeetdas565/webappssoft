<?php
session_start(); // Start the session

$connection = mysqli_connect("localhost", "root", "1234", "color_prediction_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST["email"];
$password = $_POST["password"];


// For simplicity, we'll assume the user is authenticated

// If authentication is successful, store user email in session
$_SESSION['user_email'] = $email;

// Redirect to user_dashboard.php
header("Location: user_dashboard.php");
exit();

?>
