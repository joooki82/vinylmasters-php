<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '', 'vinylmasters');
if (!$connection) {
    die("Hiba a kapcsolódás során: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($jelszo, $user['jelszo'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nev'];
            header("Location: product.php");
            exit();
        } else {
            $error = "Hibás jelszó";
        }
    } else {
        $error = "Nem létező felhasználó";
    }
    echo '<script>';
    echo 'console.log("user_id: ' . $_SESSION['user_id'] . '");';
    echo 'console.log("user_name: ' . $_SESSION['user_name'] . '");';
    echo '</script>';
    
    if (isset($error)) {
        echo '<script>';
        echo 'console.log("Error: ' . $error . '");';
        echo '</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container mt-5">
        <h2>Bejelentkezés</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="jelszo">Jelszó</label>
                <input type="password" class="form-control" id="jelszo" name="jelszo" required>
            </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

