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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subscription_amount = $_POST['subscription_amount'];

    // Update user's subscription amount
    $sql_update_subscription = "UPDATE users SET subscription_amount = $subscription_amount WHERE id = $user_id";

    if (mysqli_query($connection, $sql_update_subscription)) {
        header("Location: admin_dashboard.php"); // Redirect back to admin dashboard
        exit();
    } else {
        echo "Error updating subscription: " . mysqli_error($connection);
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Add Subscription</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        input[type="number"] {
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
        }
    </style>
</head>

<body>
    <header>
        <h1>Add Subscription</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Add Subscription</h2>
        <form method="POST">
            <label for="subscription_amount">Subscription Amount:</label>
            <input type="number" name="subscription_amount" required>
            <button type="submit">Add Subscription</button>
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Add Subscription
        </p>
    </footer>
</body>

</html>