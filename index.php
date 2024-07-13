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
    <link rel="stylesheet" href="css/navbar-footer.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="assets/img/logo.png" alt="Logo">
           
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Busca más de 10000 productos">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-links">
            <div class="categories">
                <span>Categorías</span>
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
                <i class="fas fa-user"></i> Walter Duchi
            </a>
            <a href="#" class="cart">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
    </nav>
    
    <main>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="footer-links">
                <a href="#">Ubicación</a>
                <a href="#">Términos y condiciones</a>
                <a href="#">Política de privacidad</a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-section">
                <h4>Pago seguro</h4>
                <i class="fa-solid fa-pager"></i>
            </div>
            <div class="footer-section">
                <h4>Redes Sociales</h4>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>
            <div class="footer-section">
                <h4>Contactos</h4>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="footer-section">
                <h4>Aceptamos todas las tarjetas de crédito</h4>
                <i class="fa-solid fa-credit-card"></i>
            </div>
        </div>
    </footer>
</body>
</html>