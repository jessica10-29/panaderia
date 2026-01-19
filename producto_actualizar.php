<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexion.php';

$id     = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];

$conexion->query("
    UPDATE productos_extra 
    SET nombre='$nombre', precio=$precio 
    WHERE id=$id
");

header("Location: productos.php");
exit;
