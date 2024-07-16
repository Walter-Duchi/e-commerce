<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
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

            #servicios, .productos{
                padding: 20px;
                text-align: center;
            }

            .serviciosOfrecidos, .listaProductos,.banner, .bannerPublicitario{
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

            .bannerPublicitario img{
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

            .section h3{
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
            }

            .itemProducto img{
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
    </head>
    <body>

        <main>
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
                        <p>se aceptan todas las tarjetas</p>
                    </div>
                </div>
            </section>
            <section class="productos">
                <h2>Los más vendidos</h2>
                <div class="listaProductos">
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                </div>
            </section>
            <div class="bannerPublicitario">
                <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                <div>
                    <h2>Obten un descuento en tu primera orden de $20</h2>
                    <button onclick="redirigir('productosCategoria.php')">Comprar por categoría</button>
                </div>
            </div>
            <section class="productos">
                <h2>Los más populares</h2>
                <div class="listaProductos">
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                </div>
            </section>
            <section class="productos">
                <h2>Nuevos productos</h2>
                <div class="listaProductos">
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/promocionMueble.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                </div>
            </section>

            <script>
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
