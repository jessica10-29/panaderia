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
</head>
<body>
    
<header class="top-bar">
    <span>👤 Bienvenido <?php echo $_SESSION['usuario']; ?></span>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
</header>
<header class="top-bar">
    <span>📦 Agregar Nuevo Productos</span>

    <nav class="menu">
        <a href="productos.php" class="btn">📦 Productos</a>
        
    </nav>
</header>

<div class="container">
<h1>  Panadería</h1>
<form action="guardar.php" method="POST">
<label>Nombre del Cliente</label>
<input type="text" name="cliente" required>


<h3>Productos</h3>
<div class="grid">
    <div class="input-group">
        <label>🥐 Buñuelos <span>$1.500</span></label>
        <input type="number" name="bunuelos" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🥖 Pan básico <span>$1.000</span></label>
        <input type="number" name="pan_basico" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🥐 Croissant <span>$2.500</span></label>
        <input type="number" name="croissant" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🧀 Pandebono <span>$2.000</span></label>
        <input type="number" name="pandebono" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🍰 Pasteles <span>$3.000</span></label>
        <input type="number" name="pasteles" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🧀 Palitos queso <span>$1.800</span></label>
        <input type="number" name="palitos_queso" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🥤 Jugos <span>$2.500</span></label>
        <input type="number" name="jugos" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>☕ Café <span>$1.500</span></label>
        <input type="number" name="cafe" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🍪 Galletas <span>$1.200</span></label>
        <input type="number" name="galletas" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🧀 Pan de queso <span>$2.000</span></label>
        <input type="number" name="pan_queso" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🥟 Empanadas <span>$2.200</span></label>
        <input type="number" name="empanadas" placeholder="0" min="0">
    </div>
    <div class="input-group">
        <label>🎂 Tortas <span>$3.500</span></label>
        <input type="number" name="tortas" placeholder="0" min="0">
    </div>
</div>

<!-- ================= PRODUCTOS ADICIONALES ================= -->
<h3>🧾 Productos adicionales</h3>

<div class="extras-grid">
<?php
$res = $conexion->query("SELECT * FROM productos_extra WHERE activo = 1");

if ($res->num_rows == 0) {
    echo "<p>No hay productos adicionales</p>";
}

while($p = $res->fetch_assoc()){
?>
    <div class="extra-card">
        <span class="extra-nombre"><?= $p['nombre'] ?></span>
        <span class="extra-precio">$ <?= number_format($p['precio'],0,',','.') ?></span>
        <input type="number"
               name="extra[<?= $p['id'] ?>]"
               min="0"
               value="0"
               class="extra-input">
    </div>
<?php } ?>
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