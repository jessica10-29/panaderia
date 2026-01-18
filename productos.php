<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inventario</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="top-bar">
    <span>📦 Inventario de Productos</span>
    <a href="index.php" class="btn">Pedidos</a>
    <a href="logout.php" class="btn-logout">Salir</a>
</header>

<div class="container">

<h2>➕ Agregar producto</h2>

<form action="producto_guardar.php" method="POST" class="form-mini">
    <input type="text" name="nombre" placeholder="Nombre del producto" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <button>Guardar</button>
</form>

<h2>📋 Productos registrados</h2>

<table>
<tr>
<th>Producto</th>
<th>Precio</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php
$res = $conexion->query("SELECT * FROM productos_extra");
while($p = $res->fetch_assoc()){
?>
<tr>
<td><?= $p['nombre'] ?></td>
<td>$ <?= number_format($p['precio'],0,',','.') ?></td>
<td><?= $p['activo'] ? 'Activo' : 'Inactivo' ?></td>
<td>
<a class="btn-edit" href="producto_estado.php?id=<?= $p['id'] ?>">
<?= $p['activo'] ? '❌ Desactivar' : '✅ Activar' ?>
</a>
<a class="btn-del" href="producto_eliminar.php?id=<?= $p['id'] ?>"
onclick="return confirm('¿Eliminar producto?')">
🗑 Eliminar
</a>
</td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
