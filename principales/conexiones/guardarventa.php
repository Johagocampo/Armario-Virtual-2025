<?php

include "../conexiones/conexion.php";


// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = $_POST['cliente'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $cantidad = $_POST['cantidad'];
    $metodoPago = $_POST['pago'];;
    
    $total_raw = $_POST['total'];
    $total_sin_signo = str_replace('$', '', $total_raw);
    $total = str_replace('.', '', $total_sin_signo);

    // Preparar la consulta SQL
    $sql = "INSERT INTO ventas (cliente,direccion,fecha,cantidadP,metodoPago,total)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar el statement
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        // Asegúrate de que el número de parámetros coincide con los valores de la consulta SQL
        $stmt->bind_param("ssssss", $nombre,$direccion,$fecha,$cantidad,$metodoPago,$total);

        // Ejecutar el statement
        if ($stmt->execute()) {
            
            header("Location:../principales/venta.php");
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
