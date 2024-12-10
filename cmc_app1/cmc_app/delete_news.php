<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/News.php';

$database = new Database();
$db = $database->connect();
$news = new News($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    if ($news->deleteNews($id)) {
        header('Location: index.php');
    } else {
        echo "Failed to delete news.";
    }
}
?>

