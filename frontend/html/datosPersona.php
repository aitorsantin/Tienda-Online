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

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="../css/agency.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/estilos.css">

</head>

<body class="body" id="page-top">

  <!-- Navigation -->
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

  <!-- Header -->
  <main class="container-fluid" >
    <div class="row" >
      <aside class="col-xs-4 col-sm-2 lateral" id="barra-lateral">
        <section id="section-lateral">
          <div>
            <h5 class="lateral">
              <a class="lateral menuizquierda" href="#">
                Informacion Personal
              </a>
            </h5>
            <ul class="nav flex-column col-2">
              <li class="nav-item">
                <a class="nav-link lateral" href="#">
                  Datos Personales
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link lateral" href="#">Dirección Entrega</a>
              </li>
              <li class="nav-item">
                <a class="nav-link lateral" href="#">Dirección de Facturación</a>
              </li>
              <li class="nav-item">
                <a class="nav-link lateral" href="#">Metodos de Pago</a>
              </li>
            </ul>
          </div>
        </section>
      </aside>
      <div class=" offset-xs-1 col-xs-7 col-sm-9">
      <form class="form" id="FormDatosPersona">
        <div class="form-group row">
           <label class="col-sm-2" for="txtNombre">Nombre: </label>
          <input type="text" class="form-control col-sm-10" name="txtNombre" id="txtNombre" required>
        </div>
        <div class="form-group row">
           <label class="col-sm-4 col-md-2" for="txtApellido">Primer Apellido: </label>
            <input type="text" class="form-control col-sm-8 col-md-4 input-espacio" name="txtApellido" id="txtApellido" required>

          <label class="col-sm-4 col-md-2" for="txtSegundo">Segundo Apellido: </label>
          <input type="text" class="form-control col-sm-8 col-md-4 input-espacio" name="txtSegundo" id="txtSegundo" required>
        </div>
        <div class="form-group row">
          
        </div>
      </form>
    </div>
    </div>
  </main>
  <!-- Footer -->
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
       $(window).resize(function () 
       {
         

          if ($(window).width() <= 991) 
          {
            $("#mainNav").removeClass("fixed-top");
            $("#FormDatosPersona").css({"margin-top":" 2%"});
            $("#section-lateral").css({"padding-top":"1%"});
          }

          if ($(window).width() >= 991) 
          {
            $("#mainNav").addClass("fixed-top");
             $("#FormDatosPersona").css({"margin-top":" 15%"});
          }



        
       });
        

    });
  </script>

</body>

</html>
