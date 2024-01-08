<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lemezId = $_POST['lemezId'];
    $mennyiseg = 1; // Mindig 1 db

    $query = "SELECT * FROM albums WHERE id = '$lemezId'";
    $result = mysqli_query($connection, $query);
    $lemez = mysqli_fetch_assoc($result);
    $osszeg = $lemez['ar']; // Az ár alapján számított összeg

    $vasarloId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    if ($vasarloId === null) {
        die("Nem érvényes vásárló azonosító.");
        echo '<script>';
        echo 'console.log("user_id: ' . $_SESSION['user_id'] . '");';
        echo 'console.log("user_name: ' . $_SESSION['user_name'] . '");';
        echo '</script>';
    }
    $rendelesDatum = date('Y-m-d H:i:s');
    $insertQuery = "INSERT INTO orders (vasarlo_id, lemez_id, mennyiseg, osszeg, rendeles_datuma) VALUES ('$vasarloId', '$lemezId', '$mennyiseg', '$osszeg', '$rendelesDatum')";
    if (mysqli_query($connection, $insertQuery)) {
        echo '<script>alert("Sikeresen hozzáadva a kosárhoz.");</script>';
    } else {
        echo "Hiba történt a kosárba helyezés során: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosárba helyezés</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container mt-5">
        <h2>Kosárba helyezés</h2>
        <div class="alert alert-success">
            Az alábbi lemezt sikeresen hozzáadtuk a kosárhoz:
            <?php
            $lemezId = isset($_POST['lemezId']) ? $_POST['lemezId'] : null;
            if ($lemezId) {
                $query = "SELECT * FROM albums WHERE id = '$lemezId'";
                $result = mysqli_query($connection, $query);
                $lemez = mysqli_fetch_assoc($result);
                echo '<h4>' . $lemez['cim'] . '</h4>';
                echo '<p>' . $lemez['eloado'] . '</p>';
                echo '<p>Ár: ' . $lemez['ar'] . ' Ft</p>';
            }
            ?>
        </div>
        <a href="product.php" class="btn btn-primary">Vissza a termékekhez</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

