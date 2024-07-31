<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $cantidad = 1; // Se agrega una unidad por defecto

    if (isset($_SESSION['id_usuario'])) {
        $user_id = $_SESSION['id_usuario'];
        // Verificar si el producto ya está en el carrito del usuario
        $sql = "SELECT id, cantidad FROM CarritoCompra WHERE id_cliente = ? AND id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
    } else {
        $user_id = 1; // Cliente no registrado
        // Verificar si el producto ya está en el carrito del cliente no registrado
        $sql = "SELECT id, cantidad FROM CarritoCompra WHERE id_cliente_no_registrado = ? AND id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $row = $result->fetch_assoc();
        $new_quantity = $row['cantidad'] + 1;
        $update_sql = "UPDATE CarritoCompra SET cantidad = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $row['id']);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Si el producto no está en el carrito, insertarlo
        $insert_sql = "INSERT INTO CarritoCompra (id_cliente, id_cliente_no_registrado, id_producto, cantidad) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $null = NULL; // Variable para pasar como parámetro NULL
        if (isset($_SESSION['id_usuario'])) {
            $insert_stmt->bind_param("iiii", $user_id, $null, $product_id, $cantidad);
        } else {
            $insert_stmt->bind_param("iiii", $null, $user_id, $product_id, $cantidad);
        }
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $stmt->close();
    header("Location: ../index.php");
    exit();
}
?>
