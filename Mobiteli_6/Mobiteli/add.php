<?php
require_once 'DatabaseConnection.php';
require_once 'MobilniUredjaj.php';
require_once 'Proizvodjac.php';

$db = (new DatabaseConnection())->connect();
$mobilniUredjaj = new MobilniUredjaj($db);
$proizvodjac = new Proizvodjac($db);
$manufacturers = $proizvodjac->getAll(); // Fetch the manufacturers directly as an array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobilniUredjaj->proizvodjac_id = $_POST['proizvodjac_id'];
    $mobilniUredjaj->model = $_POST['model'];
    $mobilniUredjaj->cena = $_POST['cena'];
    $mobilniUredjaj->godina_proizvodnje = $_POST['godina_proizvodnje'];
    if ($mobilniUredjaj->create()) {
        header('Location: index.php');
        exit; // Use exit after header redirection
    } else {
        echo "Failed to add device.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Mobilni Uređaj</title>
</head>
<body>
    <h1>Dodaj Mobilni Uređaj</h1>
    <form method="post">
        <label for="proizvodjac_id">Proizvođač:</label>
        <select name="proizvodjac_id" id="proizvodjac_id" required>
            <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?= htmlspecialchars($manufacturer['id']); ?>">
                    <?= htmlspecialchars($manufacturer['ime_proizvođača']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="model">Model:</label>
        <input type="text" name="model" id="model" required><br><br>

        <label for="cena">Cena:</label>
        <input type="number" name="cena" id="cena" step="0.01" required><br><br>

        <label for="godina_proizvodnje">Godina Proizvodnje:</label>
        <input type="text" name="godina_proizvodnje" id="godina_proizvodnje" required><br><br>

        <input type="submit" value="Dodaj Uređaj">
    </form>
</body>
</html>

