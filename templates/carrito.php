<?php
session_start();
require_once '../database/connection.php';

$total_products = 0;
$productos_carrito = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT Productos.nombre, Productos.precio, CarritoCompra.cantidad 
              FROM CarritoCompra 
              JOIN Productos ON CarritoCompra.id_producto = Productos.id 
              WHERE CarritoCompra.id_cliente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
} else {
    $user_id = 1; // Cliente no registrado
    $query = "SELECT Productos.nombre, Productos.precio, CarritoCompra.cantidad 
              FROM CarritoCompra 
              JOIN Productos ON CarritoCompra.id_producto = Productos.id 
              WHERE CarritoCompra.id_cliente_no_registrado = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $productos_carrito[] = $row;
    $total_products += $row['cantidad'];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/navbar-footer.css">
</head>
<body>
    <main>
        <h1>Carrito de Compras</h1>
        <p>Total de productos: <?php echo $total_products; ?></p>
        <div class="carrito">
            <?php if (empty($productos_carrito)): ?>
                <p>Tu carrito está vacío.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($productos_carrito as $producto): ?>
                        <li>
                            <?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?> x <?php echo $producto['cantidad']; ?>
                            <button class="remove-item" data-name="<?php echo $producto['nombre']; ?>">Eliminar</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
               
            <?php endif; ?>
        </div>
        <a href="../index.php">Volver a la tienda</a>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.remove-item').click(function() {
            var productName = $(this).data('name');
            $.post('../database/remove_from_cart.php', { product_name: productName }, function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert('No se pudo eliminar el producto del carrito.');
                }
            });
        });

        $('#clear-cart').click(function() {
            $.post('../database/clear_cart.php', function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert('No se pudo vaciar el carrito.');
                }
            });
        });
    });
    </script>
</body>
</html>
