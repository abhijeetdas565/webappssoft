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

// Retrieve user data
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($connection, $sql_users);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .admin-logout {
            float: right;
            margin-top: -30px;
        }

        .admin-logout a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #666;
            border-radius: 4px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Admin Dashboard</h1>
        <div class="admin-logout">
            <a href="../index.php">Logout</a>
        </div>
    </header>

    <main>
        <h2>Welcome to the Admin Dashboard</h2>
        <p>This is the main content of the admin dashboard.</p>

        <!-- User List -->
        <h3>User List</h3>
        <?php
        if (mysqli_num_rows($result_users) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result_users)) {
                echo "<li>{$row['name']} - {$row['email']} - Subscription Amount: {$row['subscription_amount']} 
                      (<a href='edit_user.php?id={$row['id']}'>Edit</a> | 
                      <a href='delete_user.php?id={$row['id']}'>Delete</a> | 
                      <a href='manage_subscription.php?id={$row['id']}'>Manage Subscription</a>)</li>";
            }

            // Store the connection data in session
            $_SESSION['admin_connection_data'] = array(
                'host' => "localhost",
                'username' => "root",
                'password' => "1234",
                'database' => "color_prediction_db"
            );


            echo "</ul>";
        } else {
            echo "No users found.";
        }
        ?>

        <!-- Add New User -->
        <h3>Add New User</h3>
        <a href="add_user.php">Add User</a>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Admin Dashboard
        </p>
    </footer>
</body>

</html>