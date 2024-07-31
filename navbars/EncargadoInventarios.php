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

        <style>
            main{
                margin-top: 110px;
            }
            
            @media (max-width: 696px) {
                main{
                    margin-top: 145px;
                }
            }
            
         
        </style>
    </head>
    <body>
        <nav class="navbar">
            <i class="fa-solid fa-bars" id="menu-toggle"></i> <!--Ocultar es cuando el ancho de la pantalla sea de 710px o menor-->
            <a href="index.php?page=productos">
                <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
                <a href="" class="ocultar">Envios Express</a><!--Ocultar es cuando el ancho de la pantalla sea de 710px o menor-->
            </div>
            </a>
            
            <div class="search-bar">
                <input type="text" placeholder="Busca más de 10000 productos">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="nav-links">
                <a href="#" class="profile">
                    <i class="fas fa-user"></i> 
                    <?php 
                    echo '<span class="nombre">' . $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellido'] . '</span>';
                    echo '<a href="database/logout.php">Salir</a>';
                    ?>
                </a>
                <div class="espacio-derecho" onclick="location.href='templates/carrito.php'"></div>
            </div>

        </nav>
        <nav class="navbar-links">
            <div class="nav-links">
                <a href="index.php?page=productos" style="margin: 0 50px;">Productos</a>
                <a href="index.php?page=clientes_por_responder" style="margin: 0 50px;">Clientes por responder</a>
                <a href="index.php?page=clientes_respondidos" style="margin: 0 50px;">Clientes respondidos</a>
            </div>
        </nav>

        <script src="js/navbar.js"></script>
    </body>
</html>