<?php

include("conexion.php");

if (isset($_GET['id']) && isset($_GET['cantidad']) ) {

    $ID = $_GET['id'];
    $N_cantidad = $_GET['cantidad'];

    $stmt = $conn->prepare("SELECT * FROM carrito WHERE id = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $sql_select = "SELECT imagen,nombre,cantidad,talla,precio,total FROM carrito WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $ID);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $valor_actual = $result->fetch_assoc();
    $stmt_select->close();
    
    // Nuevos datos (o mantener los anteriores si están vacíos)
    $imagenes = $valor_actual['imagen'];
    $nombres =  $valor_actual['nombre'];
    $cantidades = $N_cantidad;
    $tallas = $valor_actual['talla'];
    $precios = $valor_actual['precio'];
    $total = ($precios*$cantidades);

    // Actualizar datos
    $sql = "UPDATE carrito SET imagen = ?, nombre = ?,cantidad = ?,talla = ?, precio = ?, total = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi",$imagenes, $nombres, $cantidades,$tallas,$precios,$total,$ID);

    if ($stmt->execute()) {
        
        header("Location: ../principales/carrito.php");

    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
