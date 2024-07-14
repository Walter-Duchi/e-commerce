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
            <i class="fa-solid fa-bars" id="menu-toggle"></i> <!--Ocultar es cuando el ancho de la pantalla sea de 710px o menor-->
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo">
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
                    <i class="fas fa-user"></i> <span class="nombre">Walter Duchi</span><!--Ocultar el texto de Walter Duchi cuando el ancho de la pantalla sea de 710px o menor-->
                </a>
                <div class="espacio-derecho">
                    
                <a href="#" class="cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-counter">1</span> <!-- Contador del carrito -->
                </a>
                    
                </div>
            </div>
        </nav>
        

        <main>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut enim leo. Praesent pulvinar, sem eu cursus hendrerit, augue massa accumsan tellus, eu lobortis risus libero vitae est. Etiam sed posuere dolor. Suspendisse ac molestie nibh, vel consectetur lacus. Donec tristique nulla et neque fringilla, eu pretium ex pulvinar. Etiam malesuada id augue ut sodales. Fusce elementum convallis justo nec vestibulum. Integer aliquet laoreet placerat. Praesent id lacus pulvinar, venenatis ante tristique, vulputate sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam in scelerisque felis, ac imperdiet turpis. Quisque dictum nunc eget lectus posuere, ac viverra leo ultricies. Nam lacus massa, vulputate nec dolor eu, vehicula consequat velit. Sed ut velit nec leo pulvinar lacinia.

                Donec iaculis et diam quis fringilla. Nam ut finibus erat. Vivamus sem velit, luctus ac eleifend id, suscipit quis enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porta augue eget nulla ullamcorper, consectetur gravida lacus pretium. Proin nunc neque, aliquet in dignissim ac, auctor in enim. Aenean condimentum, velit nec luctus cursus, sapien massa fermentum turpis, lobortis eleifend turpis quam vitae neque. Sed luctus porta ligula, ut placerat lectus tincidunt ut. Aenean scelerisque sapien at augue ullamcorper luctus. Etiam id est viverra, consectetur massa non, eleifend elit. Proin in gravida massa, vel vehicula erat.

                Nulla at enim elementum, molestie nisi nec, placerat quam. Sed fermentum enim ut lectus cursus ornare. Sed dictum dolor et tellus feugiat faucibus. Cras sed fermentum ante, et facilisis diam. Curabitur fringilla tincidunt sagittis. Ut a mi libero. Cras ac ante eu nibh varius mattis quis molestie urna. Fusce interdum blandit metus, ac semper mauris. Donec ultrices leo ipsum, ac tempor velit fringilla id. Mauris auctor mi vel vehicula condimentum. Nulla tellus est, lobortis sit amet condimentum vel, accumsan vel elit. Maecenas fringilla ac risus eu ornare.

                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur porta semper nulla, id blandit metus. Cras vel faucibus est. Sed imperdiet velit sit amet nunc mattis, id venenatis erat efficitur. Vivamus sapien ante, elementum mattis fermentum ac, scelerisque et elit. Nunc id tortor nisl. Donec sed congue quam. Nullam malesuada dolor est, quis mattis dui malesuada in. Aenean vitae feugiat ex. Mauris mattis eros lectus, id sollicitudin lacus convallis ut. Nullam quis ipsum cursus, viverra enim vel, eleifend diam. Sed bibendum luctus felis sed egestas. Vestibulum ornare leo a eros varius porta eget eu diam.

                Nam non purus consequat magna molestie ultrices id in arcu. Suspendisse convallis sit amet tellus sit amet accumsan. Donec nisl lectus, bibendum at ligula nec, condimentum porta velit. Nam et vehicula lacus. Duis sit amet leo semper mi finibus ultricies. Nunc quis risus eu massa finibus ullamcorper. Vivamus et cursus mauris, venenatis malesuada purus. Praesent at cursus neque. Sed egestas finibus tortor, eget posuere purus efficitur a. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc porta accumsan varius. Aenean tincidunt tincidunt sem a ultrices. Integer tempus dui quis ante euismod, vel dictum purus sodales. Vestibulum condimentum dui nec mauris porta tincidunt. Sed venenatis, nibh eget posuere imperdiet, orci neque lobortis erat, a ornare sem magna sollicitudin purus. Sed augue elit, consectetur sit amet libero vel, feugiat rutrum justo.

                Maecenas a nibh eget est vehicula mollis a eu ipsum. Nam vel cursus quam, et faucibus tellus. Morbi mollis pellentesque auctor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas at fermentum leo. Nullam blandit ipsum et tortor aliquet euismod. Sed vel enim lacinia, luctus tellus eget, tincidunt nibh. Vestibulum aliquet eros hendrerit ipsum rutrum posuere. Duis placerat velit eu diam faucibus ultricies. Nam vitae faucibus magna. Duis maximus hendrerit mauris, vel mattis nulla accumsan nec. Sed ultricies turpis at porta ullamcorper.

                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent ac nibh id felis cursus laoreet quis nec neque. Quisque diam nisl, laoreet nec consectetur non, vehicula quis mi. Sed auctor nulla vel metus placerat auctor. Curabitur porttitor sit amet est fringilla viverra. Fusce eget venenatis quam. Morbi tristique porttitor quam ultricies ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ornare aliquam nunc vitae rutrum. Donec eleifend fermentum elit ut facilisis. Nullam varius lacus velit, et auctor lectus sagittis vitae. Phasellus ligula eros, lacinia eget dui quis, finibus iaculis metus. Aenean tempor ipsum at tellus euismod, sed blandit sem pulvinar. Sed in quam a dui finibus tincidunt.

                Aenean auctor dignissim elit, vitae lobortis eros pharetra cursus. Nulla molestie dignissim scelerisque. Maecenas nisi diam, porttitor eleifend posuere eget, pretium vitae ipsum. Vestibulum laoreet, elit at rhoncus lacinia, nibh tellus suscipit eros, vitae varius nulla nibh nec massa. Nam non eros eget massa iaculis auctor non quis quam. Etiam eu tincidunt ligula, nec pulvinar lectus. Vivamus quis metus at leo tincidunt eleifend id in nisl. Nulla pulvinar nulla felis, nec eleifend quam venenatis a. Proin vel dictum ipsum. Proin sagittis vel sapien sed sodales. Proin in nisl varius, ullamcorper velit non, vestibulum justo. Aenean ex dui, accumsan sed lorem sed, ornare placerat urna. Duis interdum suscipit enim, non auctor est venenatis quis. Morbi imperdiet interdum facilisis.

                Morbi quam est, gravida lacinia velit eu, rhoncus faucibus eros. Integer in ultricies turpis. Fusce vitae erat sit amet nibh efficitur tincidunt sit amet consectetur est. Pellentesque luctus ac nunc accumsan venenatis. Suspendisse maximus fermentum turpis ac dictum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas pharetra at ipsum ut lacinia. Pellentesque sed luctus purus. Donec convallis dui sit amet ante dictum, vel sodales eros lobortis. Quisque in vehicula tellus, ut cursus ante. Morbi et augue eros. Nullam tincidunt eu ex non cursus. In in purus eget elit blandit varius vitae id sem. Maecenas efficitur augue et risus lacinia, ut dapibus metus vulputate. Nulla congue iaculis sapien a hendrerit.

                Nam porta tincidunt aliquam. Morbi a rutrum magna, non rutrum sem. Etiam nulla tellus, euismod auctor augue nec, fermentum fringilla quam. Aliquam vel pellentesque velit. Morbi suscipit tortor id erat venenatis, a pulvinar lorem gravida. Praesent vitae nisi sed diam dignissim commodo id nec neque. Maecenas dictum ornare tincidunt. Proin nec turpis facilisis, tristique lorem sagittis, gravida nulla. Aliquam blandit, leo eu mollis blandit, dolor augue consequat sapien, vitae viverra felis purus at ex. Donec tincidunt ex metus, nec pellentesque est porta id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin ut volutpat nunc. Integer tincidunt mi neque, sed tempor diam maximus non.
            </p>

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

        <script src="js/navbar.js"></script>
    </body>
</html>