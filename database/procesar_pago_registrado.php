<?php
session_start();
require_once '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $fecha_expiracion = $_POST['fecha_expiracion'];
    $cvv = $_POST['cvv'];

    // Validar y procesar el pago aquí...

    // Redirigir a la factura
    header('Location: ../views/factura.php');
    exit();
} else {
    // Redirigir al formulario si no se accede por POST
    header('Location: ../forms/DatosBancarios-ClienteRegistrado.php');
    exit();
}
?>
