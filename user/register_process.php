<?php
$connection = mysqli_connect("localhost", "root", "1234", "color_prediction_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$phone = $_POST["phone"];
$address = $_POST["address"];
$pincode = $_POST["pincode"];
$country = $_POST["country"];
$city = $_POST["city"];
$state = $_POST["state"];

$sql = "INSERT INTO users (name, email, phone, address, pincode, country, city, state, password) VALUES ('$name', '$email', '$phone', '$address', '$pincode', '$country', '$city', '$state', '$password')";

if (mysqli_query($connection, $sql)) {
    echo "User registered successfully";
    
    // Redirect to main index page after 2 seconds
    echo "<script>setTimeout(function(){ window.location.href = 'userindex.php'; }, 2000);</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

mysqli_close($connection);
?>
