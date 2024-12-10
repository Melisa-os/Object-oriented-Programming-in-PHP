<?php
class News {
    private $conn;
    private $table = "news";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($title, $content, $category_id) {
        $query = "INSERT INTO " . $this->table . " (title, content, category_id) VALUES (:title, :content, :category_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategory($category_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function addNews($title, $content, $category_id) {
        $query = "INSERT INTO news (title, content, category_id) VALUES (:title, :content, :category_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
    
        return $stmt->execute();
    }
    public function deleteNews($news_id) {
        $query = "DELETE FROM news WHERE id = :news_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':news_id', $news_id);
        return $stmt->execute();
    }

    // Update a news article
    public function updateNews($id, $title, $content, $category_id) {
        $query = "UPDATE news SET title = :title, content = :content, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Get a news article by its ID
    public function getNewsById($id) {
        $query = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
}
?>
