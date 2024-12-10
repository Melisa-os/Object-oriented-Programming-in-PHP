<?php
class Comment {
    private $conn;
    private $table = 'comments';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteComment($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateComment($id, $comment) {
        $query = "UPDATE comments SET comment = :comment WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getCommentsByNewsId($newsId) {
        $query = "SELECT comment, guest_name, created_at FROM comments WHERE news_id = :news_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':news_id', $newsId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($news_id, $user_id, $guest_name, $comment_text) {
        $query = "INSERT INTO comments (news_id, user_id, guest_name, comment, created_at) 
                  VALUES (:news_id, :user_id, :guest_name, :comment, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':news_id', $news_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':guest_name', $guest_name);
        $stmt->bindParam(':comment', $comment_text);
        
        return $stmt->execute();
    }
}
?>
