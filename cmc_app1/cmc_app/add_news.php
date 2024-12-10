<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/News.php';
require_once 'classes/Category.php';

$database = new Database();
$db = $database->connect();
$news = new News($db);
$category = new Category($db);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Preusmerite na početnu stranicu ako nije administrator
    exit;}
    
// Fetch all categories
$categories = $category->getAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    if ($news->addNews($title, $content, $category_id)) {
        header('Location: index.php');
    } else {
        echo "Failed to add news.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
</head>
<body>
    <h1>Add News</h1>
    <form action="add_news.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        
        <label for="content">Content:</label>
        <textarea name="content" required></textarea>
        
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Add News</button>
    </form>
</body>
</html>
