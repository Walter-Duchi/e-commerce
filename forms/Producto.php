<?php
require '../database/connection.php';
$id = $_GET['id'];
$query = "SELECT * FROM Productos WHERE id=$id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/navbar-footer.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="../database/editar_producto.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $row['precio']; ?>" required>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $row['descripcion']; ?></textarea>
            <button type="submit">Actualizar Producto</button>
        </form>
    </div>
</body>
</html>
