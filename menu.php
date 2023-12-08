<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit;
}

include 'conn.php';

$ID = $_SESSION['ID'];

$stmt = $con->prepare('SELECT ROL FROM usuarios WHERE ID = :ID');
$stmt->bindParam(':ID', $ID);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result && isset($result['ROL'])) {
    $rol = $result['ROL'];
    $_SESSION["ROL"] = $rol;
} else {
    $rol = 'user';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <div>
        <a href="datos.php">> Consultar datos</a>
        <?php 
        if ($rol === 'admin'){
            echo "<a href='introducir.php'>> Introducir datos</a>";
        } 
        ?>
        <a href="logout.php">> Cerrar sesión</a>
    </div>
</body>
</html>
