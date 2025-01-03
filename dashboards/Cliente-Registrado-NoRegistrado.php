<?php
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
?>

<!DOCTYPE html>
<html>
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
            form.submit();
        }
    </script>
</head>
<body>
    <main>
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

        <script>
            function redirigirProducto(productId) {
                window.location.href = `index.php?page=detalleProducto&product_id=${productId}`;
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
    </main>
</body>
</html>
