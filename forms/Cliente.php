<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro Cliente</title>
    <link rel="stylesheet" href="css/formularios.css">
</head>
<body>
    <main>
        <section id="registro-cliente" class="form-section">
            <a href="index.php" class="btn-back">Regresar al Inicio</a>
            <br>
            <h1>Registro de datos Cliente</h1>
            <form action="database/registrer_cliente.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" maxlength="100" required>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" maxlength="100" required>
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required>
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                <label for="documento_identidad">Documento de Identidad:</label>
                <input type="text" id="documento_identidad" name="documento_identidad" maxlength="20" required>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" maxlength="255" required>
                <label for="correo_electronico">Correo Electrónico:</label>
                <input type="email" id="correo_electronico" name="correo_electronico" maxlength="100" required>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" maxlength="255" required>
                <button type="submit">Crear Cuenta</button>
            </form>
        </section>
    </main>
</body>
</html>
