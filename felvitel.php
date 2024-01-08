<?php
include 'config.php';
$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
if (!$connection) {
    die("A kapcsolódás sikertelen: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cim = $_POST['cim'];
    $eloado = $_POST['eloado'];
    $kiado = $_POST['kiado'];
    $allapot = $_POST['allapot'];
    $ar = $_POST['ar'];
    
    if (empty($cim) || empty($eloado) || empty($kiado) || empty($allapot) || empty($ar)) {
        echo '<script>alert("Minden mező kitöltése kötelező."); window.location.href = "ujalbum.php";</script>';
        exit;
    }

    $targetDirectory = 'images/';
    $targetFile = $targetDirectory . basename($_FILES['boritokep']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST['submit'])) {
        $check = getimagesize($_FILES['boritokep']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "A fájl nem kép.";
            $uploadOk = 0;
        }
    }

    if ($_FILES['boritokep']['size'] > 10000000) {
        echo "A fájl túl nagy.";
        $uploadOk = 0;
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Csak JPG, JPEG vagy PNG fájlokat lehet feltölteni.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['boritokep']['tmp_name'], $targetFile)) {
            $boritokep = basename($_FILES['boritokep']['name']);

            $sql = "INSERT INTO albums (cim, eloado, kiado, allapot, ar, boritokep) VALUES ('$cim', '$eloado', '$kiado', '$allapot', $ar, '$boritokep')";

            if (mysqli_query($connection, $sql)) {
                echo '<script>alert("Az új album sikeresen fel lett véve.");</script>';
                echo '<script>window.location.href = "product.php";</script>';
            } else {
                echo "Hiba történt az új album felvitele során: " . mysqli_error($connection);
            }
        } else {
            echo "Hiba történt a fájl feltöltésekor.";
        }
    }
}

mysqli_close($connection);
?>

