<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

$id = (int)$_POST['id'];
$cliente = $_POST['cliente'];
$estado = $_POST['estado'];

$campos = [
 'bunuelos','pan_basico','croissant','pandebono','pasteles',
 'palitos_queso','jugos','cafe','galletas',
 'pan_queso','empanadas','tortas'
];

$valores = [];
foreach ($campos as $c) {
    $valores[$c] = isset($_POST[$c]) ? (int)$_POST[$c] : 0;
}

$sql = "UPDATE pedidos SET
cliente='$cliente',
bunuelos={$valores['bunuelos']},
pan_basico={$valores['pan_basico']},
croissant={$valores['croissant']},
pandebono={$valores['pandebono']},
pasteles={$valores['pasteles']},
palitos_queso={$valores['palitos_queso']},
jugos={$valores['jugos']},
cafe={$valores['cafe']},
galletas={$valores['galletas']},
pan_queso={$valores['pan_queso']},
empanadas={$valores['empanadas']},
tortas={$valores['tortas']},
estado='$estado'
WHERE id=$id";

if (!$conexion->query($sql)) {
    die("Error al actualizar: " . $conexion->error);
}

header("Location: pedidos.php");
exit;
