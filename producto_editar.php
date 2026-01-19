<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

$id = $_GET['id'] ?? 0;

// Obtener producto
$res = $conexion->query("SELECT * FROM productos_extra WHERE id=$id");
$p = $res->fetch_assoc();

if (!$p) {
    die("Producto no encontrado");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">
<h2>✏️ Editar Producto</h2>

<form action="producto_actualizar.php" method="POST" class="form-mini">
    <input type="hidden" name="id" value="<?= $p['id'] ?>">

    <label>Nombre</label>
    <input type="text" name="nombre" value="<?= $p['nombre'] ?>" required>

    <label>Precio</label>
    <input type="number" name="precio" value="<?= $p['precio'] ?>" required>

    <button>Actualizar</button>
    <a href="productos.php" class="btn">Cancelar</a>
</form>
</div>

</body>
</html>
