<?php
$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

mysqli_set_charset($connection, 'utf8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    $userId = $_POST['user_id'];

    $query = "SELECT o.*, a.cim, a.eloado FROM orders o JOIN albums a ON o.lemez_id = a.id WHERE o.vasarlo_id = '$userId'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Hiba a lekérdezés során: " . mysqli_error($connection));
    }

    $header = array('Rendelés azonosító', 'Termék címe', 'Előadó', 'Mennyiség', 'Összeg', 'Rendelés dátuma');

    foreach ($header as $i => $value) {
        $header[$i] = iconv('UTF-8', 'ISO-8859-2', $value);
    }

    $filename = 'megrendelesek.csv';
    $file = fopen($filename, 'w');

    fputcsv($file, $header, ';', '"', '\\');

    while ($row = mysqli_fetch_assoc($result)) {
        $data = array(
            $row['id'],
            $row['cim'],
            $row['eloado'],
            $row['mennyiseg'],
            $row['osszeg'],
            $row['rendeles_datuma']
        );
        fputcsv($file, $data, ';', '"', '\\');
    }

    fclose($file);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);

    unlink($filename);
} else {
    header("Location: index.php");
    exit;
}
