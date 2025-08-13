<?php

include "../conexiones/conexion.php";

if (!isset($_SESSION['nombre'])) {
    header("Location: ../principales/login.html");
    exit();
}

$ID = $_POST['id'];

$tabla = $_POST['eliminarR'];

// Obtener datos del usuario
$stmt = $conn->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos actuales
    $sql_select = "SELECT*FROM clientes WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $ID);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $usuario = $result->fetch_assoc(); // Por si necesitas mostrar o registrar antes de eliminar

    $sql_select = "SELECT*FROM productos WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $ID);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $usuario = $result->fetch_assoc();

    
    if ( $tabla == 'ElimUser') {
        
        $sql = "DELETE FROM clientes WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ID);
        $stmt->execute();

        header("Location: ./tables.php");
        exit();

    } elseif ($tabla == 'ElimPro') {
        
        $sql = "DELETE FROM productos WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ID);
        $stmt->execute();

        header("Location: ./tables.php");
        exit();
    }
    

    $stmt->close();
}

$conn->close();
?>