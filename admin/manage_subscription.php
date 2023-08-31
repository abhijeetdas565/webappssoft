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
?>


<!DOCTYPE html>
<html>

<head>
    <title>Manage Subscription</title>
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

        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        a:hover {
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
        <h1>Manage Subscription</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Manage Subscription</h2>
        <?php
        if ($subscription_amount > 0) {
            echo "<p>Subscription Amount: $subscription_amount</p>";
            echo "<a href='edit_subscription.php?id={$user_id}'>Edit Subscription</a>";
            echo "<a href='remove_subscription.php?id={$user_id}'>Delete Subscription</a>";
        } else {
            // No subscription for the user, provide option to add
            echo "<p>No subscription found for this user.</p>";
            echo "<a href='add_subscription.php?id={$user_id}'>Add Subscription</a>";
        }
        ?>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Manage Subscription
        </p>
    </footer>
</body>

</html>