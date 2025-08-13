<?php

include "../conexiones/conexion.php";


// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $cantidad = 1;
    $talla = $_POST['talla'];

    $precio_raw = $_POST['precio'];
    $precio_sin_signo = str_replace('$', '', $precio_raw);
    $precio = str_replace('.', '', $precio_sin_signo);

    $total = ($precio*$cantidad);
    $cliente = $_SESSION['nombre'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO carrito (imagen,nombre,cantidad,talla,precio,total,cliente)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar el statement
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        // Asegúrate de que el número de parámetros coincide con los valores de la consulta SQL
        $stmt->bind_param("sssssss", $imagen,$nombre,$cantidad,$talla,$precio,$total,$cliente);

        // Ejecutar el statement
        if ($stmt->execute()) {
            header("Location:../principales/ejemplo.php");
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
