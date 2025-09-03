<?php

session_start();

$servidor = "193.203.175.237:3306";
$usuario = "u992749838_dwaa_armario";
$contrasena = "DWAA_armario25#";
$base_datos = "u992749838_dwaa_armario";

$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

$sql = "SELECT * FROM productos";
$result1 = $conn->query($sql);

$sql = "SELECT * FROM ventas";
$result2 = $conn->query($sql);

?>
