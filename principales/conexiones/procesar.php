<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ID = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    if (isset($_POST['submit_file'])) {
        if ($_POST['submit_file'] === 'file1') {
            $_SESSION['id'] = $ID;
            $_SESSION['cantidad'] = $cantidad;
            header("Location: actualizarCantidad.php?id=" . $_SESSION['id'] . "&cantidad=" . $_SESSION['cantidad']);
            exit;
        } elseif ($_POST['submit_file'] === 'file2') {
            $_SESSION['id'] = $ID;
            header("Location: eliminardelcarro.php?id=" . $_SESSION['id']);
            exit;
        }
    }
}
?>
