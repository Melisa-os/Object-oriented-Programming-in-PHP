<?php
require_once 'DatabaseConnection.php';
require_once 'MobilniUredjaj.php';

$db = (new DatabaseConnection())->connect();
$mobilniUredjaj = new MobilniUredjaj($db);
$devices = $mobilniUredjaj->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilni Uređaji</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Mobilni Uređaji</h1>
    <a href="add.php">Dodaj novi uređaj</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Proizvođač</th>
            <th>Model</th>
            <th>Cena</th>
            <th>Godina Proizvodnje</th>
            <th>Datum Unosa</th>
            <th>Akcije</th>
        </tr>
        <?php foreach ($devices as $device): ?>
            <tr>
                <td><?= htmlspecialchars($device['id']); ?></td>
                <td><?= htmlspecialchars($device['ime_proizvođača']); ?></td>
                <td><?= htmlspecialchars($device['model']); ?></td>
                <td><?= htmlspecialchars($device['cena']); ?></td>
                <td><?= htmlspecialchars($device['godina_proizvodnje']); ?></td>
                <td><?= htmlspecialchars($device['datum_unosa']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $device['id']; ?>">Edit</a> | 
                    <a href="delete.php?id=<?= $device['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

