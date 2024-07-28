<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/formularios.css">
</head>
<body>
    <main>
        <section id="login" class="form-section">
            <a href="index.php" class="btn-back">Regresar al Inicio</a>
            <br>
            <h2>Iniciar Sesión</h2>
            <form action="../database/procesar_login.php" method="POST">
                <label for="correo_electronico">Correo Electrónico:</label>
                <input type="email" id="correo_electronico" name="correo_electronico" required>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>
</body>
</html>
