<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/navbar-footer.css">
        <link rel="stylesheet" href="../css/navbar-footer.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="css/styles.css">        
        <script src="assets/js/scripts.js"></script> <!-- Incluir tu archivo JS -->
        <style>
            button.cuenta{
                border-radius: 0;
            }
        </style>
    </head>
    <body>
        <!-- EL NAVBAR SIEMPRE ESTA PERO CAMBIA DEPENDE DEL USUARIO -->
        <!-- El navbar por defecto es de Cliente No Registrado -->
        <?php include 'navbars/ClienteNoRegistrado.php'; ?>
        <!-- php include 'navbars/ClienteRegistrado.php'; se debe -->
        <!-- php include 'navbars/EncargadoInventarios'; -->

        <!-- EL CONTENIDO DEBE CAMBIAR DE ACUERDO LO QUE SELECCIONE EL USUARIO -->
        <?php
        if (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            include('views/productosCategoria.php');
        }elseif (isset($_POST['cuenta'])) {
            include 'redirects/sign-in-up.php';
        } elseif (isset($_POST['carrito'])) {
            include 'views/carrito.php';
        } elseif (isset($_POST['verProducto'])) {
            include 'views/producto.php';  
        } else {
            include 'dashboards/Cliente-Registrado-NoRegistrado.php';
        }
        ?>

        <link rel="stylesheet" href="css/navbar-footer.css">
        <!-- EL FOOTER SIEMPRE DEBE ESTAR -->
        <?php require 'templates/footer.php'; ?>
        <!-- LA CONEXION SIEMPRE DEBE ESTAR -->
        <?php require 'database/connection.php'; ?>

    </body>
</html>
