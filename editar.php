<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido");
}

$id = (int)$_GET['id'];
$p = $conexion->query("SELECT * FROM pedidos WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Pedido</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="top-bar">
    <span>✏️ Editar Pedido #<?php echo $id; ?></span>
    <a href="pedidos.php" class="btn">⬅ Volver</a>
</header>

<div class="container">
<h1>Editar Pedido</h1>

<form method="POST" action="actualizar.php">

<input type="hidden" name="id" value="<?php echo $id; ?>">

<label>Cliente</label>
<input type="text" name="cliente" value="<?php echo $p['cliente']; ?>" required>

<h3>Productos</h3>
<div class="grid">
<?php
$productos = [
 'bunuelos'=>'Buñuelos','pan_basico'=>'Pan básico','croissant'=>'Croissant',
 'pandebono'=>'Pandebono','pasteles'=>'Pasteles','palitos_queso'=>'Palitos de queso',
 'jugos'=>'Jugos','cafe'=>'Café','galletas'=>'Galletas',
 'pan_queso'=>'Pan de queso','empanadas'=>'Empanadas','tortas'=>'Tortas'
];

foreach ($productos as $campo=>$nombre) {
    echo "<input type='number' name='$campo' value='{$p[$campo]}' placeholder='$nombre'>";
}
?>
</div>

<label>Estado</label>
<select name="estado">
<option <?php if($p['estado']=='En espera') echo 'selected'; ?>>En espera</option>
<option <?php if($p['estado']=='En proceso') echo 'selected'; ?>>En proceso</option>
<option <?php if($p['estado']=='Despachado') echo 'selected'; ?>>Despachado</option>
</select>

<button type="submit">Actualizar Pedido</button>
</form>
</div>

</body>
</html>
