<?php
session_start();
require_once '../database/connection.php';

$total_products = 0;
$productos_carrito = [];
$total_amount = 0.00;

if (isset($_SESSION['id_usuario'])) {
    $user_id = $_SESSION['id_usuario'];
    $query = "SELECT Productos.id, Productos.nombre, Productos.precio, CarritoCompra.cantidad 
              FROM CarritoCompra 
              JOIN Productos ON CarritoCompra.id_producto = Productos.id 
              WHERE CarritoCompra.id_cliente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
} else {
    $user_id = 1; // Cliente no registrado
    $query = "SELECT Productos.id, Productos.nombre, Productos.precio, CarritoCompra.cantidad 
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
    $total_amount += $row['precio'] * $row['cantidad'];
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
        <p>Total a pagar: $<?php echo number_format($total_amount, 2); ?></p>
        <div class="carrito">
            <?php if (empty($productos_carrito)): ?>
                <p>Tu carrito está vacío.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($productos_carrito as $producto): ?>
                        <li>
                            <?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?> x <?php echo $producto['cantidad']; ?>
                            <form action="../database/eliminar_producto.php" method="post" style="display:inline;">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a href="../forms/DatosBancarios-ClienteRegistrado.php" class="button">Proceder al Pago</a>
                <?php else: ?>
                    <a href="../forms/PagoClienteNoRegistrado.php" class="button">Proceder al Pago</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <a href="../index.php">Volver a la tienda</a>
    </main>
</body>
</html>
