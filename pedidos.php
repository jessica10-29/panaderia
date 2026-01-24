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
    <a href="index.php" class="btn-logout">Volver</a>
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

<form method="GET" action="pedidos.php" style="margin-bottom: 20px;">
    <input type="text" name="q" placeholder="Buscar por cliente o ID..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" style="padding: 5px; width: 250px;">
    <button type="submit" class="btn">Buscar</button>
</form>

<?php
$where = "";
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $busqueda = $conexion->real_escape_string($_GET['q']);
    $where = "WHERE cliente LIKE '%$busqueda%' OR id = '$busqueda'";
}

$res = $conexion->query("SELECT * FROM pedidos $where ORDER BY id DESC");

while($p = $res->fetch_assoc()){

echo "<tr>";
echo "<td>{$p['id']}</td>";
echo "<td>{$p['cliente']}</td>";

echo "<td>";
echo "🥐 Buñuelos: {$p['bunuelos']}<br>";
echo "🥖 Pan básico: {$p['pan_basico']}<br>";
echo "☕ Café: {$p['cafe']}<br>";
echo "🧀 Pandebono: {$p['pandebono']}<br>";

$extras = $conexion->query("
    SELECT pe.cantidad, pr.nombre
    FROM pedido_productos_extra pe
    JOIN productos_extra pr ON pr.id = pe.producto_id
    WHERE pe.pedido_id = {$p['id']}
");

if ($extras->num_rows > 0) {
    echo "<hr><strong> Productos adicionales:</strong><br>";
    while ($e = $extras->fetch_assoc()) {
        echo "{$e['nombre']}: {$e['cantidad']}<br>";
    }
}

echo "</td>";
echo "<td>$ {$p['total']}</td>";
echo "<td>{$p['estado']}</td>";

echo "<td>
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
</td>";

echo "</tr>";

}
?>
</table>

<a href="index.php" class="btn"> Nuevo Pedido</a>
</div>

</body>
</html>
