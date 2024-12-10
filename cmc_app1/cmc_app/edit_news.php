<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/News.php';
require_once 'classes/Category.php';

$database = new Database();
$db = $database->connect();
$news = new News($db);
$category = new Category($db);

// Fetch all categories
$categories = $category->getAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    if ($news->updateNews($id, $title, $content, $category_id)) {
        header('Location: index.php');
    } else {
        echo "Failed to update news.";
    }
}

// Fetch the news item to edit
$id = $_GET['id'];
$currentNews = $news->getNewsById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
</head>
<body>
    <h1>Edit News</h1>
    <form action="edit_news.php" method="POST">
        <input type="hidden" name="id" value="<?= $currentNews['id'] ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($currentNews['title']) ?>" required>
        
        <label for="content">Content:</label>
        <textarea name="content" required><?= htmlspecialchars($currentNews['content']) ?></textarea>
        
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $currentNews['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Update News</button>
    </form>
</body>
</html>
