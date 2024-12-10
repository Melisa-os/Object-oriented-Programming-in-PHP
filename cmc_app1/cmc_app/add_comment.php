<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/News.php';
require_once 'classes/Comment.php';
require_once 'classes/Category.php';

$database = new Database();
$db = $database->connect();
$news = new News($db);
$comment = new Comment($db);
$category = new Category($db);

// Fetch all categories
$categories = $category->getAll();

// Filter news by category
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$newsItems = $news->getByCategory($category_id);

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news_id = $_POST['news_id'];
    $guest_name = $_POST['guest_name'] ?? null;
    $comment_text = $_POST['comment'];
    $user_id = $_SESSION['user_id'] ?? null;

    // Ensure user is logged in or provide name before adding comment
    if ($user_id || $guest_name) {
        if ($comment->addComment($news_id, $user_id, $guest_name, $comment_text)) {
            header("Location: index.php?category_id=$category_id");
            exit();
        } else {
            $error_message = "Failed to add comment.";
        }
    } else {
        $error_message = "You must be logged in or provide your name to leave a comment.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CMS Home</title>
</head>
<body>
    <header>
        <h1>Welcome to the CMS News</h1>
        <nav>
            <ul>
                <?php foreach ($categories as $cat): ?>
                    <li><a href="index.php?category_id=<?= $cat['id'] ?>" <?= $category_id == $cat['id'] ? 'class="active"' : '' ?>><?= htmlspecialchars($cat['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul style="float: right;">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="add_news.php">Add News</a></li>
                <?php endif; ?>
                <li><a href="index.php">Back to Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Latest News:</h2>
        <?php if (empty($newsItems)): ?>
            <p>No news available in this category.</p>
        <?php else: ?>
            <?php foreach ($newsItems as $item): ?>
                <article>
                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                    <p><?= htmlspecialchars($item['content']) ?></p>
                    <p>Published on: <?= $item['created_at'] ?></p>

                    <!-- Display error message if exists -->
                    <?php if (!empty($error_message)): ?>
                        <p class="error"><?= $error_message ?></p>
                    <?php endif; ?>

                    <!-- Comment section -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <h4>Leave a Comment:</h4>
                        <form action="index.php?category_id=<?= $category_id ?>" method="POST">
                            <input type="hidden" name="news_id" value="<?= $item['id'] ?>">
                            <label for="guest_name">Your Name (optional):</label>
                            <input type="text" name="guest_name" placeholder="Enter your name (optional)">
                            <textarea name="comment" required placeholder="Write your comment here..."></textarea>
                            <button type="submit">Add Comment</button>
                        </form>
                    <?php else: ?>
                        <p><a href="login.php">Log in</a> to leave a comment.</p>
                    <?php endif; ?>

                    <!-- Display comments -->
                    <h4>Comments:</h4>
                    <?php
                    $comments = $comment->getCommentsByNewsId($item['id']);
                    if (empty($comments)): ?>
                        <p>No comments yet.</p>
                    <?php else: ?>
                        <?php foreach ($comments as $cmt): ?>
                            <p>
                                <?= htmlspecialchars($cmt['comment']) ?> - 
                                <?= htmlspecialchars($cmt['guest_name'] ?? 'User') ?> 
                                (<?= $cmt['created_at'] ?>)
                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                    <a href="edit_comment.php?id=<?= $cmt['id'] ?>">Edit</a>
                                    <form action="delete_comment.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $cmt['id'] ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> CMS News. All Rights Reserved.</p>
    </footer>
</body>
</html>
