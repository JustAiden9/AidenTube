<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit;
}

// Logout functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    // Logout user
    unset($_SESSION['username']);
    session_destroy();
    header("Location: index.php"); // Redirect to login page after logout
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <style>
        body {
            background-color: #000; /* Black background color */
            color: #fff; /* White text color */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .panel-container {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3); /* White shadow for contrast */
            max-width: 400px;
            width: 100%;
        }

        .panel-container h2 {
            text-align: center;
        }

        .button-container {
            margin-bottom: 10px;
        }

        .button-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50; /* Green */
            color: white;
            cursor: pointer;
            box-sizing: border-box;
        }

        .button-container input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .logout-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff; /* Blue submit button */
            color: #fff; /* White text color */
            cursor: pointer;
            box-sizing: border-box;
        }

        .logout-form input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <h2>Welcome Back <?php echo $_SESSION['username']; ?></h2>
        <div class="button-container">
            <form method="post" action="storage.php">
                <input type="submit" value="Go to Storage">
            </form>
        </div>
        <form class="logout-form" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</body>
</html>
