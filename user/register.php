<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;


            min-height: 100vh;
            /* This ensures the footer stays at the bottom */
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        main {
            flex: 1;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            margin-right: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
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
        <h1>User Registration</h1>
    </header>

    <main>
        <form action="register_process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="tel" name="phone" placeholder="Phone" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="pincode" placeholder="Pin Code" required><br>
            <input type="text" name="country" placeholder="Country" required><br>
            <input type="text" name="city" placeholder="City" required><br>
            <input type="text" name="state" placeholder="State" required><br>

            <button type="submit">Register</button>
        </form>
    </main>

    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> User Registration
        </p>
    </footer>
</body>

</html>