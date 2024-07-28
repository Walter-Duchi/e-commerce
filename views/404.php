<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            position: relative;
        }
        .container .icon {
            font-size: 100px;
            color: #ff6b6b;
            margin-bottom: 20px;
        }
        .container h1 {
            font-size: 72px;
            margin: 20px 0;
            color: #ff6b6b;
        }
        .container p {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            background-color: #3d5a80;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .container a:hover {
            background-color: #98c1d9;
        }
        .floating-astronaut {
            font-size: 100px;
            color: #3d5a80;
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            animation: float 4s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(-50%);
            }
            50% {
                transform: translateY(-20px) translateX(-50%);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="floating-astronaut">
            <i class="fas fa-rocket"></i>
        </div>
        <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1>Error 404</h1>
        <p>¡Oh no! La página que estás buscando no existe.</p>
        <a href="index.php">Volver al inicio</a>
    </div>
</body>
</html>
