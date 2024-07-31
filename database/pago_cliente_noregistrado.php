<?php
session_start();
require_once '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $ubicacion = $_POST['ubicacion'];
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $fecha_expiracion = $_POST['fecha_expiracion'];
    $cvv = $_POST['cvv'];

    // Verificar si el cliente no registrado ya existe
    $query = "SELECT * FROM ClienteNoRegistrado WHERE id = 1";
    $result = $conn->query($query);

    if ($result->num_rows === 0) {
        // Insertar cliente no registrado
        $query = "INSERT INTO ClienteNoRegistrado (id, nombre, cedula, ubicacion) VALUES (1, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $nombre, $cedula, $ubicacion);
        $stmt->execute();
        $stmt->close();
    }

    // Insertar datos bancarios del cliente no registrado
    $query = "INSERT INTO DatosBancarios (id_cliente_no_registrado, numero_tarjeta, fecha_expiracion, cvv, saldo) 
              VALUES (1, ?, ?, ?, 100000.00)
              ON DUPLICATE KEY UPDATE numero_tarjeta = VALUES(numero_tarjeta), fecha_expiracion = VALUES(fecha_expiracion), cvv = VALUES(cvv)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $numero_tarjeta, $fecha_expiracion, $cvv);
    $stmt->execute();
    $stmt->close();

    // Procesar el pago
    $total_amount = 0;
    $productos_carrito = [];
    $query = "SELECT Productos.id, Productos.precio, CarritoCompra.cantidad 
              FROM CarritoCompra 
              JOIN Productos ON CarritoCompra.id_producto = Productos.id 
              WHERE CarritoCompra.id_cliente_no_registrado = 1";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $total_amount += $row['precio'] * $row['cantidad'];
        $productos_carrito[] = $row;
    }

    // Verificar el saldo del cliente no registrado
    $query = "SELECT saldo FROM DatosBancarios WHERE id_cliente_no_registrado = 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $saldo_actual = $row['saldo'];

    if ($saldo_actual >= $total_amount) {
        // Realizar el pago y deducir saldo
        foreach ($productos_carrito as $producto) {
            $query = "CALL realizarCompra(NULL, 1, ?, ?, @saldo_suficiente)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $producto['id'], $producto['cantidad']);
            $stmt->execute();
            $stmt->close();
        }

        // Actualizar el saldo
        $query = "UPDATE DatosBancarios SET saldo = saldo - ? WHERE id_cliente_no_registrado = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("d", $total_amount);
        $stmt->execute();
        $stmt->close();

        // Vaciar el carrito
        $query = "DELETE FROM CarritoCompra WHERE id_cliente_no_registrado = 1";
        $conn->query($query);

        header("Location: ../views/factura.php");
    } else {
        echo "Saldo insuficiente.";
    }
}
?>
