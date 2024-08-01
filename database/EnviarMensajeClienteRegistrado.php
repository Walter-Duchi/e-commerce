<?php
require 'connection.php';

// Depurar datos enviados
var_dump($_POST);

if (isset($_POST['id_cliente']) && isset($_POST['id_producto']) && isset($_POST['mensaje'])) {
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $mensaje = $_POST['mensaje'];

    $query = "INSERT INTO mensajes_por_producto (id_producto, id_cliente, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $id_producto, $id_cliente, $mensaje);

    if ($stmt->execute()) {
        echo "Mensaje enviado exitosamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }

    $stmt->close();
    $conn->close();
} else {
    if (!isset($_POST['id_cliente'])) {
        echo "id_cliente no está definido.";
    }
    if (!isset($_POST['id_producto'])) {
        echo "id_producto no está definido.";
    }
    if (!isset($_POST['mensaje'])) {
        echo "mensaje no está definido.";
    }
}
?>
