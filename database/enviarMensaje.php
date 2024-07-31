<?php
session_start();
require_once('connection.php');

if (isset($_POST['id_mensaje']) && isset($_POST['respuesta'])) {
    $id_mensaje = $_POST['id_mensaje'];
    $respuesta = $_POST['respuesta'];
    $id_encargado = $_SESSION['id_usuario']; // Asumiendo que la sesión almacena el ID del encargado
    $nombre_usuario = $_SESSION['nombre_usuario']; // Asumiendo que la sesión almacena el nombre del usuario

    $query = $conn->prepare('
        INSERT INTO MensajesForo (id_producto, id_encargado, id_respuesta_a, nombre_usuario, mensaje) 
        SELECT id_producto, ?, id, ?, ? 
        FROM MensajesForo 
        WHERE id = ?
    ');
    $query->bind_param('issi', $id_encargado, $id_mensaje, $nombre_usuario, $respuesta);
    $query->execute();

    // Consulta para actualizar el estado del mensaje original
    $query = $conn->prepare('UPDATE MensajesForo SET estado = TRUE WHERE id = ?');
    $query->bind_param('i', $id_mensaje);
    $query->execute();

    header('Location: ../index.php?page=clientes_por_responder');
    exit();
} else {
    echo "Datos insuficientes para procesar la solicitud.";
}
?>
