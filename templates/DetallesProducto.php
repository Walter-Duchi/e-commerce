<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/navbar y footer.css">
    <style>
        .infoProducto {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .infoProducto img{
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

        .contenedor{
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
        
    </header>

    <main>
        <div class="infoProducto">
            <img src="assets/img/promocionMueble.png" alt="auriculares">
            <div class="detallesProducto">
                <h1>Logitech G Pro X - Auriculares de videojuegos, con tecnología de voz azul, color negro</h1>
                <ul>
                    <li>Micrófono desmontable de grado profesional con tecnología de voz azul en tiempo real, incluyendo reductor de ruido, compresor, limitador y más, para comunicaciones de voz de sonido más limpio y profesional. Requiere tarjeta de sonido externa USB incluida, PC de Windows y software Logitech G HUB.</li>
                    <li>Generación 7.1 y sonido envolvente basado en objetos para una mejor posición, distancia y conciencia de objetos del juego durante el juego. Requiere tarjeta de sonido externa USB incluida, PC de Windows y software Logitech G HUB.</li>
                    <li>Almohadillas de espuma viscoelástica suave para las orejas, con tu elección de cuero sintético de cancelación de ruido pasivo premium, o terciopelo suave y transpirable para una comodidad suprema.</li>
                    <li>Diseñados para durar, con una horquilla de aluminio duradera y diadema de acero. Impedancia: 35 ohmios.</li>
                </ul>
            </div>
            <div class="infoCompra">
                <p class="disponibilidad">Disponible</p>
                <p>US$99.99</p>
                <p>Cant: 1</p>
                <button onclick="redirigir('carrito.php')">Agregar al carrito</button>
             </div>
        </div>
        <div class="contenedor">
            <section class="resena">
                <h2>Foro del producto</h2>
                <div class="resena">
                    <p>Usuario: Juan Pérez</p>
                    <p>Momento del envío: 2024-07-01 10:15:00</p>
                    <p>Mensaje: "Compré estos auriculares la semana pasada y la calidad del sonido es increíble. La cancelación de ruido es excelente y el micrófono funciona a la perfección."</p>
                </div>
                <hr>
                <div class="resena">
                    <p>Usuario: Juan Pérez</p>
                    <p>Momento del envío: 2024-07-01 10:15:00</p>
                    <p>Mensaje: "Compré estos auriculares la semana pasada y la calidad del sonido es increíble. La cancelación de ruido es excelente y el micrófono funciona a la perfección."</p>
                    <div class="replica">
                        <p>Usuario: Juan Pérez</p>
                        <p>Momento del envío: 2024-07-01 10:15:00</p>
                        <p>Mensaje: "Compré estos auriculares la semana pasada y la calidad del sonido es increíble. La cancelación de ruido es excelente y el micrófono funciona a la perfección."</p>
                    </div>
                </div>
                <hr>
                <div class="resena">
                    <p>Usuario: Juan Pérez</p>
                    <p>Momento del envío: 2024-07-01 10:15:00</p>
                    <p>Mensaje: "Compré estos auriculares la semana pasada y la calidad del sonido es increíble. La cancelación de ruido es excelente y el micrófono funciona a la perfección."</p>
                </div>
            </section>
        </div> 
    </main>
    <script>
        function redirigir(url){
            window.location.href = url; 
        }
    </script>
</body>
</html>