<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új album felvitel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container">
        <h2>Új album felvitel</h2>
        <form action="felvitel.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cim">Cím</label>
                <input type="text" class="form-control" id="cim" name="cim" required>
            </div>
            <div class="form-group">
                <label for="eloado">Előadó</label>
                <input type="text" class="form-control" id="eloado" name="eloado" required>
            </div>
            <div class="form-group">
                <label for="kiado">Kiadó</label>
                <input type="text" class="form-control" id="kiado" name="kiado" required>
            </div>
            <div class="form-group">
                <label for="allapot">Állapot</label>
                <input type="text" class="form-control" id="allapot" name="allapot" required>
            </div>
            <div class="form-group">
                <label for="ar">Ár</label>
                <input type="number" class="form-control" id="ar" name="ar" required>
            </div>
            <div class="form-group">
                <label for="boritokep">Borítókép</label>
                <input type="file" class="form-control-file" id="boritokep" name="boritokep">
            </div>
            <button type="submit" class="btn btn-primary">Felvitel</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
