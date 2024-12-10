<?php

// Ručno uključivanje potrebnih fajlova
require_once 'app/Classes/Car.php';
require_once 'app/Database/Database.php';

use App\Classes\Car;
use App\Database\Database;

// Kreiranje instance Database klase
$db = new Database();
$conn = $db->connect();

// Prikaži početak tabele
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Make</th><th>Model</th><th>Year</th><th>Color</th></tr>";  // Zaglavlje tabele

// Prikaz jednog automobila (testni primer)
$car = new Car("Toyota", "Corolla", 2020);
$car->setColor("Red");

echo "<tr>";
echo "<td>" . $car->getMake() . "</td>";  // Koristi getter metode
echo "<td>" . $car->getModel() . "</td>";  // Koristi getter metode
echo "<td>" . $car->getYear() . "</td>";   // Koristi getter metode
echo "<td>" . $car->getColor() . "</td>";
echo "</tr>";

// Povucite podatke iz baze
$query = $conn->query("SELECT * FROM car_app");
$cars = $query->fetchAll(PDO::FETCH_ASSOC);

// Iteriraj kroz podatke i prikazuj ih u tabeli
foreach ($cars as $carData) {
    $car = new Car($carData['make'], $carData['model'], $carData['year']);
    
    if (isset($carData['color'])) {
        $car->setColor($carData['color']);
    } else {
        $car->setColor('Unknown');
    }

    // Prikaz podataka o automobilima u tabeli
    echo "<tr>";
    echo "<td>" . $car->getMake() . "</td>";  // Koristi getter metode
    echo "<td>" . $car->getModel() . "</td>";  // Koristi getter metode
    echo "<td>" . $car->getYear() . "</td>";   // Koristi getter metode
    echo "<td>" . $car->getColor() . "</td>";
    echo "</tr>";
}

// Zatvori tabelu
echo "</table>";
?>

