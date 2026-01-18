<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

// Datos base
$cliente = $_POST['cliente'];
$estado  = $_POST['estado'];

// Productos
$campos = [
 'bunuelos','pan_basico','croissant','pandebono','pasteles',
 'palitos_queso','jugos','cafe','galletas',
 'pan_queso','empanadas','tortas'
];

// Precios
$precios = [
 'bunuelos'=>1500,
 'pan_basico'=>1000,
 'croissant'=>2500,
 'pandebono'=>2000,
 'pasteles'=>3000,
 'palitos_queso'=>1800,
 'jugos'=>2500,
 'cafe'=>1500,
 'galletas'=>1200,
 'pan_queso'=>2000,
 'empanadas'=>2200,
 'tortas'=>3500
];

// Cantidades y total
$valores = [];
$total = 0;

foreach ($campos as $c) {
    $valores[$c] = isset($_POST[$c]) && $_POST[$c] !== ''
        ? (int)$_POST[$c]
        : 0;

    $total += $valores[$c] * $precios[$c];
}

// INSERT
$sql = "INSERT INTO pedidos (
 cliente, bunuelos, pan_basico, croissant, pandebono, pasteles,
 palitos_queso, jugos, cafe, galletas, pan_queso,
 empanadas, tortas, total, estado
) VALUES (
 '$cliente',
 {$valores['bunuelos']},
 {$valores['pan_basico']},
 {$valores['croissant']},
 {$valores['pandebono']},
 {$valores['pasteles']},
 {$valores['palitos_queso']},
 {$valores['jugos']},
 {$valores['cafe']},
 {$valores['galletas']},
 {$valores['pan_queso']},
 {$valores['empanadas']},
 {$valores['tortas']},
 $total,
 '$estado'
)";

// Ejecutar
if (!$conexion->query($sql)) {
    die("❌ Error al guardar pedido: " . $conexion->error);
}

// 🔹 ID del pedido recién guardado
$pedido_id = $conexion->insert_id;

// 🔹 Guardar productos nuevos (productos_extra)
if (isset($_POST['extra'])) {

    foreach ($_POST['extra'] as $id_producto => $cantidad) {

        if ($cantidad > 0) {

            // Obtener precio del producto
            $res = $conexion->query(
                "SELECT precio FROM productos_extra WHERE id=$id_producto"
            );
            $p = $res->fetch_assoc();
            



            $precio = $p['precio'];

            // Insertar detalle
            $conexion->query("
                INSERT INTO pedido_productos_extra
                (pedido_id, producto_id, cantidad, precio)
                VALUES
                ($pedido_id, $id_producto, $cantidad, $precio)
            ");
        }
    }
}


header("Location: pedidos.php");
exit;
