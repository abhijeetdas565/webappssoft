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

// Retrieve user's subscription amount
$sql_subscription = "SELECT subscription_amount FROM users WHERE id = $user_id";
$result_subscription = mysqli_query($connection, $sql_subscription);

if (!$result_subscription) {
    die("Error fetching subscription information: " . mysqli_error($connection));
}

$user_row = mysqli_fetch_assoc($result_subscription);

$subscription_amount = $user_row['subscription_amount'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_subscription_amount = $_POST['subscription_amount'];

    // Update user's subscription amount
    $sql_update_subscription = "UPDATE users SET subscription_amount = $new_subscription_amount WHERE id = $user_id";

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
    <title>Edit Subscription</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
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
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        form {
            font-size: 16px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <h1>Edit Subscription</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Edit Subscription</h2>
        <form method="POST">
            <label for="subscription_amount">New Subscription Amount:</label>
            <input type="number" name="subscription_amount" value="<?php echo $subscription_amount; ?>" required>
            <button type="submit">Update Subscription</button>
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Edit Subscription
        </p>
    </footer>
</body>

</html>