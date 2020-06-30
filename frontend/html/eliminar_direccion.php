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
    //Actualizar direccion
    if(isset($_POST['btnSubmit']))
    {
      
        include "../../db/conexion.php"; 
        $con=mysqli_connect($host, $usuario, $password, $db);
        
        $idDireccion=$_POST["txtIdDireccion"];

        $sql="CALL pr_eliminarDireccion('".$idDireccion."')";
        mysqli_query($con, $sql);
        $message="Direccion Eliminada";
        
        mysqli_close($con); 
    }
  ?>
  <?php
    //Obtener Codigo del Cliente
    $con=mysqli_connect($host, $usuario, $password, $db);
          
    $codCli="";
    $username = $_SESSION["login"];

      
    if(mysqli_connect_errno())
    {
      echo "Error al conectar con la base de datos";
      exit(); 
    }

    $consulta = ("call pr_CargarDirecciones('".$username."', @codCli);");
    $sentencia=("select @codCli as codCli");
   
    mysqli_query($con, $consulta);
    $datos=mysqli_query($con, $sentencia);
    
    $fila=mysqli_fetch_assoc($datos);
    $codCli=$fila['codCli'];
  ?>
  <?php
    //Cargar Combo Direcciones
    $sql=('SELECT CONCAT(d.Direccion," ", d.CP," ", d.Poblacion) AS dCompleta, d.idDireccion
            FROM direccion as d
            JOIN clientesdirecciones as c
            on c.idDireccion=d.idDireccion
            WHERE d.tipoDireccion="envio" AND c.idCliente=? OR d.tipoDireccion="ambas" AND c.idCliente=? ');
  
    $pre=mysqli_prepare($con,$sql);
  
    if($pre)
    {
      mysqli_stmt_bind_param($pre, "ss", $codCli, $codCli);

      mysqli_stmt_execute($pre);

      mysqli_stmt_bind_result($pre, $dCompleta, $idDireccion);
    }
  ?>
</header>
<main class="container">
<?php if(!empty($message)): ?>
    <p id="p-registro"> <?= $message ?></p>
<?php endif; ?>
   
<form class="form" method="POST" action="#">
    <div class="form-group">
        <select class="form-control" name="selDireccion" id="selDireccion">
                <option value="0">Selleccione una direccion a editar</option>
                <?php
                  while(mysqli_stmt_fetch($pre))
                  {
                    echo " <option value=\"$idDireccion\">".$dCompleta."</option>";
                  }
                ?>
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" id="txtIdDireccion" name="txtIdDireccion" value="<?php echo $idDireccion ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Eliminar">
        <a href="direcciones.php" class="btn btn-gris">Volver a Seleccionar una Direccion</a>
    </div>
</form>
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
      var valor="";
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"margin-top":"34%",
                            "background-color":"#6c757d",
                            "color":"#fff"});
      
      

      $("form").submit(function(e)
      {
        if($("#selDireccion").val()=="0")
        {
          e.preventDefault();
          alert("Debe seleccionar una direccion para eliminar");
        }
            
      });
  });
  </script>

</body>

</html>