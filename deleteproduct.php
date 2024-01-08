<?php
$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');

if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

$albumId = $_GET['id'];

$sql = "DELETE FROM albums WHERE id = $albumId";

if (mysqli_query($connection, $sql)) {
    echo '<script>alert("Az album sikeresen törölve lett.");</script>';
} else {
    echo "Hiba történt az album törlése során: " . mysqli_error($connection);
}

echo '<script>window.location.href = "product.php";</script>';

mysqli_close($connection);
?>

