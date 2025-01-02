<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbar-footer.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    require 'database/connection.php';

    if (isset($_POST['cuenta'])) {
        include 'redirects/sign-in-up.php';
    } elseif (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'registro_cliente') {
            include 'forms/Cliente.php';
        } elseif ($action == 'registro_encargado') {
            include 'forms/EncargadoInventario.php';
        } elseif ($action == 'iniciar_sesion') {
            include 'forms/login.php';
        }
    } else {
        if (isset($_SESSION['tipo_usuario'])) {
            if ($_SESSION['tipo_usuario'] == 'cliente') {
                include 'navbars/ClienteRegistrado.php';
                if (isset($_GET['categoria'])) {
                    $categoria = $_GET['categoria'];
                    include('views/productosCategoria.php');
                } elseif (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 'detalleProducto' && isset($_GET['product_id'])) {
                        include 'templates/DetalleProducto.php';
                    } else {
                        include 'views/404.php';
                    }
                } elseif (isset($_POST['carrito'])) {
                    include 'templates/carrito.php';
                } else {
                    include 'dashboards/Cliente-Registrado-NoRegistrado.php';
                }
            } elseif ($_SESSION['tipo_usuario'] == 'encargado') {
                include 'navbars/EncargadoInventarios.php';
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 'clientes_por_responder') {
                        include 'views/clientesPorResponder.php';
                    } elseif ($page == 'clientes_respondidos') {
                        include 'views/clientesRespondidos.php';
                    } else {
                        include 'dashboards/EncargadoInventarios.php';
                    }
                } else {
                    include 'dashboards/EncargadoInventarios.php';
                }
            }
            require 'templates/footer.php';
        } else {
            include 'navbars/ClienteNoRegistrado.php';
            if (isset($_GET['categoria'])) {
                $categoria = $_GET['categoria'];
                include('views/productosCategoria.php');
            } elseif (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page == 'detalleProducto' && isset($_GET['product_id'])) {
                    include 'templates/DetalleProducto.php';
                } else {
                    include 'views/404.php';
                }
            } elseif (isset($_POST['carrito'])) {
                include 'templates/carrito.php';
            } else {
                include 'dashboards/Cliente-Registrado-NoRegistrado.php';
            }
            require 'templates/footer.php';
        }
    }
    ?>
</body>
</html>
