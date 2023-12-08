<?php
session_start();

if (!isset($_SESSION['ROL']) || $_SESSION['ROL'] != "admin") {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        include_once "conn.php";

        $nombreDeporte = $_POST['nombreDeporte'];
        $numJugadores = $_POST['numJugadores'];
        $superficie = $_POST['superficie'];
        $urlImagen = $_POST['urlImagen'];
        $imgBlob = file_get_contents($_FILES['imagen']['tmp_name']); // Obtener el contenido binario de la imagen

        $sql = "INSERT INTO deportes (NOMBRE, NUM_JUGADORES, SUPERFICIE, IMG, IMG_BLOB) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(1, $nombreDeporte);
        $stmt->bindParam(2, $numJugadores, PDO::PARAM_INT);
        $stmt->bindParam(3, $superficie);
        $stmt->bindParam(4, $urlImagen);
        $stmt->bindParam(5, $imgBlob, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            echo "Deporte introducido con éxito.";
        } else {
            echo "Error al introducir el deporte: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error al introducir el deporte: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Introducir datos</title>
</head>
<body>
    <h1>Introducir Nuevo Deporte</h1>
    <form action="introducir.php" method="POST" enctype="multipart/form-data">
        <label for="nombreDeporte">Nombre: </label>
        <input type="text" name="nombreDeporte">
        <label for="numJugadores">Jugadores: </label>
        <input type="number" name="numJugadores">
        <label for="superficie">Superficie: </label>
        <input type="text" name="superficie">
        <label for="urlImagen">Url de la imagen: </label>
        <input type="text" name="urlImagen">
        <label for="imagen">Imagen: </label>
        <input type="file" name="imagen"><br><br>
        <input type="submit" value="Enviar">
        <br><br><br>
        <a href="menu.php" style=" text-decoration: none;background-color: #0c0962;color: #FFF;padding: 10px 20px;border-radius: 5px;transition: background-color 0.3s;">Volver atrás</a>
    </form>
</body>
</html>
