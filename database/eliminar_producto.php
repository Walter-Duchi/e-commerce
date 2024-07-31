<?php
session_start();
require_once 'connection.php';

if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $query = "";

    if (isset($_SESSION['id_usuario'])) {
        $id_cliente = $_SESSION['id_usuario'];
        $query = "DELETE FROM CarritoCompra WHERE id_producto = ? AND id_cliente = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id_producto, $id_cliente);
    } else {
        $id_cliente_no_registrado = 1;
        $query = "DELETE FROM CarritoCompra WHERE id_producto = ? AND id_cliente_no_registrado = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id_producto, $id_cliente_no_registrado);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Producto eliminado del carrito correctamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el producto del carrito.";
    }

    $stmt->close();
}

header("Location: ../templates/carrito.php");
exit();
?>
