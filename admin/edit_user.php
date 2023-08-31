<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: select_role.php"); // Redirect to role selection page
    exit();
}

$connection = mysqli_connect("localhost", "root", "1234", "color_prediction_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $user_id = $_GET["id"];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pincode = $_POST["pincode"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $password = $_POST["password"];

    // Update user details in the database
    $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', address = '$address', pincode = '$pincode', country = '$country', city = '$city', state = '$state', password = '$password' WHERE id = '$user_id'";

    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
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

        .admin-logout a {
            color: white;
            /* Change the color to white */
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
            display: block;
            margin-bottom: 5px;
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

        button[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;

            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Edit User</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Edit User Information</h2>
        <form action="edit_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $user_data['name']; ?>" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo $user_data['phone']; ?>" required><br>
            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $user_data['address']; ?>" required><br>
            <label for="pincode">Pin Code:</label>
            <input type="text" name="pincode" value="<?php echo $user_data['pincode']; ?>" required><br>
            <label for="country">Country:</label>
            <input type="text" name="country" value="<?php echo $user_data['country']; ?>" required><br>
            <label for="city">City:</label>
            <input type="text" name="city" value="<?php echo $user_data['city']; ?>" required><br>
            <label for="state">State:</label>
            <input type="text" name="state" value="<?php echo $user_data['state']; ?>" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php echo $user_data['password']; ?>" required><br>
            <button type="submit">Update User</button>
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Edit User
        </p>
    </footer>
</body>

</html>