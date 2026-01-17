<?php
$servidor = "sql101.infinityfree.com";   // Host MySQL
$usuario  = "if0_40926963";             // Usuario MySQL
$clave    = "SH132410";              // Contraseña MySQL
$bd       = "if0_40926963_panaderia";   // Nombre BD

$conexion = new mysqli($servidor, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>
