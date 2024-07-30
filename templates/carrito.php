<?php
session_start();
require_once '../database/connection.php';

$products_in_cart = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT p.nombre, p.precio, c.cantidad, c.total FROM CarritoCompra c INNER JOIN Productos p ON c.id_producto = p.id WHERE c.id_cliente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
} else {
    $query = "SELECT p.nombre, p.precio, c.cantidad, c.total FROM CarritoCompra c INNER JOIN Productos p ON c.id_producto = p.id WHERE c.id_cliente_no_registrado = 1";
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $products_in_cart[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
</head>
<body>
    <h1>Carrito de Compra</h1>
    <?php if (empty($products_in_cart)) : ?>
        <p>No hay productos en el carrito.</p>
    <?php else : ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            <?php foreach ($products_in_cart as $product) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($product['precio']); ?></td>
                    <td><?php echo htmlspecialchars($product['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($product['total']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
