<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/navbar y footer.css">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
            }
            #servicios, .productos{
                padding: 20px;
                text-align: center;
            }

            .listaProductos{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .itemProducto img{
                width: 100%;
                height: 100px;
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
        <header>

        </header>
        <main>
            <section class="productos">
                <h2>Resultado de la busqueda</h2>
                <div class="listaProductos">
                <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/shoes.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/shoes.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/shoes.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/shoes.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    <div class="itemProducto">
                        <div class="verProducto" onclick="redirigir('producto.php')">
                            <img src="assets/img/shoes.png" alt="Nuevo Producto">
                            <p>Nuevo Producto</p>
                            <p>$10</p>
                        </div>
                        <button>Añadir al carrito</button>
                    </div>
                    
                    
                </div>
            </section>
        </main>
        <script>
            function redirigir(url){
                window.location.href = url; 
            }
        </script>
    </body>
</html>

