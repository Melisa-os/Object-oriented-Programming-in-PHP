<?php
class User {
    private $db;
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $birthDate;
    private $username;

    public function __construct($db) {
        $this->db = $db;
    }

    // Provera da li korisnik već postoji prema email-u
    public function userExists($email) {
        $sql = "SELECT COUNT(*) FROM korisnici WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Dodavanje korisnika sa proverom postojanja email-a
    public function addUser($firstName, $lastName, $email, $birthDate, $username) {
        if ($this->userExists($email)) {
            throw new Exception("Korisnik sa email adresom {$email} već postoji.");
        }

        $sql = "INSERT INTO korisnici (ime_korisnika, prezime_korisnika, email, datum_rodjena, korisnicko_ime) 
                VALUES (:firstName, :lastName, :email, :birthDate, :username)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':email' => $email,
            ':birthDate' => $birthDate,
            ':username' => $username
        ]);

        // Postavljanje atributa nakon uspešnog unosa
        $this->id = $this->db->lastInsertId();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->username = $username;
    }

    // Prikaz svih podataka o korisniku prema ID-u
    public function getAllData() {
        $sql = "SELECT * FROM korisnici WHERE id_korisnika = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Prikaz punog imena korisnika
    public function getFullName() {
        return "{$this->firstName} {$this->lastName}";
    }

    // Prikaz email-a korisnika
    public function getEmail() {
        return $this->email;
    }

    // Prikaz ID-a korisnika
    public function getId() {
        return $this->id;
    }

    // Provera punoletnosti korisnika
    public function isAdult() {
        $birthDate = new DateTime($this->birthDate);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        return $age >= 18;
    }
}
?>

