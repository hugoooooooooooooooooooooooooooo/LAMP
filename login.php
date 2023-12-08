<?php
session_start();

if (isset($_SESSION['ID'])) {
	header("Location: menu.php");
	exit;
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once 'conn.php';

    $stmt = $con->prepare('SELECT ID, NAME, CONTRASEÑA FROM ges_deportes.usuarios WHERE NAME = :usuario');
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $_POST['password'] == $result['CONTRASEÑA']) {
        $_SESSION['ID'] = $result['ID'];
        header("Location: menu.php");
        exit;
    } else {
        $message = 'El usuario o la contraseña son incorrectos';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>LOGIN</h1>
    <form action="login.php" method="POST">
        <label for="usuario">Usuario: </label>
        <input type="text" placeholder="Usuario" name="usuario"><br>
        <label for="contrasena">Contraseña: </label>
        <input type="password" placeholder="Contraseña" name="password"><br>
        <input type="submit">
    </form>
</body>
</html>
