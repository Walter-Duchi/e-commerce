<?php
$conn = include('../database/connection.php'); // Asegúrate de que esta ruta sea correcta

// Capturar la categoría seleccionada
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consultar la base de datos para obtener los productos de la categoría
$stmt = $conn->prepare("
    SELECT p.*
    FROM Productos p
    JOIN ProductoCategoria pc ON p.id = pc.id_producto
    JOIN Categorias c ON pc.id_categoria = c.id
    WHERE c.nombre = ?
");
$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de la categoría <?php echo htmlspecialchars($categoria); ?></title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        #servicios, .productos {
            padding: 20px;
            text-align: center;
        }
        .listaProductos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .itemProducto img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 5px;
        }
        .itemProducto {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 5px;
            width: 150px;
            text-align: center;
            border-radius: 10px;
        }
        .verProducto {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Categoría: <?php echo htmlspecialchars($categoria); ?></h1>
    <div class="productos listaProductos">
        <?php foreach ($productos as $producto): ?>
            <div class="itemProducto">
                <img src="../assets/uploads/<?php echo htmlspecialchars($producto['imagen_url']); ?>" alt="Imagen del producto">
                <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <p>$<?php echo htmlspecialchars($producto['precio']); ?></p>
                <button>Añadir al carrito</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
