<?php
session_start();
require_once '../database/connection.php'; // Asegúrate de incluir la conexión a la base de datos

if (!isset($_SESSION['productos_factura']) || !isset($_SESSION['total_factura']) || !isset($_SESSION['cliente_nombre']) || !isset($_SESSION['cliente_cedula']) || !isset($_SESSION['cliente_ubicacion'])) {
    echo "No hay productos en la factura.";
    exit();
}

$productos_factura = $_SESSION['productos_factura'];
$total_factura = $_SESSION['total_factura'];
$cliente_nombre = $_SESSION['cliente_nombre'];
$cliente_cedula = $_SESSION['cliente_cedula'];
$cliente_ubicacion = $_SESSION['cliente_ubicacion'];

// Obtener la fecha de compra actual
$fecha_compra = date("Y-m-d H:i");

// Calcular la fecha de entrega (un día después de la fecha de compra)
$fecha_entrega = date("Y-m-d H:30", strtotime($fecha_compra . ' +1 day'));
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
    <p><strong>Nombre del Cliente:</strong> <?php echo htmlspecialchars($cliente_nombre); ?></p>
    <p><strong>Cédula:</strong> <?php echo htmlspecialchars($cliente_cedula); ?></p>
    <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($cliente_ubicacion); ?></p>
    <p><strong>Fecha de Compra:</strong> <?php echo htmlspecialchars($fecha_compra); ?></p>
    <p><strong>Fecha de Entrega:</strong> <?php echo htmlspecialchars($fecha_entrega); ?></p>
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
    <div class="button-container">
        <form method="get" action="../index.php" style="display:inline;">
            <button type="submit">Regresar al Inicio</button>
        </form>
    </div>
</body>
</html>
