<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $loggedInUser = $user->login($username, $password);
        if ($loggedInUser) {
            $_SESSION['user_id'] = $loggedInUser['id'];
            $_SESSION['role'] = $loggedInUser['role']; // Store user role
            header('Location: index.php');
            exit();
        } else {
            $error = "Login failed. Please check your credentials.";
        }
    }
    
    if ($_SESSION['role'] != 'admin') {
        header('Location: index.php'); // Redirect non-admin users
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
