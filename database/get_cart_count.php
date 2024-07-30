<?php
session_start();
require_once 'database/connection.php';

$total_products = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT SUM(cantidad) as total_products FROM CarritoCompra WHERE id_cliente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
} else {
    $query = "SELECT SUM(cantidad) as total_products FROM CarritoCompra WHERE id_cliente_no_registrado = 1";
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_products = $row['total_products'] ?? 0;
$stmt->close();

echo $total_products;
?>
