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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    $user_id = $_POST["id"];

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id = '$user_id'";

    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete User</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body,
        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Header styles */
        header {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            color: white;
            padding: 10px;
            align-items: center;
        }

        .admin-logout {
            margin-right: 20px;
        }

        .admin-logout a {
            color: white;
            text-decoration: none;
        }


        /* Main content styles */
        main {
            margin: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        form {
            display: inline-block;
            margin-right: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            padding: 10px 20px;
            background-color: #ccc;
            color: black;
            text-decoration: none;
            border: none;
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>Delete User</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Delete User Confirmation</h2>
        <p>Are you sure you want to delete the user:
            <?php echo $user_data['name']; ?>?
        </p>
        <form action="delete_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
            <button type="submit" name="confirm_delete">Confirm Delete</button>
            <a href="admin_dashboard.php">Cancel</a>
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Delete User
        </p>
    </footer>
</body>

</html>