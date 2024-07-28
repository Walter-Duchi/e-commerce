<?php
$categoria = $_GET['categoria'];

require ('database/connection.php'); // Asegúrate de que este archivo establece la conexión con la base de datos

$query = $conn->prepare('SELECT * FROM productos WHERE categoria = ?');
$query->bind_param('s', $categoria);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<div class="producto" style="border: 1px solid #ccc; padding: 10px; margin: 10px;">';
    echo '<img src="assets/img/' . $row['imagen'] . '" alt="' . $row['nombre'] . '" style="width:100%;">';
    echo '<h3>' . $row['nombre'] . '</h3>';
    echo '<p>Precio: $' . $row['precio'] . '</p>';
    echo '<button type="button" onclick="agregarAlCarrito(' . $row['id'] . ')">Agregar al Carrito</button>';
    echo '</div>';
}

$query->close();
$conn->close();
?>
