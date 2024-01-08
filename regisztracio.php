<?php

$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');

if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'];
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];
    $role = $_POST['role'];
    $jelszoHash = password_hash($jelszo, PASSWORD_BCRYPT);

    $query = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("A megadott email címmel már regisztráltak.");</script>';
        echo '<script>window.location.href = "product.php";</script>';
        exit();
    }

    $insertQuery = "INSERT INTO customers (nev, email, jelszo, role_id) VALUES ('$nev', '$email', '$jelszoHash', '$role')";
    if (mysqli_query($connection, $insertQuery)) {
        echo '<script>alert("Sikeres regisztráció.");</script>';
        echo '<script>window.location.href = "product.php";</script>';
        exit();
    } else {
        echo "Hiba történt a regisztráció során: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container mt-5">
        <h2>Regisztráció</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nev">Név</label>
                <input type="text" class="form-control" id="nev" name="nev" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="jelszo">Jelszó</label>
                <input type="password" class="form-control" id="jelszo" name="jelszo" required>
            </div>
            <div class="form-group">
                <label for="role">Jogosultság</label>
                <select class="form-control" id="role" name="role">
                    <option value="2">Vevő</option>
                    <option value="3">Eladó</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Regisztráció</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
