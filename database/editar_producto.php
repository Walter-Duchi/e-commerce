<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE Productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error actualizando el producto: " . $conn->error;
    }

    $conn->close();
    header('Location: ../index.php');
}
?>
