<?php

include "../conexiones/conexion.php";

// Verificar si hay error de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$correo = $_POST['email'];
$contraseña = $_POST['password'];

// Preparar la consulta para buscar al usuario por correo
$sql = "SELECT * FROM clientes WHERE correo = ?";

// Usar una sentencia preparada para evitar inyecciones SQL
if ($stmt = $conn->prepare($sql)) {
    // Enlazar el parámetro
    $stmt->bind_param("s", $correo); // "s" para string

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        $comprobar = password_verify($contraseña, $user['contraseña']);
        $rol = $user['rol'];

        if ($comprobar && $rol == "User") {
            header("Location: ../principales/main.php");
            $_SESSION['nombre'] = $user['nombre'];
            exit();

        }elseif ($comprobar && $rol == "Admin"){
            header("Location: ../principales/index_admin.php");
            $_SESSION['nombre'] = $user['nombre'];
            exit();
        } else {
            header("Location: ../principales/Login.html?hasError=true");
            exit();
        }
    } else {
        header("Location: ../principales/Login.html?hasError=true");
        exit();
    }

    // Cerrar la sentencia
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
