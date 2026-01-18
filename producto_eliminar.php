<?php
include 'conexion.php';
$id = $_GET['id'];

$conexion->query("DELETE FROM productos_extra WHERE id=$id");

header("Location: productos.php");
