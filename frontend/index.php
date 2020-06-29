<!DOCTYPE html>
<html lang="es">
<head>

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tienda Online</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/agency.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">

</head>

<body class="body" id="page-top">

  <?php
     session_start();

    if (isset($_SESSION["login"])) 
    {
      include 'navlogin.php';
    }
    else
    {
      include 'navbar.php';
    }
  ?>

  <!-- Header -->
  <header class="masthead" id="header">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">PubShop</div>
        <div class="intro-heading text-uppercase">Los mejores productos de alimentación</div>
        <!--<a class="btn btn-xl text-uppercase js-scroll-trigger header" href="#services">Quiero saber más</a>-->
        <a id="botonPopPub" class="btn btn-xl portfolio-link text-uppercase" data-toggle="modal" href="#infoempresa">Quiero saber más</a>
      </div>
    </div>
  </header>

  <!-- Servicios -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Nuestros Servicios</h2>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-user-friends fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Atencion al Cliente</h4>
          <p class="text-muted">Disponemos de una plantilla de operadores con el que podeis poneros en contacto en cualquier momento</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-truck fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Servicio de transporte</h4>
          <p class="text-muted">Distribucion a toda España, servicio rapido y seguro, entrea en 24 a 72h.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Web Segura</h4>
          <p class="text-muted">Todos los datos personales e informacion de las transacciones se realizan en un entorno seguro.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Categoria de Productos</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tcategoria1.php">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/cph.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Carne Pescado y Huevos</h4>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tienda.php?id=3">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/lyd.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Leche y Derivados</h4>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tcategoria2.php">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/plf.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Patatas Legumbres y Frutos Secos</h4>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tienda.php?id=4">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/vh.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Verduras y Hortalizas</h4>
          </div>
        </div>
         <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tienda.php?id=5">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/f.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Frutas</h4>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tienda.php?id=9">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/cad.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Cereales Azucar y Dulces</h4>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 portfolio-item">
          <a class="portfolio-link" href="html/tienda.php?id=10">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/imagenes/gam.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4>Grasas Aceite y Mantequilla</h4>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contacto</h2>
          <h3 class="section-subheading text-muted">Realiza una consulta.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Nombre *" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Correo electronico *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" name="phone" type="tel" placeholder="Nº de telefono *" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" name="message" placeholder="Deja tu mensaje *" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="btnSubmit" name="btnSubmit" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php 
    include 'html/footer.php';
  ?>

  <!--Modals-->
   <div class="portfolio-modal modal fade" id="infoempresa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">La Empresa PubShop</h2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                   <ol class="carousel-indicators">   
                    <li data-target="#carouselExampleControls" data-slide-to="0" class="active">
                    </li>
                    <li data-target="#carouselExampleControls" data-slide-to="1">
                    </li>
                    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <img src="img/imagenes/granja.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="img/imagenes/pesca.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="img/imagenes/animal.jpg" class="d-block w-100" alt="...">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>


                <p>TODO COMIENZA AQUÍ, todas las verduras y frutas son cultivadas en nuestras granjas privadas, respetando siempre el producto sin utilizar pesticidas. Todos los animaes tanto terrestres como marinos son criados en nuestras granjas y piscifactorias para que alcancen su mayor calidad. </p>
                <ul class="list-inline">
                  <li>Fecha: Enero 2017</li>
                  <li>Empresa: PubShop</li>
                  <li>Categoria: Alimentacion</li>
                </ul>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>

  <script>
    $(document).ready(function()
		{
			var validado=true;

      $("#btnSubmit").click(function()
      {
        if ($("#name").val()=="") 
				{
					alert("Debe introducir el nombre");
					valido=false;
					event.preventDefault();
				}
        
        if ($("#email").val()=="") 
				{
					alert("Debe introducir el Correo electronico");
					valido=false;
					event.preventDefault();
				}

        if ($("#phone").val()=="") 
				{
					alert("Debe introducir el Nº de telefono");
					valido=false;
					event.preventDefault();
				}

        if (document.getElementById("message").value == "") 
				{
					alert("Debe introducir el mensaje");
					valido=false;
					event.preventDefault();
				}

        return valido;
			});
		});


  </script>

</body>

</html>
