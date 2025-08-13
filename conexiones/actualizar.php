<?php

include "../conexiones/conexion.php";

if (!isset($_SESSION['nombre'])) {
    header("Location: ../principales/login.html");
    exit();
}


$nombre = $_SESSION['nombre'];

// Obtener datos del usuario
$stmt = $conn->prepare("SELECT * FROM clientes WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos actuales
    $sql_select = "SELECT nombre,apellido,correo,direccion,telefono FROM clientes WHERE nombre = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("s", $nombre);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $usuario_actual = $result->fetch_assoc();
    $stmt_select->close();
    
    // Nuevos datos (o mantener los anteriores si están vacíos)
    $nombres = !empty($_POST['nombre']) ? $_POST['nombre'] : $usuario_actual['nombre'];
    $apellidos = !empty($_POST['apellido']) ? $_POST['apellido'] : $usuario_actual['apellido'];
    $correos = !empty($_POST['correo']) ? $_POST['correo'] : $usuario_actual['correo'];
    $direcciones = !empty($_POST['direccion']) ? $_POST['direccion'] : $usuario_actual['direccion'];
    $telefonos = !empty($_POST['telefono']) ? $_POST['telefono'] : $usuario_actual['telefono'];

    // Actualizar datos
    $sql = "UPDATE clientes SET nombre = ?, apellido = ?,correo = ?,direccion = ?,telefono = ? WHERE nombre = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombres, $apellidos, $correos,$direcciones,$telefonos,$nombre);

    if ($stmt->execute()) {

        if ($user['rol'] == "User"){
            header("Location: ../principales/perfil.php");
            $nombre = $_SESSION['nombre'];
            exit();
        }else{
            header("Location: ./examples/Admin_profile.php");
            exit();
        }

    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
