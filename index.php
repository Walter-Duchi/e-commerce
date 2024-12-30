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
    require_once 'vendor/autoload.php';

    \Sentry\init([
        'dsn' => 'https://f5814d466582d1890db17bc96789b239@o4508542759993344.ingest.us.sentry.io/4508546948857856',
        'traces_sample_rate' => 1.0,
        'profiles_sample_rate' => 1.0,
    ]);

    // Configurar el nivel de reporte de errores
    error_reporting(E_ALL);
    ini_set('display_errors', '0'); // No mostrar errores en pantalla
    ini_set('log_errors', '1');    // Registrar errores en logs

    // Capturar errores no manejados
    set_error_handler(function ($severity, $message, $file, $line) {
        if (!(error_reporting() & $severity)) {
            return false; // Ignorar errores no configurados en error_reporting
        }
        \Sentry\captureMessage("Error: $message en $file:$line", \Sentry\Severity::error());
        throw new ErrorException($message, 0, $severity, $file, $line);
    });

    // Capturar excepciones no manejadas
    set_exception_handler(function ($exception) {
        \Sentry\captureException($exception);
    });

    // Capturar errores fatales
    register_shutdown_function(function () {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
            \Sentry\captureMessage(
                "Error fatal: {$error['message']} en {$error['file']}:{$error['line']}",
                \Sentry\Severity::fatal()
            );
        }
    });

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
