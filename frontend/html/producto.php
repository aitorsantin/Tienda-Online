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

<body class="body" id="page-top">

  <!-- Navigation -->
  <?php
     session_start();

    if (isset($_SESSION["login"])) 
    {
      include 'navlogin2.php';
      $username = $_SESSION["login"];

    }
    else
    {
      include 'navbar2.php';
    }
  ?>

  <?php
    $codArticulo=$_GET['id'];
    
    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno()){
			echo "Error al conectar con la base de datos";
			exit(); 
    }
    
    $sql="SELECT a.codArticulo, a.Nombre, a.precioCoste, i.Imagen, a.Descripcion, a.Stock
    FROM articulos as a 
    JOIN categoria as c 
    on c.idCategoria=a.categoria
    JOIN articulosimagenes as ai
    on ai.idArticulo=a.codArticulo
    JOIN imagenes as i
    on i.idImagen=ai.idImagen
    WHERE a.codArticulo=?";

    $pre=mysqli_prepare($con,$sql);

    if($pre)
    {
      //Paso 4.2: Vincular los Parametros
      mysqli_stmt_bind_param($pre, "i", $codArticulo);

      //paso 5: Ejecutar la consulta
      mysqli_stmt_execute($pre);
      //Paso 6: Guardamos los campos obtenidos a la tabla
      //Las variables deben coincidir con los nombres de la tabla
      mysqli_stmt_bind_result($pre, $codArticulo, $Nombre, $precioCoste, $Imagen, $Descripcion, $Stock);

    }
  ?>

  <!-- Header -->
  <header class="container-fluid" id="header">
  <div class="row">
  <?php
     if (isset($_SESSION["login"])) 
     {
  ?>
      <input type="hidden" name="username" id="username" value="<?php echo $username; ?>">
  <?php
     }
     else
     {
  ?>
    <input type="hidden" name="username" id="username" value="vacio">
  <?php

     }
  ?>
 
  <?php 
    while(mysqli_stmt_fetch($pre))
		{

  ?>
  <section class="offset-2 col-7 col-md-9" id="seccion-productos">
      <article class="row justify-content-start">
        <div id="producto-imagen" class="col-12 col-lg-5">

          <img src="../../images/<?php echo $Imagen; ?>" class="img-responsive fotoProducto" draggable="false">
        </div>
        <div class="col-12 col-lg-7 detalle-padding">
          <h2><?php echo $Nombre; ?></h2>
          <p class="precio"><?php echo $precioCoste; ?> €</p>
          <div class="cuadro-descripcion">
            <p class="descripcion">Descripcion: <?php echo  $Descripcion;?> </p>
          </div>
          <h5 id="h5-cantidad">Cantidad</h5>
          <input type='number' class="form-control" name="cantidad" id="cantidad" placeholder="1" min="1" nax="<?php echo $Stock; ?>">
          
          <p id="maximo"><?php echo $Stock; ?></p>
          <?php
            if($Stock<=10 && $Stock >0)
            {
              echo " <h5 id=\"h5-rojo\">Quedan $Stock articulos</h5>";
            }

            if($Stock==0)
            {
              echo " <h5 id=\"h5-rojo\">Producto Agotado</h5>";
          ?>
            <button id="enviar" type="button" class="btn btn-secondary" disabled>Añadir a la cesta</button>
          <?php
            }
            else
            {
          ?>
          <button id="enviar" type="button" class="btn btn-secondary">Añadir a la cesta</button>
          <?php
            }
          ?>
          

          
        </div>
        
      </article>
  </section>
  <div id="resp"></div>
  <?php
			}
    mysqli_stmt_close($pre);
    mysqli_close($con);
	?>
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
    var codArticulo=<?php echo $codArticulo; ?>;
    var user=$("input:hidden").val();
    var max=parseInt($("#maximo").text());
    $("#maximo").css("display", "none");
    
    var cantidad=parseInt($("#cantidad").val());
          

    $("#mainNav").removeClass("fixed-top");
    $("#pie-pagina").css({"background-color":"#6c757d",
                                "color":"#fff",
                                "margin-top":"19%"});

    $("#enviar").click(function()
    {
      
      if($("#username").val()=="vacio")
      {
        alert("No puede añadir productos a la cesta por que no ha iniciado sesion");
      }
      else
      {
        if($("#cantidad").val()=="")
        {
          cantidad=1;
        }
        else
        {
          cantidad=$("#cantidad").val();
        }

        if(max<cantidad)
        {

          alert("No se puede añadir tal cantidad a la cesta, el numero máximo de unidades de este artículo es "+max);
        }
        else if(cantidad<=0)
        {
          alert("La unidad minima a añadir es 1");
        }
        else if(cantidad<=max)
        {
          $.ajax({
            url: "añadircesta.php",
            type: "POST",
            ASYNC: true,
            data: {codArticulo: codArticulo, cantidad: cantidad, username: user},
            success:function(respuesta)
            {
              if(respuesta=="exito")
              {
                alert("Producto añadido a la cesta");
              }
              else
              {
                alert("Ocurrio un problema");
              }
              
            },
            error: function(error)
            {
              console.log(error);
            }

          });
        }
      }

    });
    

  });
</script>

</body>

</html>
