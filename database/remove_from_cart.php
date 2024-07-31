<?php
session_start();
require_once 'connection.php';

$response = ['status' => 'error', 'message' => 'No se pudo eliminar el producto del carrito.'];

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = "DELETE FROM CarritoCompra WHERE id_producto = ? AND id_cliente = ?";
    } else {
        $user_id = 1; // Cliente no registrado
        $query = "DELETE FROM CarritoCompra WHERE id_producto = ? AND id_cliente_no_registrado = ?";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $product_id, $user_id);
    
    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Producto eliminado del carrito.';
    } else {
        $response['message'] = 'Error en la ejecución de la consulta.';
    }
    
    $stmt->close();
} else {
    $response['message'] = 'ID de producto no especificado.';
}

echo json_encode($response);
?>
