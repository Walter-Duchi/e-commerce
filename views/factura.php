<?php
session_start();
if (!isset($_SESSION['productos_factura']) || !isset($_SESSION['total_factura'])) {
    echo "No hay productos en la factura.";
    exit();
}

$productos_factura = $_SESSION['productos_factura'];
$total_factura = $_SESSION['total_factura'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Factura</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos_factura as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?></td>
                    <td><?php echo htmlspecialchars(number_format($producto['precio'] * $producto['cantidad'], 2)); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th><?php echo htmlspecialchars(number_format($total_factura, 2)); ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
