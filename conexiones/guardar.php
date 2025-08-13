<?php

include "../conexiones/conexion.php";


// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $contraseña = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = "User";

    // Preparar la consulta SQL
    $sql = "INSERT INTO clientes (nombre,apellido,correo,contraseña,rol)
            VALUES (?, ?, ?, ?, ?)";

    // Preparar el statement
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        // Asegúrate de que el número de parámetros coincide con los valores de la consulta SQL
        $stmt->bind_param("sssss", $nombre,$apellido,$correo,$contraseña,$rol);

        // Ejecutar el statement
        if ($stmt->execute()) {

            if (isset($_SESSION['nombre'])) {
                header("Location:../conexiones/tables.php");
            } else {
                header("Location:../principales/Login.html");
            }

        } else {
            echo "Error al guardar los datos: " . $conn->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();

?>
