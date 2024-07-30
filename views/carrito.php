<?php
session_start();
require_once __DIR__ . 'database/connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$query = $conn->prepare('
    SELECT p.nombre, p.descripcion, p.precio, cc.cantidad, p.imagen_url 
    FROM CarritoCompra cc
    JOIN Productos p ON cc.id_producto = p.id
    WHERE cc.id_cliente = ?
');
$query->bind_param('i', $user_id);
$query->execute();
$result = $query->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <main>
        <h1>Carrito de Compras</h1>
        <div class="carrito-contenedor">
            <?php
            while ($row = $result->fetch_assoc()) {
                $total += $row['precio'] * $row['cantidad'];
                ?>
                <div class="producto-carrito">
                    <img src="../assets/uploads/<?php echo $row['imagen_url']; ?>" alt="<?php echo $row['nombre']; ?>">
                    <div class="detalles-carrito">
                        <h3><?php echo $row['nombre']; ?></h3>
                        <p><?php echo $row['descripcion']; ?></p>
                        <p>Precio: $<?php echo $row['precio']; ?> x <?php echo $row['cantidad']; ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="total-carrito">
            <h2>Total: $<?php echo number_format($total, 2); ?></h2>
            <button onclick="checkout()">Proceder al Pago</button>
        </div>
    </main>
    <script src="assets/js/carrito.js"></script>
</body>
</html>

<?php
$query->close();
$conn->close();
?>
