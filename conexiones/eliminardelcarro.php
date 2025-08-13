<?php

include "../conexiones/conexion.php";

if (!isset($_SESSION['nombre'])) {
    header("Location: ../principales/login.html");
    exit();
}

if (isset($_GET['id'])) {

    $ID = $_GET['id'];

    // Obtener datos del usuario
    $stmt = $conn->prepare("SELECT * FROM carrito WHERE id = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $sql_select = "SELECT*FROM carrito WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $ID);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $usuario = $result->fetch_assoc();

    $sql = "DELETE FROM carrito WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);
    $stmt->execute();


    if ($stmt->execute()) {

        header("Location: ../principales/carrito.php");
        exit();

    }else{
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
?>