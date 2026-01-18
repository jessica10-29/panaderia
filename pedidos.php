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
<title>Pedidos</title>
<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<header class="top-bar">
    <span>📦 Lista de Pedidos</span>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
</header>

<div class="container">
<h1>📦 Pedidos Registrados</h1>

<table>
<tr>
<th>ID</th>
<th>Cliente</th>
<th>Productos</th>
<th>Total</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php
$res = $conexion->query("SELECT * FROM pedidos ORDER BY id DESC");

while($p = $res->fetch_assoc()){
echo "<tr>
<td>{$p['id']}</td>
<td>{$p['cliente']}</td>
<td>
🥐 Buñuelos: {$p['bunuelos']}<br>
🥖 Pan básico: {$p['pan_basico']}<br>
☕ Café: {$p['cafe']}<br>
🧀 Pandebono: {$p['pandebono']}<br>
</td>
<td>$ {$p['total']}</td>
<td>{$p['estado']}</td>
<td>
  <div class='acciones'>
    <a href='editar.php?id={$p['id']}' class='icon-btn edit' title='Editar'>
      <i class='fa-solid fa-pen-to-square'></i>
    </a>

    <a href='eliminar.php?id={$p['id']}'
       class='icon-btn delete'
       title='Eliminar'
       onclick=\"return confirm('¿Eliminar pedido?')\">
      <i class='fa-solid fa-trash'></i>
    </a>
  </div>
</td>

</tr>";
}
?>
</table>

<a href="index.php" class="btn"> Nuevo Pedido</a>
</div>

</body>
</html>
