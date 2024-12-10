<?php
class Category {
    private $conn;
    private $table = 'categories'; // Make sure to create this table

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
