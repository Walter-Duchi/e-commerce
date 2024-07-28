<?php
// templates/DetalleProducto.php

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "
        SELECT 
            p.nombre, 
            p.descripcion, 
            p.precio, 
            p.stock, 
            p.imagen_url,
            c.nombre AS categoria 
        FROM 
            Productos p
        LEFT JOIN 
            ProductoCategoria pc ON p.id = pc.id_producto
        LEFT JOIN 
            Categorias c ON pc.id_categoria = c.id
        WHERE 
            p.id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalles del Producto</title>
            <link rel="stylesheet" href="css/navbar-footer.css">
            <style>
                .infoProducto {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    align-items: center;
                    margin: 20px 0;
                }

                .infoProducto img {
                    width: 300px;
                    height: auto;
                    margin: 10px;
                }

                .detallesProducto {
                    max-width: 600px;
                    margin: 10px;
                    text-align: justify;
                }

                .infoCompra {
                    background-color: #f8f8f8;
                    padding: 10px;
                    border: 1px solid #ddd;
                    text-align: center;
                    margin: 30px;
                    flex-direction: column;
                    border-radius: 10px;
                }

                .infoCompra p {
                    margin: 5px 0;
                }

                .infoCompra .disponibilidad {
                    color: #3d5a80;
                    font-weight: bold;
                }

                .resena, .replica {
                    margin: 20px;
                    padding: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f8f8f8;
                }

                .resena p, .replica p {
                    margin: 5px 0;
                }

                .resena h2 {
                    text-align: center;
                }

                .replica {
                    border-color: #ccc;
                }

                hr {
                    border: 0;
                    height: 1px;
                    background: #ddd;
                }

                .contenedor {
                    padding: 20px;
                    text-align: left;  
                }

                button {
                    background-color: #3d5a80;
                    color: #ffffff;
                    font-family: 'Lato', sans-serif;
                    font-size: 14px;
                    border: none;
                    padding: 10px;
                    cursor: pointer;
                    border-radius: 20px;
                }

                button:hover {
                    background-color: #98c1d9;
                }
            </style>
        </head>
        <body>
            <header></header>
            <main>
                <div class="infoProducto">
                    <img src="assets/uploads/<?php echo $product['imagen_url']; ?>" alt="<?php echo $product['nombre']; ?>">
                    <div class="detallesProducto">
                        <h1><?php echo $product['nombre']; ?></h1>
                        <p><?php echo $product['descripcion']; ?></p>
                        <p>Precio: $<?php echo $product['precio']; ?></p>
                        <p>Categoría: <?php echo $product['categoria']; ?></p>
                    </div>
                    <div class="infoCompra">
                        <p class="disponibilidad"><?php echo $product['stock'] > 0 ? 'Disponible' : 'Agotado'; ?></p>
                        <p>$<?php echo $product['precio']; ?></p>
                        <button onclick="redirigir('carrito.php')">Agregar al carrito</button>
                    </div>
                </div>
                <div class="contenedor">
                    <section class="resena">
                        <h2>Foro del producto</h2>
                        <!-- Aquí puedes agregar código PHP para mostrar las reseñas del producto -->
                    </section>
                </div>
            </main>
            <script>
                function redirigir(url) {
                    window.location.href = url;
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Producto no encontrado.</p>";
    }
} else {
    echo "<p>ID del producto no especificado.</p>";
}
?>
