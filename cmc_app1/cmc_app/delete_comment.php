<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/Comment.php';

$database = new Database();
$db = $database->connect();
$comment = new Comment($db);

// Check if user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    if ($comment->deleteComment($id)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Failed to delete comment.";
    }
}
?>

