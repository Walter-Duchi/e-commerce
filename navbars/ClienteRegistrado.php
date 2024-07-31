<?php
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
            <a href="index.php">
                <img src="assets/img/logo.png" alt="Logo">
                <a href="index.php" class="ocultar">Envios Express</a>
            </a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Busca más de 10000 productos">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-links">
            <?php require 'templates/categories.php'; ?>
            <a href="#" class="profile">
                <i class="fas fa-user"></i> 
                <?php 
                echo '<span class="nombre">' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . '</span>';
                echo '<a href="database/logout.php">Salir</a>';
                ?>
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
