
<!-- products.php -->

<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');

if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termékek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <h1>Termékek</h1>
        <div class="row">
            <?php
            $query = "SELECT * FROM albums";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card mb-4">';
                echo '<div class="card-img-container">';
                echo '<img src="images/' . $row['boritokep'] . '" class="card-img-top" alt="Lemez kép">';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['cim'] . '</h5>';
                echo '<p class="card-text">' . $row['eloado'] . '</p>';
                echo '<p class="card-text">Ár: ' . $row['ar'] . ' Ft</p>';
                echo '</div>';
                echo '<div class="card-footer text-muted d-flex align-items-center justify-content-between">';
                echo '<form action="purchase.php" method="POST">';
                echo '<input type="hidden" name="lemezId" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>';
                echo '</form>';
                echo '<a href="updateproduct.php?id=' . $row['id'] . '"><i class="fas fa-edit fa-lg text-primary mr-2"></i></a>';
                echo '<a href="#" onclick="confirmDelete(' . $row['id'] . ');"><i class="fas fa-trash-alt fa-lg text-danger mr-2"></i></a>';
                echo '</div>'; // card-footer
                echo '</div>'; // card
                echo '</div>'; // col
            }
            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>


</body>
</html>

