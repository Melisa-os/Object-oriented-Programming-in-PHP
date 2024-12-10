<?php
class MobilniUredjaj {
    private $conn;
    private $table = 'mobiteli';

    // Define properties
    public $id;
    public $proizvodjac_id; // Ensure this is the same as your DB column
    public $model;
    public $cena;
    public $godina_proizvodnje;
    public $datum_unosa;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to create a new mobile device
    public function create() {
        $query = "INSERT INTO " . $this->table . " (proizvodjac_id, model, cena, godina_proizvodnje, datum_unosa) 
                  VALUES (:proizvodjac_id, :model, :cena, :godina_proizvodnje, NOW())";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':proizvodjac_id', $this->proizvodjac_id);
        $stmt->bindParam(':model', $this->model);
        $stmt->bindParam(':cena', $this->cena);
        $stmt->bindParam(':godina_proizvodnje', $this->godina_proizvodnje);

        return $stmt->execute();
    }

    // Function to get all devices
    public function getAll() {
        $query = "SELECT mobiteli.*, proizvođači.ime_proizvođača 
                  FROM " . $this->table . " 
                  JOIN proizvođači ON mobiteli.proizvodjac_id = proizvođači.id"; // Change made here
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to get a device by ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Function to update a device
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET proizvodjac_id = :proizvodjac_id, model = :model, cena = :cena, godina_proizvodnje = :godina_proizvodnje 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':proizvodjac_id', $this->proizvodjac_id);
        $stmt->bindParam(':model', $this->model);
        $stmt->bindParam(':cena', $this->cena);
        $stmt->bindParam(':godina_proizvodnje', $this->godina_proizvodnje);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Function to delete a device
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>

    