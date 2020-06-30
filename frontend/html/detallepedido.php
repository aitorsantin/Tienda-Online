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
  <!-- Header -->
  <main class="main-espacio container-fluid" id="header">
      <?php
        $idPedido=$_GET["idPedido"];
       ?>
      <h1>Detalle del Pedido: P<?php echo date("Y"); echo $idPedido; ?></h1>
      <?php
        $con=mysqli_connect($host, $usuario, $password, $db);
        $pTotal=0;
        $username=$_SESSION["login"];

        $select="SELECT c.idPedido, c.Fecha, c.Envio, c.Estado, c.Total
        FROM cabecerapedido as c
        join clientes as cli
        on cli.idCliente=c.idCliente
        join registrologin as r
        on r.idRegistro=cli.idRegistro
        WHERE c.idPedido=? ";

        $pra=mysqli_prepare($con,$select);

        mysqli_stmt_bind_param($pra, "i", $idPedido);

        mysqli_stmt_execute($pra);

        mysqli_stmt_bind_result($pra, $idPedido, $Fecha, $Envio, $Estado, $Total);
         
      ?>
      <table style="width:100%" class="tablaCompras tablaPedido tablaDetalle table">
      <tr class="thead-dark">
        <th class="columna-fecha">Fecha de Pedido</th>
        <th>Codigo de Pedido</th>
        <th colspan="2" class="mas-espacio">Estado del Pedido</th>
        <th colspan="2" class="mas-espacio">Tipo de Envio</th>
      </tr>
      <?php 
          while(mysqli_stmt_fetch($pra))
          {  
            $pTotal=$Total;
      ?>
      <tr>
      <td class="columna-fecha"><?php echo $Fecha; ?></td>
      <td>P<?php echo date("Y"); echo $idPedido; ?></td>
      <?php
          switch ($Estado)
          {
            case "p":
              echo "<td colspan=\"2\">Pendiente de Preparacion</td>";
            break;

            case "e":
              echo "<td colspan=\"2\">Pedido Enviado</td>";
            break;
            case "c":
              echo "<td colspan=\"2\">Pedido Completado/td>";
            break;
            case "k":
              echo "<td colspan=\"2\">Pedido Cancelado</td>";
            break;
          }

         ?>
         <?php
          switch ($Envio)
          {
            case "1":
              echo "<td colspan=\"2\">Envio Estandar</td>";
            break;

            case "2":
              echo "<td colspan=\"2\">Envio urgente</td>";
            break;
          }
         ?>
      </tr>
      <?php
        }
      ?>   
      <?php
         $sql="SELECT d.idArticulo,a.Nombre, i.imagen, d.Cantidad, d.Precio, d.totalLinea
         FROM detallepedido AS d
         join articulos as a
         on a.codArticulo=d.idArticulo
         join articulosimagenes ai
         on ai.idArticulo=a.codArticulo
         join imagenes as i
         on i.idImagen=ai.idImagen
         WHERE d.idPedido=?";
 
         $pre=mysqli_prepare($con,$sql);
 
         mysqli_stmt_bind_param($pre, "i", $idPedido);
 
         mysqli_stmt_execute($pre);
 
         mysqli_stmt_bind_result($pre, $idArticulo, $Nombre, $imagen, $Cantidad, $Precio, $totalLinea); 
       ?>   
      <tr class="thead-dark">
        <th class="columna-fecha">Articulo</th>
        <th>Descripcion</th>
        <th>Imagen Articulo</th>
        <th class="mas-espacio">Cantidad</th>
        <th class="mas-espacio">Precio</th>
        <th class="mas-espacio">Precio Total de la linea</th>
      </tr>
      <?php

      ?>
      <?php
      while(mysqli_stmt_fetch($pre))
      { 
       ?>
      <tr>
        <td class="columna-fecha">ART<?php echo date("Y"); echo $idArticulo; ?></td>
        <td><?php echo $Nombre; ?></td>
        <td><img class="img-detalle" src="../../images/<?php echo $imagen; ?>" alt=""></td>
        <td class="mas-espacio"><?php echo $Cantidad; ?></td>
        <td class="mas-espacio"><?php echo $Precio; ?>€</td>
        <td class="mas-espacio"><?php echo $totalLinea; ?>€</td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <td id="precio-Total" colspan="6">Precio Total: <?php echo $pTotal; ?>€</td>
      </tr>
    </table>
        <div class="div-volver">
          <a class="btn btn-gris" href="pedidos.php">Volver a la lista de Pedidos</a>
        </div>
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
      var id="";

      //$("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                            "margin-top":"10%"});

      $('#<?php echo $idPedido; ?>').click(function()
      {
        alert($('#<?php echo $idPedido; ?>').attr('id'));
      });


    });
  </script>
</body>

</html>