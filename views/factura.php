<?php
session_start();
require_once '../database/connection.php';

$query = "SELECT Compras.id, Productos.nombre, Compras.cantidad, Compras.total, Compras.fecha_compra 
          FROM Compras 
          JOIN Productos ON Compras.id_producto = Productos.id 
          WHERE Compras.id_cliente_no_registrado = 1 
          ORDER BY Compras.fecha_compra DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $compra = $result->fetch_assoc();
} else {
    $compra = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/factura.css">
</head>
<body>
    <main>
        <h1>Factura</h1>
        <?php if ($compra): ?>
            <p>ID de la compra: <?php echo $compra['id']; ?></p>
            <p>Producto: <?php echo $compra['nombre']; ?></p>
            <p>Cantidad: <?php echo $compra['cantidad']; ?></p>
            <p>Total pagado: $<?php echo number_format($compra['total'], 2); ?></p>
            <p>Fecha de la compra: <?php echo $compra['fecha_compra']; ?></p>
        <?php else: ?>
            <p>No se encontró información de la compra.</p>
        <?php endif; ?>
        <a href="../index.php">Volver a la tienda</a>
    </main>
</body>
</html>
