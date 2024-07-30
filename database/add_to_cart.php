<?php
session_start();
require_once '../database/connection.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO CarritoCompra (id_cliente, id_producto, cantidad) VALUES (?, ?, ?)
                  ON DUPLICATE KEY UPDATE cantidad = cantidad + VALUES(cantidad)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $user_id, $product_id, $cantidad);
    } else {
        $query = "INSERT INTO CarritoCompra (id_cliente_no_registrado, id_producto, cantidad) VALUES (1, ?, ?)
                  ON DUPLICATE KEY UPDATE cantidad = cantidad + VALUES(cantidad)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $product_id, $cantidad);
    }

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Producto agregado al carrito.';
    } else {
        $response['message'] = 'Error al agregar el producto al carrito.';
    }

    $stmt->close();
} else {
    $response['message'] = 'ID del producto no especificado.';
}

echo json_encode($response);
?>
