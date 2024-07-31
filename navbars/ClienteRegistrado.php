<?php
session_start();
require_once 'database/connection.php';

$total_products = 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT SUM(cantidad) as total_products FROM CarritoCompra WHERE id_cliente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_products = $row['total_products'] ?? 0;
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar y Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:700&display=swap">
    <link rel="stylesheet" href="../css/navbar-footer.css">
</head>
<body>
    <nav class="navbar">
        <i class="fa-solid fa-bars" id="menu-toggle"></i> <!--Ocultar es cuando el ancho de la pantalla sea de 710px o menor-->
        <div class="logo">
            <img src="../assets/img/logo.png" alt="Logo">
            <a href="#" class="ocultar">Envios Express</a><!--Ocultar es cuando el ancho de la pantalla sea de 710px o menor-->
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Busca más de 10000 productos">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-links">
            <div class="categories">
                <span class="espacio-derecha">Categorías</span>
                <div class="dropdown">
                    <div class="dropdown-column">
                        <a href="#"><i class="fas fa-tags"></i> Ofertas</a>
                        <a href="#"><i class="fas fa-headphones"></i> Audio y Video</a>
                        <a href="#"><i class="fas fa-tv"></i> Televisores</a>
                        <a href="#"><i class="fas fa-chart-line"></i> Tendencia</a>
                        <a href="#"><i class="fas fa-home"></i> Hogar</a>
                        <a href="#"><i class="fas fa-laptop"></i> Computadoras</a>
                        <a href="#"><i class="fas fa-heartbeat"></i> Salud</a>
                    </div>
                    <div class="dropdown-column">
                        <a href="#"><i class="fas fa-briefcase"></i> Oficina</a>
                        <a href="#"><i class="fas fa-gamepad"></i> Ocio</a>
                        <a href="#"><i class="fas fa-mobile-alt"></i> Celulares</a>
                        <a href="#"><i class="fas fa-gamepad"></i> Consolas</a>
                        <a href="#"><i class="fas fa-percent"></i> Liquidación</a>
                        <a href="#"><i class="fas fa-tablet-alt"></i> Tablets</a>
                        <a href="#"><i class="fas fa-clock"></i> Smartwatchs y Smartbands</a>
                    </div>
                </div>
            </div>
            <a href="#" class="profile">
                <i class="fas fa-user"></i> 
                <?php 
                echo '<span class="nombre">' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . '</span>';
                echo '<li><a href="database/logout.php">Salir</a></li>';
                ?><!--Ocultar el texto de Walter Duchi cuando el ancho de la pantalla sea de 710px o menor-->
            </a>
            <div class="espacio-derecho" onclick="location.href='templates/carrito.php'">
                <a href="#" class="cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-counter"><?php echo $total_products; ?></span>
                </a>
            </div>
        </div>
    </nav>
    <script src="js/navbar.js"></script>
</body>
</html>
