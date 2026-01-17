<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

// Validar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID inválido");
}

$id = (int)$_GET['id'];

// Ejecutar DELETE
$sql = "DELETE FROM pedidos WHERE id = $id";

if (!$conexion->query($sql)) {
    die("❌ Error al eliminar: " . $conexion->error);
}

header("Location: pedidos.php");
exit;
