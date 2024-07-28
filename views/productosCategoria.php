<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        
        <?php
$categoria = $_GET['categoria'];

require_once('database/connection.php'); // Asegúrate de que este archivo establece la conexión con la base de datos

$query = $conn->prepare(
    'SELECT p.* 
     FROM Productos p 
     INNER JOIN ProductoCategoria pc ON p.id = pc.id_producto 
     INNER JOIN Categorias c ON pc.id_categoria = c.id 
     WHERE c.nombre = ?'
);
$query->bind_param('s', $categoria);
$query->execute();
$result = $query->get_result();

echo '<div class="productos-contenedor">';
while ($row = $result->fetch_assoc()) {
    echo '<div class="producto">';
    echo '<img src="assets/uploads/' . $row['imagen_url'] . '" alt="' . $row['nombre'] . '">';
    echo '<h3>' . $row['nombre'] . '</h3>';
    echo '<p>Precio: $' . $row['precio'] . '</p>';
    echo '<button type="button" onclick="agregarAlCarrito(' . $row['id'] . ')">Agregar al Carrito</button>';
    echo '</div>';
}
echo '</div>';

$query->close();
$conn->close();
?>

        
    </main>
    
</body>
</html>


