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
  </header>
  <?php
    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno())
    {
     echo "Error al conectar con la base de datos";
     exit(); 
   }
   if (isset($_SESSION["login"])) 
    {
      $username = $_SESSION["login"];
      
    }

    $select="SELECT d.idCesta, nfila, d.codArticulo, a.Nombre, cantidad, precio, total_linea
    FROM detallecesta d
    join cabeceracesta c
    on c.idCesta=d.idCesta
    join articulos as a
    on a.codArticulo=d.codArticulo
    JOIN clientes 
    on clientes.idCliente=c.idCliente
    join registrologin
    on registrologin.idRegistro=clientes.idRegistro
    WHERE c.estado=1 and registrologin.Username=?";

    

    $pra=mysqli_prepare($con,$select);

    mysqli_stmt_bind_param($pra,"s", $username);

    mysqli_stmt_execute($pra);

    mysqli_stmt_bind_result($pra, $idCesta, $nfila, $codArticulo, $Nombre, $cantidad, $precio, $total_linea); 
      
  ?>
  <!-- Header -->
  <main class="main-pequeespacio container-fluid" id="header">
      <h1>Carro de la Compra</h1>
      <table id="tabla-cesta" style="width:100%" class="tablaCompras table">
      <tr class="tr-cabeceras thead-dark">
        <th>Descartar</th>
        <th>Codigo de Articlo</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
      </tr>
    
    <?php
       
         

      while(mysqli_stmt_fetch($pra))
      {
        
    ?>
      <tr class="tr-sql">
        <?php
          echo "<td><a href=\"eliminarfilacesta.php?idCesta=".$idCesta."&codArticulo=".$codArticulo."\" class=\"btn btn-danger\">Descartar</a></td>";
         ?>
        <td>ART000<?php echo $codArticulo; ?></td>
        <td><?php echo $Nombre; ?></td>
        <td><?php echo $cantidad; ?></td>
        <td class="td-precio"><p><?php echo $precio; ?>€</p></td>
        
      </tr>
      <?php
      }
      ?>
      <?php

        $con=mysqli_connect($host, $usuario, $password, $db);

        if(mysqli_connect_errno())
        {
        echo "Error al conectar con la base de datos";
        exit(); 
        }

        //$username = $_SESSION["login"];

        $consulta="SELECT cabeceracesta.total
        FROM cabeceracesta
        JOIN clientes 
        on clientes.idCliente=cabeceracesta.idCliente
        join registrologin
        on registrologin.idRegistro=clientes.idRegistro
        WHERE cabeceracesta.estado=1 and registrologin.Username=?";

        $pri=mysqli_prepare($con,$consulta);

        mysqli_stmt_bind_param($pri,"s", $username);

        mysqli_stmt_execute($pri);

        mysqli_stmt_bind_result($pri, $total); 

      ?>
      <tr>
        <?php
          while(mysqli_stmt_fetch($pri))
          {
        ?>
        <td id="precio-Total" colspan="5">Total: <?php echo $total; ?>€</td>
        <?php
          }
        ?>
      </tr>
    </table>
    <article>
    <?php

$con=mysqli_connect($host, $usuario, $password, $db);

if(mysqli_connect_errno())
{
 echo "Error al conectar con la base de datos";
 exit(); 
}

//$username = $_SESSION["login"];

$sql='SELECT CONCAT(d.Direccion," ", d.CP," ", d.Poblacion) AS dCompleta, d.idDireccion
FROM direccion as d
JOIN clientesdirecciones as c
on c.idDireccion=d.idDireccion
JOIN clientes AS cli
on cli.idCliente=c.idCliente
join registrologin as rl
on rl.idRegistro=cli.idRegistro
WHERE rl.Username=? AND D.Activo=1
';

$pre=mysqli_prepare($con,$sql);
 
if($pre)
{

 mysqli_stmt_bind_param($pre, "s", $username);

 mysqli_stmt_execute($pre);

 mysqli_stmt_bind_result($pre, $dCompleta, $idDireccion);
}
?>
      <div class="row fila-espacio">
        <div class="card col-xs-12 col-lg-4">
          <div class="card-body">
            <h5 class="card-title">Direccion de Envio</h5>
            <div id="direccion-contenedor">

            <?php
            if (!isset($_SESSION["login"])) 
            {
              
             ?>
            <p class="card-text">No existe ninguna direccion de envio seleccionada</p>
            <?php
              }
             ?>
           <?php
               while(mysqli_stmt_fetch($pre))
               {
                 ?>
                 <p class="card-text p-direccion"><?php echo $dCompleta; ?></p>
                 <a href="direcciones.php" class="btn btn-dark">Cambiar Direccion de envio</a>
                 <?php
 
               }
           ?>
           </div>
          </div>
        </div>
      </div>
    </article>
    <article>
       <div class="row fila-espacio">
        <div class="card col-xs-12 col-lg-4">
          <div class="card-body">
            <h5 class="card-title">Metodo de Pago</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-dark">Cambiar Metodo de Pago</a>
          </div>
        </div>
      </div>
    </article>
    <article class="container article-espacio">
      <div class="row">
        <div class="col-xs-8 col-lg-10">
          
        </div>
        <a id="tramitar-pedido" href="tramitarpedido.php?id=<?php echo $idCesta; ?>" class="btn btn-primary col-xs-4 col-lg-2">Tramitar Pedido</a>
      </div>
    </article>  
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
                            "margin-top":"8%"});

      <?php
        if (!isset($_SESSION["login"])) 
        {
      ?>

      var resultado=$("tr").hasClass("tr-sql")
      if(resultado==false)
      {
        $("#tabla-cesta").append("<tr>"+
        "<td></td>"+
        "<td>Codigo del Articulo</td>"+
        "<td>Nombre del Articulo</td>"+
        "<td>0</td>"+
        "<td><p>0€</p></td>"+
        "</tr>");

        $("#tramitar-pedido").click(function(){
          alert("No puede tramitar ningun pedido ya que no ha iniciado sesion");
          $("#tramitar-pedido").attr('href', 'cesta.php');
        });

      }
      <?php
        
        }
      ?>

      <?php 
         if (isset($_SESSION["login"])) 
         {
      ?>
        var resultado=$("tr").hasClass("tr-sql");
        if(resultado==false)
        {
          $("#tabla-cesta").append("<tr>"+
          "<td></td>"+
          "<td>Codigo del Articulo</td>"+
          "<td>Nombre del Articulo</td>"+
          "<td>0</td>"+
          "<td><p>0€</p></td>"+
          "</tr>");

          $("#tramitar-pedido").click(function(){
            alert("No puede tramitar ningun pedido ya que la cesta esta vacia");
            $("#tramitar-pedido").attr('href', 'cesta.php');
          });

        }
    <?php  
          }
        ?>

       
       var direccion=$("p").hasClass("p-direccion");
       if(direccion==false)
       {
         $("#direccion-contenedor").html("<p class=\"card-text\">No existe ninguna direccion de envio seleccionada</p>");

         <?php 
          if (isset($_SESSION["login"])) 
          {
         ?>
            $("#direccion-contenedor").append("<a href=\"direccion.php\" class=\"btn btn-dark\">Añadir Direccion de envio</a>");
            
            $("#tramitar-pedido").click(function(){
              alert("No puede tramitar ningun pedido ya que no existe ninguna direccion de envio");
              $("#tramitar-pedido").attr('href', 'cesta.php');

              
            });
        <?php  
            }
          ?>
       }

      

      
    });
  </script>
</body>

</html>
