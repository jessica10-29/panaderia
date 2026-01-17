<?php
$conexion = new mysqli("localhost:3307", "root", "", "panaderia");
if ($conexion->connect_error) {
die("Error de conexión: " . $conexion->connect_error);
}
?>