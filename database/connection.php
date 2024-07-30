<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
