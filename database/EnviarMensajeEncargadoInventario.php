<?php
session_start();
require_once 'connection.php';

if (isset($_POST['id_mensaje']) && isset($_POST['respuesta'])) {
    $id_mensaje = $_POST['id_mensaje'];
    $respuesta = $_POST['respuesta'];
    $id_encargado = $_SESSION['id']; // Asumiendo que la sesión almacena el ID del encargado

    $query = $conn->prepare("
        UPDATE mensajes_por_producto
        SET respuesta = ?, estado = 'respondido', fecha_respuesta = NOW(), id_encargado = ?
        WHERE id = ?
    ");
    $query->bind_param('sii', $respuesta, $id_encargado, $id_mensaje);
    $query->execute();

    header('Location: ../views/clientesPorResponder.php');
    exit();
} else {
    echo "Datos insuficientes para procesar la solicitud.";
}
?>
