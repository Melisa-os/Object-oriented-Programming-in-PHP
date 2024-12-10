<?php
session_start();
require_once 'config/DatabaseConn.php';
require_once 'classes/Comment.php';

$database = new Database();
$db = $database->connect();
$comment = new Comment($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $updatedComment = $_POST['comment'];

    if ($comment->updateComment($id, $updatedComment)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Failed to update comment.";
    }
}

// Fetch the comment to edit
$id = $_GET['id'];
$currentComment = $comment->getCommentsByNewsId($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body>
    <h1>Edit Comment</h1>
    <form action="edit_comment.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($currentComment['id']) ?>">
        <label for="comment">Comment:</label>
        <textarea name="comment" required><?= htmlspecialchars($currentComment['comment']) ?></textarea>
        <button type="submit">Update Comment</button>
    </form>
</body>
</html>
