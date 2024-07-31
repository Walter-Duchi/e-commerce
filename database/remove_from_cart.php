<?php
session_start();
require_once '../database/connection.php';

if (isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

    if (isset($_SESSION['user_id'])) {
        // Cliente registrado
        $query = "DELETE FROM CarritoCompra WHERE id_cliente = ? AND id_producto = (SELECT id FROM Productos WHERE nombre = ? LIMIT 1)";
    } else {
        // Cliente no registrado
        $query = "DELETE FROM CarritoCompra WHERE id_cliente_no_registrado = ? AND id_producto = (SELECT id FROM Productos WHERE nombre = ? LIMIT 1)";
    }

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("is", $user_id, $product_name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to remove item from cart.'));
    }

    $stmt->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}
?>
