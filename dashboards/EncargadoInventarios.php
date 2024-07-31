<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Encargado de Inventarios</title>
    <link rel="stylesheet" href="../css/navbar-footer.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .contenedor {
            padding: 20px;
            text-align: left;
        }
        .listaProductos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .itemProducto {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 5px;
            width: 150px;
            text-align: center;
            border-radius: 10px;
        }
        .itemProducto img {
            width: 150px;
            height: auto;
        }
        button {
            background-color: #3d5a80;
            color: #ffffff;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50px;
        }
        button:hover {
            background-color: #98c1d9;
        }
    </style>
</head>
<body>
    <main style="margin-top: 110px;">
        <div class="contenedor">
            <h1>Bienvenido Encargado de Inventarios</h1>
            <p>Aquí puedes gestionar el inventario.</p>
            <section class="productos">
                <h2>Todos los productos</h2>
                <div class="listaProductos">
                    <?php
                    require 'database/connection.php';
                    $query = "SELECT * FROM Productos ORDER BY nombre ASC";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="itemProducto">';
                        echo '<div class="verProducto" onclick="redirigir(\'../views/producto.php?id=' . $row['id'] . '\')">';
                        echo '<img src="assets/uploads/' . $row['imagen_url'] . '" alt="' . $row['nombre'] . '">';
                        echo '<p>' . $row['nombre'] . '</p>';
                        echo '<p>$' . $row['precio'] . '</p>';
                        echo '</div>';
                        echo '<button onclick="redirigir(\'forms/Producto.php?id=' . $row['id'] . '\')">Editar</button>';
                        echo '<button onclick="eliminarProducto(' . $row['id'] . ')">Eliminar</button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>
    <script>
        function redirigir(url) {
            window.location.href = url;
        }

        function eliminarProducto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                window.location.href = 'database/eliminar_producto.php?id=' + id;
            }
        }
    </script>
</body>
</html>
