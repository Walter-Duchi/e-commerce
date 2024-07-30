<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos por Categoría</title>
    <style>
        .productos-contenedor {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }
        .producto {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .producto img {
            width: 150px;
            height: auto;
        }
        .producto:hover {
            transform: scale(1.05);
        }
        .producto button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #3d5a80;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .producto button:hover {
            background-color: #98c1d9;
        }
    </style>
</head>
<body>
    <main>
        <?php
        $categoria = $_GET['categoria'];
        require_once('database/connection.php');

        $query = $conn->prepare('
            SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen_url 
            FROM Productos p 
            INNER JOIN ProductoCategoria pc ON p.id = pc.id_producto 
            INNER JOIN Categorias c ON pc.id_categoria = c.id 
            WHERE c.nombre = ?
        ');
        $query->bind_param('s', $categoria);
        $query->execute();
        $result = $query->get_result();

        echo '<div class="productos-contenedor">';
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="producto" onclick="redirigirProducto(<?php echo $row['id']; ?>)">
                <img src="assets/uploads/<?php echo $row['imagen_url']; ?>" alt="<?php echo $row['nombre']; ?>">
                <h3><?php echo $row['nombre']; ?></h3>
                <p>Precio: $<?php echo $row['precio']; ?></p>
                <button type="button" onclick="event.stopPropagation(); agregarAlCarrito(<?php echo $row['id']; ?>)">Agregar al Carrito</button>
            </div>
            <?php
        }
        echo '</div>';

        $query->close();
        $conn->close();
        ?>
    </main>
    <script src="../assets/js/carrito.js"></script>
    <script>
        function redirigirProducto(productId) {
            window.location.href = `index.php?page=detalleProducto&product_id=${productId}`;
        }
        
        function agregarAlCarrito(productId) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'database/add_to_cart.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'product_id';
                input.value = productId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
    </script>
</body>
</html>
