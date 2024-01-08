<?php
session_start();


$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

$userId = $_SESSION['user_id'];
$query = "SELECT o.*, a.cim, a.eloado FROM orders o JOIN albums a ON o.lemez_id = a.id WHERE o.vasarlo_id = '$userId'";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("Hiba a lekérdezés során: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelések</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container mt-5">
        <h2>Rendelések</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Rendelés azonosító</th>
                    <th>Termék címe</th>
                    <th>Előadó</th>
                    <th>Mennyiség</th>
                    <th>Összeg</th>
                    <th>Rendelés dátuma</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['cim']; ?></td>
                        <td><?php echo $row['eloado']; ?></td>
                        <td><?php echo $row['mennyiseg']; ?></td>
                        <td><?php echo $row['osszeg']; ?></td>
                        <td><?php echo $row['rendeles_datuma']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="generate_csv.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            <button type="submit" class="btn btn-primary">Megrendelés visszaigazolása (CSV)</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
