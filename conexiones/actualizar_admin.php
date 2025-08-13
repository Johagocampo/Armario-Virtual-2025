<?php
include "../conexiones/conexion.php";
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../principales/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['id'];
    $tabla = $_POST['eliminarR'];

    if ($tabla == 'ElimUser') {
        $sql_select = "SELECT nombre, apellido, correo, rol, direccion, telefono FROM clientes WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $ID);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $usuario_actual = $result->fetch_assoc();
        $stmt_select->close();

        $nombres    = $_POST['nombre']    ?: $usuario_actual['nombre'];
        $apellidos  = $_POST['apellido']  ?: $usuario_actual['apellido'];
        $correos    = $_POST['correo']    ?: $usuario_actual['correo'];
        $telefonos  = $_POST['telefono']  ?: $usuario_actual['telefono'];
        $direcciones= $_POST['direccion']?: $usuario_actual['direccion'];
        $roles      = $_POST['rol']       ?: $usuario_actual['rol'];

        $sql = "UPDATE clientes SET nombre = ?, apellido = ?, correo = ?, rol = ?, direccion = ?, telefono = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombres, $apellidos, $correos, $roles, $direcciones, $telefonos, $ID);
        $stmt->execute();
        $stmt->close();

    } elseif ($tabla == 'ElimPro') {
        $sql_select = "SELECT nombre, precio, tipo, genero, cantidad FROM productos WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $ID);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $producto_actual = $result->fetch_assoc();
        $stmt_select->close();

        $nombreP   = $_POST['nombreP']  ?: $producto_actual['nombre'];
        $precioP   = $_POST['precioP']  ?: $producto_actual['precio'];
        $tipoP     = $_POST['tipoP']    ?: $producto_actual['tipo'];
        $generoP   = $_POST['generoP']  ?: $producto_actual['genero'];
        $cantidadP = $_POST['cantidadP']?: $producto_actual['cantidad'];

        $sql = "UPDATE productos SET nombre = ?, precio = ?, tipo = ?, genero = ?, cantidad = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssii", $nombreP, $precioP, $tipoP, $generoP, $cantidadP, $ID);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ./tables.php");
    exit();
}

$conn->close();
?>
