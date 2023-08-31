<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: select_role.php"); // Redirect to role selection page
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = mysqli_connect("localhost", "root", "1234", "color_prediction_db");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pincode"];
    // Collect other user details here...

    $sql = "INSERT INTO users (name, email, password, address, city, state, pincode)
            VALUES ('$name', '$email', '$password', '$address', '$city', '$state', '$pincode')";

    if (mysqli_query($connection, $sql)) {
        echo "User added successfully";
        // Redirect to admin dashboard after 2 seconds
        echo "<script>setTimeout(function(){ window.location.href = 'admin_dashboard.php'; }, 2000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add New User</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .admin-logout {
            margin-right: 20px;
        }

        .admin-logout a {
            color: white;
            text-decoration: none;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>Add New User</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Add a New User</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required><br>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required><br>

            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" required><br>



            <input type="submit" value="Add User">
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Add New User
        </p>
    </footer>
</body>

</html>