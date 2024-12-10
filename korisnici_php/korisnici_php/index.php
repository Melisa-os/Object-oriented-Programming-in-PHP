<?php
require_once 'Connection.php';
require_once 'User.php';

// Kreiranje konekcije
$connection = new Connection('localhost', 'root', 'Tele23@fon_lik', 'my_first_db');
$db = $connection->connect();

// Kreiranje korisnika
$user = new User($db);

// Dodavanje korisnika sa korisničkim imenom
$user->addUser('Jack', 'Din', 'jack.din23@example.com', '1990-01-01', 'jack_din1');

// Prikaz podataka o korisniku
print_r($user->getAllData());
echo "<br>";
echo "Ime i prezime: " . $user->getFullName();
echo "<br>";
echo "Email: " . $user->getEmail();
echo "<br>";
echo "ID korisnika: " . $user->getId();
echo "<br>";
echo "Punoletan: " . ($user->isAdult() ? "Da" : "Ne");
?>

