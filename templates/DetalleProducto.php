<?php
session_start();
include 'database/connection.php';

function obtenerProductosPorCategoria($categoria_id, $conn) {
    $sql = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.imagen_url 
            FROM Productos 
            JOIN ProductoCategoria ON Productos.id = ProductoCategoria.id_producto 
            WHERE ProductoCategoria.id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $productos = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $productos;
}

$productos_populares = obtenerProductosPorCategoria(15, $conn);
$nuevos_productos = obtenerProductosPorCategoria(16, $conn);
$productos_vendidos = obtenerProductosPorCategoria(17, $conn);

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

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
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbar-footer.css">
    <style>
        .slider {
            position: relative;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ddd;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        .prev, .sgn {
            position: absolute;
            top: 50%;
            background-color: #3d5a80;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .prev {
            left: 10px;
        }

        .sgn {
            right: 10px;
        }

        #servicios, .productos {
            padding: 20px;
            text-align: center;
        }

        .serviciosOfrecidos, .listaProductos, .banner, .bannerPublicitario {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .banner {
            justify-content: space-between;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            width: 80%;
            margin: auto;
        }

        .bannerPublicitario {
            align-items: center;
            background-color: #ccc;
            position: relative;
            max-width: 100%;
            margin: auto;
            text-align: center;
            padding: 30px;
        }

        .bannerPublicitario img {
            width: 500px;
            height: auto;
            margin-bottom: 10px;
            position: relative;
        }

        .section {
            flex: auto;
            text-align: center;
        }

        .section img {
            width: 75px;
            height: 75px;
            margin-bottom: 10px;
        }

        .section h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-family: 'Open Sans', sans-serif;
        }

        .section p {
            font-size: 16px;
        }

        .itemProducto {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 5px;
            width: 150px;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .itemProducto img {
            width: 150px;
            height: auto;
        }

        .verProducto {
            cursor: pointer;
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
    </style> 
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

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'database/add_to_cart.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    window.location.href = `http://localhost/e-commerce/index.php?page=detalleProducto&product_id=${productId}`;
                }
            };
            const formData = new FormData(form);
            xhr.send(formData);
        }

        let diapoActual = 0;

        function mostrarSlide(index) {
            const slides = document.querySelector('.slides');
            const totalSlides = slides.children.length;
            if (index >= totalSlides) {
                diapoActual = 0;
            } else if (index < 0) {
                diapoActual = totalSlides - 1;
            } else {
                diapoActual = index;
            }
            const desactivar = -diapoActual * 100;
            slides.style.transform = `translateX(${desactivar}%)`;
        }

        function moverSlide(step) {
            mostrarSlide(diapoActual + step);
        }

        document.addEventListener('DOMContentLoaded', () => {
            mostrarSlide(diapoActual);
        });

        function redirigir(url) {
            window.location.href = url;
        }
    </script>
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
        <?php if (isset($product)): ?>
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
        <?php else: ?>
            <div>
                <h1>Dashboard</h1>
                <?php
                    if (isset($_SESSION['id_usuario'])) {
                        $user_id = $_SESSION['id_usuario'];
                        echo "Usuario logeado tiene el ID: " . htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8');
                    } else {
                        echo "Usuario no logeado.";
                    }
                ?>
                <!-- Slider -->
                <div class="slider">
                    <div class="slides">
                        <div class="slide"><img src="assets/img/camera.png" alt="itemSlide"></div>
                        <div class="slide"><img src="assets/img/headphone.png" alt="itemSSlide"></div>
                        <div class="slide"><img src="assets/img/electronic.png" alt="itemSlide"></div>
                        <div class="slide"><img src="assets/img/phone.png" alt="itemSlide"></div>
                    </div>
                    <!-- Botones para mover de promociones -->
                    <button class="prev" onclick="moverSlide(-1)">&#10094;</button>
                    <button class="sgn" onclick="moverSlide(1)">&#10095;</button>
                </div>

                <section id="servicios">
                    <h2>Ofrecemos</h2>
                    <div class="banner">
                        <div class="section">
                            <img src="assets/img/transporte.png" alt="Envío gratuito">
                            <h3>Envío gratuito</h3>
                            <p>En compras superiores a $50</p>
                        </div>
                        <div class="section">
                            <img src="assets/img/dolar.png" alt="Garantía de devolución de dinero">
                            <h3>Garantía de devolución de dinero</h3>
                            <p>30 días de garantía</p>
                        </div>
                        <div class="section">
                            <img src="assets/img/auriculares.png" alt="Soporte técnico">
                            <h3>Soporte técnico</h3>
                            <p>24 horas de soporte</p>
                        </div>
                        <div class="section">
                            <img src="assets/img/tarjeta.png" alt="Pago Seguro">
                            <h3>Pagos seguros</h3>
                            <p>Se aceptan todas las tarjetas</p>
                        </div>
                    </div>
                </section>

                <section class="productos">
                    <h2>Los más populares</h2>
                    <div class="listaProductos">
                        <?php foreach ($productos_populares as $producto): ?>
                            <div class="itemProducto" onclick="redirigirProducto(<?php echo $producto['id']; ?>)">
                                <div class="verProducto">
                                    <img src="assets/uploads/<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                    <p><?php echo $producto['nombre']; ?></p>
                                    <p>$<?php echo $producto['precio']; ?></p>
                                </div>
                                <button type="button" onclick="event.stopPropagation(); agregarAlCarrito(<?php echo $producto['id']; ?>)">Agregar al carrito</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="productos">
                    <h2>Nuevos productos</h2>
                    <div class="listaProductos">
                        <?php foreach ($nuevos_productos as $producto): ?>
                            <div class="itemProducto" onclick="redirigirProducto(<?php echo $producto['id']; ?>)">
                                <div class="verProducto">
                                    <img src="assets/uploads/<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                    <p><?php echo $producto['nombre']; ?></p>
                                    <p>$<?php echo $producto['precio']; ?></p>
                                </div>
                                <button type="button" onclick="event.stopPropagation(); agregarAlCarrito(<?php echo $producto['id']; ?>)">Agregar al carrito</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="productos">
                    <h2>Lo más vendido</h2>
                    <div class="listaProductos">
                        <?php foreach ($productos_vendidos as $producto): ?>
                            <div class="itemProducto" onclick="redirigirProducto(<?php echo $producto['id']; ?>)">
                                <div class="verProducto">
                                    <img src="assets/uploads/<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                    <p><?php echo $producto['nombre']; ?></p>
                                    <p>$<?php echo $producto['precio']; ?></p>
                                </div>
                                <button type="button" onclick="event.stopPropagation(); agregarAlCarrito(<?php echo $producto['id']; ?>)">Agregar al carrito</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                
                <div class="bannerPublicitario">
                    <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                    <div>
                        <h2>Obten un descuento en tu primera orden de $20</h2>
                        <button onclick="redirigir('views/productosCategoria.php')">Comprar por categoría</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
    </script>
</body>
</html>
