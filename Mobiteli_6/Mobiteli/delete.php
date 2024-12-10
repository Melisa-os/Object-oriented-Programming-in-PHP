<?php
require_once 'DatabaseConnection.php';
require_once 'MobilniUredjaj.php';

$db = (new DatabaseConnection())->connect();
$mobilniUredjaj = new MobilniUredjaj($db);

if (isset($_GET['id'])) {
    $mobilniUredjaj->id = $_GET['id'];
    if ($mobilniUredjaj->delete()) {
        header('Location: index.php');
    } else {
        echo "Failed to delete device.";
    }
} else {
    echo "Device ID not specified.";
}
?>
