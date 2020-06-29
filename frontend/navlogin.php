<?php
  session_start();
?>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-secondary fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#header">PubShop</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#header">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contactanos</a>
          </li>
          <li class="nav-item">
         
            <a class="nav-link js-scroll-trigger" href="html/tienda.php">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="html/cesta.php">
              <i class="fas fa-shopping-cart fa-lg "></i>
            </a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="username"><?php echo $_SESSION["login"];?></span></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="html/menucuenta.php" id="account">Mi cuenta</a>
            <a class="dropdown-item" href="html/pedidos.php" id="orders">Mis Pedidos</a>
            <a class="dropdown-item" href="html/direcciones.php" id="addresses">Direcciones</a>
            <a class="dropdown-item" href="#" id="payment">Metodos de Pago</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="html/cerrar_sesion.php">Cerrar Sesion</a>
        </li>
        </ul>
      </div>
    </div>
  </nav>
