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

  <?php
      include "../../db/conexion.php";   
  ?>
</head>

<body class="body body-tienda" id="page-top">

  <!-- Navigation -->
  <?php
    include 'navbar2.php';
  ?>

  <?php
    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno()){
			echo "Error al conectar con la base de datos";
			exit(); 
    }
    
    $sql="SELECT a.codArticulo, a.Nombre, a.precioCoste, i.Imagen 
    FROM articulos as a 
    JOIN articulosimagenes as ai 
    on ai.idArticulo=a.codArticulo 
    JOIN imagenes as i 
    on i.idImagen=ai.idImagen
    JOIN categoria as c
    on c.idCategoria=a.categoria
    WHERE c.idCategoria=9";

  ?>

  <!-- Header -->
  <header class="container-fluid" id="header">
  <div class="row">
    <!--col-xs-4 col-sm-2-->
    <section id="section-lateral" class="lateral col-4 col-md-2">
      <div>
          <h5 class="lateral">
            <a class="lateral menuizquierda" href="tienda.php">Todas las categorias</a>
          </h5>
          <ul class="nav flex-column col-2">
            <li class="nav-item">
              <a class="nav-link lateral" href="tpescados.php">Pescados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="thuevos.php">Huevos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tleche.php">Leche y derivados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tverduras.php">Verduras y Hortalizas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tfrutas.php">Frutas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tcarnes">Carnes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tlegumbres.php">Legumbres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="tfsecos.php">Frutos Secos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link lateral" href="dulces.php">Dulces</a>
            </li>
            <li class="nav-item">
            <a class="nav-link lateral" href="taceites.php">Grasas, Aceites y Mantequillas</a>
            </li>
          </ul>
      </div>
    </section>
    <!--class="offset-1 col-xs-5 col-sm-9"-->
    <section class="col-8 col-md-10" id="seccion-productos">
      <div class="row row-cols-1 row-cols-md-3">
        <!--<div class="card-columns">-->
    <?php
       if($resultado= mysqli_query($con, $sql))
       {
         while($fila=mysqli_fetch_assoc($resultado))
         {
           
         
    ?>
       <div class="col-12 col-md-4 col-lg-3">
        <div class="card cartas-productos">
          <div class="card-body">
          <?php
            echo " <img src=\"../../images/".$fila['Imagen']."\" class=\"card-img-top productos-img\" alt=\"...\">";
          ?>
            <h5 class="card-title"><?php echo $fila['Nombre']; ?></h5>
            <p class="card-text p-precio">Precio: <?php echo $fila['precioCoste']; ?>€</p>
            <a href="producto.php"type="button" class="btn btn-primary btn-productos">Ver Detalle</a>
          </div>
        </div>
      </div>
    <?php
        }
   
      }
    ?>
        </div>
  <!--</div>-->
    </section>
  </div>
  </header>
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
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff"});
    });
  </script>
  <?php
			    	//Paso 6: Liberar el resultado (recordset)
					mysqli_free_result($resultado);

					//PASO 7: Cerrar la Conexion
					mysqli_close($con);
			    ?>
</body>

</html>