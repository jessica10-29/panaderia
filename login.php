<?php
session_start();
include 'conexion.php';

$error = "";

if ($_POST) {
    $usuario = $_POST['usuario'];
    $clave   = md5($_POST['clave']);

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
    $res = $conexion->query($sql);

    if ($res->num_rows > 0) {
        $_SESSION['admin'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: pedidos.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login | Panadería</title>
<link rel="stylesheet" href="estilos.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="login-body">

<div class="login-card">
    <h1>🥐 Panadería</h1>
    <p>Acceso administrador</p>

    <?php if($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
