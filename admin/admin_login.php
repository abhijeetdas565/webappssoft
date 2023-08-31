<?php
session_start();

// Simulating admin authentication
if (isset($_POST['admin_login'])) {
    $admin_username = "admin";
    $admin_password = "admin123";

    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    if ($entered_username === $admin_username && $entered_password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p.error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="admin_login">Login</button>
        </form>
        <?php if (isset($login_error)): ?>
            <p class="error">
                <?php echo $login_error; ?>
            </p>
        <?php endif; ?>
    </main>
</body>

</html>