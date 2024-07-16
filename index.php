<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/navbar-footer.css">
    </head>
    <body>
        <?php include 'templates/header.html'; ?>
        
        <?php 
            if (isset($_POST['cuenta'])) {
                include 'redirects/sign-in-up.html';
            } elseif (isset($_POST['carrito'])) {
                include 'views/carrito.php';
            } else {
                include 'dashboards/Cliente-Registrado-NoRegistrado.php';
            }
        ?>

        <?php require 'templates/footer.html'; ?>
    </body>
</html>
