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
        .itemProducto {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 180px;
            text-align: center;
            border-radius: 10px;
            background-color: #1a1a1a;
            color: #fff;
        }
        .itemProducto img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 0 auto 10px auto;
        }
        .itemProducto h2 {
            font-size: 1em;
            margin: 10px 0;
            flex-grow: 1;
        }
        .itemProducto p {
            margin: 5px 0;
        }
        .botonAgregar {
            padding: 5px 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
        }
        .botonAgregar:hover {
            background-color: #0056b3;
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
                <p>$<?php echo htmlspecialchars($producto['precio']); ?></p>
                <button class="botonAgregar">Añadir al carrito</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
