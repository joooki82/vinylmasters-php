<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lemez szerkesztése</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    $lemez_id = $_GET['id'];

    require_once 'config.php';
    $connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
    if (!$connection) {
        die("Hiba a kapcsolódás során: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM albums WHERE id = $lemez_id";
    $result = mysqli_query($connection, $sql);
    $lemez = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cim = $_POST['cim'];
        $eloado = $_POST['eloado'];
        $kiado = $_POST['kiado'];
        $allapot = $_POST['allapot'];
        $ar = $_POST['ar'];
        $boritokep = $_POST['boritokep'];

        $sql = "UPDATE albums SET cim = '$cim', eloado = '$eloado', kiado = '$kiado', allapot = '$allapot', ar = '$ar', boritokep = '$boritokep' WHERE id = $lemez_id";
        if (mysqli_query($connection, $sql)) {
            echo '<script>alert("A lemez adatai sikeresen frissítve lettek.");</script>';
            echo '<script>window.location.href = "product.php";</script>';
            exit();
        } else {
            echo "Hiba történt a lemez adatainak frissítése során: " . mysqli_error($connection);
        }
    }
    ?>

    <div class="container mt-5">
        <h2>Lemez szerkesztése</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="cim">Cím</label>
                <input type="text" class="form-control" id="cim" name="cim" value="<?php echo htmlspecialchars($lemez['cim']); ?>" required>
            </div>
            <div class="form-group">
                <label for="eloado">Művész</label>
                <input type="text" class="form-control" id="eloado" name="eloado" value="<?php echo htmlspecialchars($lemez['eloado']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kiado">Kiadó</label>
                <input type="text" class="form-control" id="kiado" name="kiado" value="<?php echo htmlspecialchars($lemez['kiado']); ?>" required>
            </div>
            <div class="form-group">
                <label for="allapot">Állapot</label>
                <input type="text" class="form-control" id="allapot" name="allapot" value="<?php echo htmlspecialchars($lemez['allapot']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ar">Ár</label>
                <input type="number" class="form-control" id="ar" name="ar" value="<?php echo htmlspecialchars($lemez['ar']); ?>" required>
            </div>
            <div class="form-group">
                <label for="boritokep">Borítókép</label>
                <input type="text" class="form-control" id="boritokep" name="boritokep" value="<?php echo htmlspecialchars($lemez['boritokep']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Frissítés</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


