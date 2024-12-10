<?php
require_once 'DatabaseConnection.php';
require_once 'MobilniUredjaj.php';
require_once 'Proizvodjac.php';

$db = (new DatabaseConnection())->connect();
$mobilniUredjaj = new MobilniUredjaj($db);
$proizvodjac = new Proizvodjac($db);
$manufacturers = $proizvodjac->getAll();

if (isset($_GET['id'])) {
    $mobilniUredjaj->id = $_GET['id'];
    $device = $mobilniUredjaj->getById();

    // Debugging output
    if ($device) {
        echo "<pre>";
        print_r($device); // Check what data is retrieved
        echo "</pre>";
    } else {
        echo "No device found with this ID.";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mobilniUredjaj->proizvodjac_id = $_POST['proizvodjac_id'];
        $mobilniUredjaj->model = $_POST['model'];
        $mobilniUredjaj->cena = $_POST['cena'];
        $mobilniUredjaj->godina_proizvodnje = $_POST['godina_proizvodnje'];
        if ($mobilniUredjaj->update()) {
            header('Location: index.php');
            exit; // Ensure to stop further script execution
        } else {
            echo "Failed to update device.";
        }
    }
} else {
    echo "Device ID not specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izmeni Mobilni Uređaj</title>
</head>
<body>
    <h1>Izmeni Mobilni Uređaj</h1>
    <form method="post">
        <label for="proizvodjac_id">Proizvođač:</label>
        <select name="proizvodjac_id" id="proizvodjac_id" required>
            <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?= $manufacturer['id']; ?>" <?= isset($device) && $device['proizvodjac_id'] == $manufacturer['id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($manufacturer['ime_proizvođača']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="model">Model:</label>
        <input type="text" name="model" id="model" value="<?= isset($device) ? htmlspecialchars($device['model']) : ''; ?>" required><br><br>

        <label for="cena">Cena:</label>
        <input type="number" name="cena" id="cena" value="<?= isset($device) ? htmlspecialchars($device['cena']) : ''; ?>" step="0.01" required><br><br>

        <label for="godina_proizvodnje">Godina Proizvodnje:</label>
        <input type="text" name="godina_proizvodnje" id="godina_proizvodnje" value="<?= isset($device) ? htmlspecialchars($device['godina_proizvodnje']) : ''; ?>" required><br><br>

        <input type="submit" value="Izmeni Uređaj">
    </form>
</body>
</html>

