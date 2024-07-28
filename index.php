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
    <?php
    if (isset($_POST['cuenta'])) {
        include 'redirects/sign-in-up.php';
        
    }elseif(isset($_GET['action'])) {
        
            $action = $_GET['action'];
            if ($action == 'registro_cliente') {
                include 'forms/Cliente.php';
            } elseif ($action == 'registro_encargado') {
                include 'forms/EncargadoInventario.php';
            } elseif ($action == 'iniciar_sesion') {
                include 'forms/login.php';
            }
    }else {
        include 'navbars/ClienteNoRegistrado.php';

        if (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            include('views/productosCategoria.php');
        }  elseif (isset($_POST['carrito'])) {
            include 'views/carrito.php';
        } elseif (isset($_POST['verProducto'])) {
            include 'views/producto.php';
        } else {
            include 'dashboards/Cliente-Registrado-NoRegistrado.php';
        }
        require 'templates/footer.php';
    }
    ?>
    <?php require 'database/connection.php'; ?>
</body>
</html>
