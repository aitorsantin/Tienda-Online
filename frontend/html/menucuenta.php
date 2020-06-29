<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tienda Online</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  <link href="../css/agency.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/estilos.css">

</head>

<body class="body" id="page-top">

  <header>
    <?php
     session_start();

    if (isset($_SESSION["login"])) 
    {
      include 'navlogin2.php';
    }
    else
    {
      include 'navbar2.php';
    }
  ?>
  </header>
  <main class="container" id="main-opciones">
    <div class="row">
      <a href="account.php" class="col mb-4 a-carta">
        <div class="col mb-4">
            <div class="card h-100">
            <img src="../../images/user.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Datos Personales</h5>
            </div>
            </div>
        </div>
      </a>
      <a href="pedidos.php" class="col mb-4 a-carta">
        <div class="col mb-4">
            <div class="card h-100">
            <img src="../../images/pedidos.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Mis Pedidos</h5>
            </div>
            </div>
        </div>
      </a>
      <a href="direcciones.php" class="col mb-4 a-carta">
        <div class="col mb-4">
            <div class="card h-100">
            <img src="../../images/casa.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Direcciones</h5>
            </div>
            </div>
        </div>
      </a>
      <a href="#" class="col mb-4 a-carta">
        <div class="col mb-4">
            <div class="card h-100">
            <img src="../../images/pago.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Metodos de Pago</h5>
            </div>
            </div>
        </div>
      </a>
  
    </div>
  </main>
  <?php
      include 'footer.php';
    ?>

  

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="../js/jqBootstrapValidation.js"></script>
  <script src="../js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../js/agency.min.js"></script>

  <script>
    $(document).ready(function()
    {
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                          "margin-top":"21%"});
    });
  </script>

</body>

</html>