<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mensaje']) && isset($_POST['product_id'])) {
    $mensaje = trim($_POST['mensaje']);
    $product_id = intval($_POST['product_id']);
    require_once('connection.php');

    if (!empty($mensaje) && isset($_SESSION['nombre']) && isset($_SESSION['tipo_usuario'])) {
        $nombre_usuario = $_SESSION['nombre'];
        $id_usuario = $_SESSION['id_usuario'] ?? NULL;
        $id_encargado = $_SESSION['id_encargado'] ?? NULL;

        $query = $conn->prepare('
            INSERT INTO MensajesForo (id_producto, id_usuario, id_encargado, nombre_usuario, mensaje) 
            VALUES (?, ?, ?, ?, ?)
        ');
        $query->bind_param('iiiss', $product_id, $id_usuario, $id_encargado, $nombre_usuario, $mensaje);
        if ($query->execute()) {
            header('Location: ../index.php?page=detalleProducto&product_id=' . $product_id);
            exit();
        } else {
            echo "Error al enviar el mensaje.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
