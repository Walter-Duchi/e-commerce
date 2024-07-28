<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Redireccion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/redirect.css">
</head>
<body class="redireccion">
    <main>
        <div class="redirect-container">
            <div class="redirect-header">
                ¿Qué te gustaría hacer?
            </div>
            <div class="redirect-content">
                <button onclick="window.location.href='index.php?action=registro_cliente'">Registrarse como Cliente</button>
                <button onclick="window.location.href='index.php?action=registro_encargado'">Registrarse como Vendedor</button>
                <button onclick="window.location.href='index.php?action=iniciar_sesion'">Iniciar Sesión</button>
                <div class="back-to-home" onclick="window.location.href='index.php'">Regresar al Inicio</div>
            </div>
        </div>
    </main> 
</body>
</html>
