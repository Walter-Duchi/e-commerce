<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tienes un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña diferente
$dbname = "ecommerce";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

// Consulta de prueba
$sql = "SELECT DATABASE()";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_row();
    echo "Connected to database: " . $row[0];
} else {
    echo "Error executing query: " . $conn->error;
}

$conn->close();
?>
