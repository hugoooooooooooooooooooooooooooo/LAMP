<?php
session_start();
include_once "conn.php";

if (!isset($_SESSION['ROL'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_deporte = $_GET['id'];
    $consulta = $con->prepare('SELECT * FROM ges_deportes.deportes WHERE ID = ?');
    $consulta->execute([$id_deporte]);
    $deporte = $consulta->fetch();
} else {
    header("Location: datos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Deporte</title>
    <link rel="stylesheet" href="css/carta.css">
</head>
<body>
    <h1>Información del Deporte</h1>
    <div class="carta">
        <p><strong>Nombre:</strong> <?php echo $deporte['NOMBRE']; ?></p>
        <p><strong>Jugadores:</strong> <?php echo $deporte['NUM_JUGADORES']; ?></p>
        <p><strong>Superficie:</strong> <?php echo $deporte['SUPERFICIE']; ?></p>
        <p><strong>URL Imagen:</strong> <?php echo $deporte['IMG']; ?></p>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($deporte['IMG_BLOB']); ?>" alt="Imagen del deporte" style="width: 300px; height: 300px;"></p>
    </div>
    <br>
    <a href="datos.php" style="text-decoration: none; background-color: #0c0962; color: #FFF; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s;">Volver atrás</a>
</body>
</html>
