<?php
session_start();
require_once '../database/connection.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Cliente No Registrado</title>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <main>
        <h1>Información de Pago</h1>
        <form action="../database/pago_cliente_noregistrado.php" method="POST">
            <div>
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>
            </div>
            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required>
            </div>
            <div>
                <label for="numero_tarjeta">Número de Tarjeta:</label>
                <input type="text" id="numero_tarjeta" name="numero_tarjeta" required>
            </div>
            <div>
                <label for="fecha_expiracion">Fecha de Expiración (YYYY-MM-DD):</label>
                <input type="text" id="fecha_expiracion" name="fecha_expiracion" required>
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <button type="submit">Pagar</button>
        </form>
    </main>
</body>
</html>
