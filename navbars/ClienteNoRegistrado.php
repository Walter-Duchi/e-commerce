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
            <i class="fa-solid fa-bars" id="menu-toggle"></i>
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
                <?php require 'templates/categories.php'?>
                <form method="POST" action="index.php">
                    <button type="submit" name="cuenta" class="cuenta">
                        <i class="fas fa-user"></i> <span class="cuenta"> Acceder con cuenta</span>
                    </button>
                </form> 

                <form method="POST" action="index.php" id="carritoForm">
                    <div class="espacio-derecho" class="Carrito-Contador" onclick="document.getElementById('carritoForm').submit();">
                        <a href="#" class="cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart-counter">1</span> <!-- Contador del carrito -->
                        </a>
                    </div>
                    <input type="hidden" name="carrito" value="1">
                </form>
            </div>
        </nav>

        <script src="assets/js/navbar.js"></script>
    </body>
</html>