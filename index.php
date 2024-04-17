<?php
session_start();

// Simulated user data (in a real-world scenario, this would be fetched from a database)
$users = [
    'user' => 'password',
];

// Function to check if the provided username and password are valid
function authenticate($username, $password) {
    global $users;
    return isset($users[$username]) && $users[$username] === $password;
}

// Initialize error message
$error = '';

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: panel.php"); // Redirect to panel page if already logged in
    exit;
}

// Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the submitted credentials
    if (authenticate($username, $password)) {
        // Authentication successful, set session variable
        $_SESSION['username'] = $username;
        header("Location: panel.php"); // Redirect to panel page after successful login
        exit;
    } else {
        // Invalid login, set error message
        $error = 'Invalid username or password.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3); /* White shadow for contrast */
            max-width: 400px;
            width: 100%;
        }

        .login-container h2 {
            text-align: center;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
            color: #fff; /* White text color */
            box-sizing: border-box;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff; /* Blue submit button */
            color: #fff; /* White text color */
            cursor: pointer;
            box-sizing: border-box;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
