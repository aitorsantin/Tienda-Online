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
  <?php
        include "../../db/conexion.php";   
    ?>
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
  <?php 
     $con=mysqli_connect($host, $usuario, $password, $db);

     if(mysqli_connect_errno()){
      echo "Error al conectar con la base de datos";
      exit(); 
    }
    $sql="SELECT MAX(idPedido) AS idPedido
    FROM cabecerapedido";

  if($resultado= mysqli_query($con, $sql))
  {
    while($fila=mysqli_fetch_assoc($resultado))
    {
      $idPedido=$fila['idPedido'];

      
    }
  }
  

  $select=("CALL pr_movimientosAlmacen(?);");
        $procedure=mysqli_prepare($con, $select);
        mysqli_stmt_bind_param($procedure, 'i', $idPedido);
				

				if (mysqli_stmt_execute($procedure))
				{
					$message = 'Direccion dada de alta';
				}
				else
				{
					$message = 'No se pudo dar de alta la direccion';
        }
        
       
				mysqli_stmt_close($procedure);
				mysqli_close($con);
  ?>
  </header>
  <main class="container">
    <h1 id="titulo-tramitado">Pedido Tramitado Con Existo</h1>
    <p id="p-tramitado">Puede consultar el estado de su pedido en el menú de su cuenta en el apartado de pedidos.</p>
    <h2>¿Qué desea hacer?</h2>
    <ul id="ul-tramitado">
        <li><a href="tienda.php" class="a-tramitado">Volver a realizar un Pedido</a></li>
        <li><a href="pedidos.php" class="a-tramitado">Ver mis pedidos realizados</a></li>
        <li><a href="../index.php" class="a-tramitado">Volver a la pagina de inicio</a></li>
    </ul>
  </main>
  <!-- Footer -->
  <?php
    include "footer.php";
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
      var fila="";
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                            "margin-top":"26%"});


      
    });
  </script>
</body>

</html>
