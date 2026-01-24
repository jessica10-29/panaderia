<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'conexion.php';

// Array de productos con imágenes y precios
$productos = [
    'bunuelos' => ['nombre' => 'Buñuelos', 'precio' => 1500, 'img' => 'https://loremflickr.com/300/200/fritter,food'],
    'pan_basico' => ['nombre' => 'Pan Básico', 'precio' => 1000, 'img' => 'https://loremflickr.com/300/200/bread'],
    'croissant' => ['nombre' => 'Croissant', 'precio' => 2500, 'img' => 'https://loremflickr.com/300/200/croissant'],
    'pandebono' => ['nombre' => 'Pandebono', 'precio' => 2000, 'img' => 'https://loremflickr.com/300/200/cheese,bread'],
    'pasteles' => ['nombre' => 'Pasteles', 'precio' => 3000, 'img' => 'https://loremflickr.com/300/200/pastry'],
    'palitos_queso' => ['nombre' => 'Palitos Queso', 'precio' => 1800, 'img' => 'https://loremflickr.com/300/200/cheese,stick'],
    'jugos' => ['nombre' => 'Jugos', 'precio' => 2500, 'img' => 'https://loremflickr.com/300/200/juice'],
    'cafe' => ['nombre' => 'Café', 'precio' => 1500, 'img' => 'https://loremflickr.com/300/200/coffee'],
    'galletas' => ['nombre' => 'Galletas', 'precio' => 1200, 'img' => 'https://loremflickr.com/300/200/cookie'],
    'pan_queso' => ['nombre' => 'Pan de Queso', 'precio' => 2000, 'img' => 'https://loremflickr.com/300/200/bread,cheese'],
    'empanadas' => ['nombre' => 'Empanadas', 'precio' => 2200, 'img' => 'https://loremflickr.com/300/200/empanada'],
    'tortas' => ['nombre' => 'Tortas', 'precio' => 3500, 'img' => 'https://loremflickr.com/300/200/cake']
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú Interactivo - Panadería</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header class="top-bar animate-fade-in">
        <span>🥐 Nuevo Pedido Interactivo</span>
        <nav class="menu">
            <a href="index.php" class="btn">🏠 Clásico</a>
            <a href="pedidos.php" class="btn">📦 Ver Pedidos</a>
        </nav>
    </header>

    <div class="container animate-fade-in">
        <h1><i class="fa-solid fa-store"></i> Menú de Productos</h1>
        <p style="text-align:center; color: #666; margin-bottom: 30px;">Selecciona los productos para tu pedido con
            nuestro menú visual.</p>

        <form action="guardar.php" method="POST" id="orderForm">

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="font-weight:600; font-size:1.1rem; color:var(--primary-color);">👤 Nombre del
                    Cliente</label>
                <input type="text" name="cliente" required placeholder="Escribe el nombre del cliente..."
                    style="padding: 15px;">
            </div>

            <div class="menu-grid">
                <?php foreach ($productos as $key => $prod): ?>
                    <div class="product-card">
                        <div style="overflow:hidden;">
                            <img src="<?= $prod['img'] ?>" alt="<?= $prod['nombre'] ?>" class="product-image">
                        </div>
                        <div class="product-info">
                            <div>
                                <div class="product-title">
                                    <?= $prod['nombre'] ?>
                                </div>
                                <div class="product-price">$
                                    <?= number_format($prod['precio'], 0, ',', '.') ?>
                                </div>
                            </div>

                            <div class="stepper">
                                <button type="button" class="stepper-btn" onclick="updateQty('<?= $key ?>', -1)">-</button>
                                <input type="number" name="<?= $key ?>" id="<?= $key ?>" class="stepper-input" value="0"
                                    min="0" readonly>
                                <button type="button" class="stepper-btn" onclick="updateQty('<?= $key ?>', 1)">+</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Extras -->
            <h3 style="margin-top: 40px; text-align: center;">🍪 Productos Adicionales</h3>
            <div class="extras-grid">
                <?php
                $res = $conexion->query("SELECT * FROM productos_extra WHERE activo = 1");
                while ($p = $res->fetch_assoc()) {
                    ?>
                    <div class="extra-card" style="padding: 15px;">
                        <span class="extra-nombre" style="font-size:1rem;">
                            <?= $p['nombre'] ?>
                        </span>
                        <span class="extra-precio" style="font-size:0.9rem;">$
                            <?= number_format($p['precio'], 0, ',', '.') ?>
                        </span>
                        <input type="number" name="extra[<?= $p['id'] ?>]" min="0" value="0" class="extra-input"
                            style="width: 60px; padding: 5px;">
                    </div>
                <?php } ?>
            </div>

            <div class="order-footer">
                <div>
                    <label>Estado:</label>
                    <select name="estado" style="padding: 10px; border-radius: 8px;">
                        <option>En espera</option>
                        <option>En proceso</option>
                        <option>Despachado</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="font-size: 1.1rem; padding: 15px 30px;">
                    <i class="fa-solid fa-check"></i> Confirmar Pedido
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateQty(id, change) {
            const input = document.getElementById(id);
            let newVal = parseInt(input.value) + change;
            if (newVal < 0) newVal = 0;
            input.value = newVal;
        }
    </script>

</body>

</html>