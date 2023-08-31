<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <h1>User Login</h1>
    <form action="login_process.php" method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <?php include '../includes/footer.php'; ?>
</body>

</html>