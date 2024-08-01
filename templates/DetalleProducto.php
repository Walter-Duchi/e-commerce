<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    require_once('database/connection.php');

    $query = $conn->prepare('
        SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen_url, c.nombre AS categoria 
        FROM Productos p 
        LEFT JOIN ProductoCategoria pc ON p.id = pc.id_producto 
        LEFT JOIN Categorias c ON pc.id_categoria = c.id 
        WHERE p.id = ?
    ');
    $query->bind_param('i', $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($product['nombre']); ?></title>
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
                    margin-left: 20px;
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
            <header>
                <nav>
                    <!-- Aquí se coloca el menú de navegación -->
                    <!-- Ejemplo de usuario autenticado -->
                    <span class="nombre"><?php echo isset($_SESSION['nombre_usuario']) ? htmlspecialchars($_SESSION['nombre_usuario']) : ''; ?></span>
                </nav>
            </header>
            <main>
                <div class="infoProducto">
                    <img src="assets/uploads/<?php echo htmlspecialchars($product['imagen_url']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>">
                    <div class="detallesProducto">
                        <h1><?php echo htmlspecialchars($product['nombre']); ?></h1>
                        <p><?php echo htmlspecialchars($product['descripcion']); ?></p>
                        <p>Precio: $<?php echo htmlspecialchars($product['precio']); ?></p>
                        <p>Categoría: <?php echo htmlspecialchars($product['categoria']); ?></p>
                    </div>
                    <div class="infoCompra">
                        <p class="disponibilidad"><?php echo $product['stock'] > 0 ? 'Disponible' : 'Agotado'; ?></p>
                        <p>$<?php echo htmlspecialchars($product['precio']); ?></p>
                        <button onclick="agregarAlCarrito(<?php echo htmlspecialchars($product['id']); ?>)">Agregar al carrito</button>
                    </div>
                </div>
                <div class="contenedor">
                    <section class="resena">
                        <h2>Chat relacionado con este producto</h2>
                        <?php if (isset($_SESSION['tipo_usuario']) && ($_SESSION['tipo_usuario'] == 'cliente' || $_SESSION['tipo_usuario'] == 'encargado')): ?>
                           <form id="mensajeForm" method="post">
                                <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($_SESSION['id_usuario']); ?>">
                                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <textarea name="mensaje" required></textarea>
                                <button type="submit">Enviar</button>
                            </form>
                        <!-- Aquí se pueden agregar comentarios y reseñas del producto -->
                            <div id="chat">
                                <?php
                                $query = $conn->prepare('
                                    SELECT mf.id, cr.nombre AS nombre_usuario, mf.mensaje, mf.fecha_mensaje AS fecha, 
                                           ei.nombre AS nombre_encargado, mf.respuesta, mf.fecha_respuesta 
                                    FROM mensajes_por_producto mf 
                                    JOIN ClienteRegistrado cr ON mf.id_cliente = cr.id 
                                    LEFT JOIN EncargadoInventarios ei ON mf.id_encargado = ei.id 
                                    WHERE mf.id_producto = ? 
                                    ORDER BY mf.fecha_mensaje DESC
                                ');
                                $query->bind_param('i', $product_id);
                                $query->execute();
                                $result = $query->get_result();

                                while ($message = $result->fetch_assoc()) {
                                    echo "<div class='replica'>";
                                    echo "<div class='mensaje'>";
                                    echo "<p><strong>" . htmlspecialchars($message['nombre_usuario']) . ":</strong> " . htmlspecialchars($message['mensaje']) . "</p>";
                                    echo "<p><small>" . htmlspecialchars($message['fecha']) . "</small></p>";
                                    if ($message['respuesta']) {
                                        echo "<div class='replica'>";
                                        echo "<p><strong>Encargado de Inventarios:</strong> " . htmlspecialchars($message['respuesta']) . "</p>";
                                        echo "<p><small>" . htmlspecialchars($message['fecha_respuesta']) . "</small></p>";
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            
                        <?php else: ?>
                            <p>Solo los usuarios registrados y los encargados de inventarios pueden participar en el chat.</p>
                        <?php endif; ?>
                    </section>
                </div> 
            </main>
            <script src="../assets/js/carrito.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#mensajeForm').submit(function(event) {
                        event.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'database/EnviarMensajeClienteRegistrado.php',
                            data: $(this).serialize(),
                            success: function(response) {
                                location.reload(); // Recargar la página para actualizar el chat
                            }
                        });
                    });
                });

                function agregarAlCarrito(productId) {
                    // Implementar la lógica para agregar al carrito
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