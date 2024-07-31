<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/formularios.css">
</head>
<body>
    <main>
        <section id="login" class="form-section">
            <a href="index.php" class="btn-back">Regresar al Inicio</a>
            <br>
            <h1>Inicio de Sesión</h1>
            <form action="database/login.php" method="post">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" maxlength="100" required>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" maxlength="255" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>
</body>
</html>

