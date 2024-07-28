<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navbar-footer.css">

    </head>
    <body style="margin-top: 80px">
        <main style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #333;">Iniciar Sesión</h2>
        <form action="../database/procesar_login.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <label for="correo_electronico" style="font-weight: bold; color: #555;">Correo Electrónico:</label>
            <input type="email" id="correo_electronico" name="correo_electronico" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="contrasena" style="font-weight: bold; color: #555;">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Iniciar Sesión</button>
        </form>
    </main>
        <br>
        <br>
        <br>
    </body>  
</html>
