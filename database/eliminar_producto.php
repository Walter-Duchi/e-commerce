<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Productos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error eliminando el producto: " . $conn->error;
    }

    $conn->close();
    header('Location: ../index.php');
}
?>
