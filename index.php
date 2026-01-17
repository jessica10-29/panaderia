<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Pedidos</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
    
<header class="top-bar">
    <span>👤 Bienvenido,hhh <?php echo $_SESSION['usuario']; ?></span>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
</header>
<div class="container">
<h1>🥐 Pedido Panadería</h1>
<form action="guardar.php" method="POST">
<label>Nombre del Cliente</label>
<input type="text" name="cliente" required>


<h3>Productos</h3>
<div class="grid">
<input type="number" name="bunuelos" placeholder="Buñuelos">
<input type="number" name="pan_basico" placeholder="Pan básico">
<input type="number" name="croissant" placeholder="Croissant">
<input type="number" name="pandebono" placeholder="Pandebono">
<input type="number" name="pasteles" placeholder="Pasteles">
<input type="number" name="palitos_queso" placeholder="Palitos de queso">
<input type="number" name="jugos" placeholder="Jugos">
<input type="number" name="cafe" placeholder="Café">
<input type="number" name="galletas" placeholder="Galletas">
<input type="number" name="pan_queso" placeholder="Pan de queso">
<input type="number" name="empanadas" placeholder="Empanadas">
<input type="number" name="tortas" placeholder="Tortas">
</div>


<label>Estado del Pedido</label>
<select name="estado">
<option>En espera</option>
<option>En proceso</option>
<option>Despachado</option>
</select>


<button type="submit">Guardar Pedido</button>
<a href="pedidos.php" class="btn">Ver Pedidos</a>
</form>
</div>
</body>
</html>