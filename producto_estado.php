<?php
include 'conexion.php';
$id = $_GET['id'];

$conexion->query("
UPDATE productos_extra 
SET activo = IF(activo=1,0,1) 
WHERE id=$id
");

header("Location: productos.php");
