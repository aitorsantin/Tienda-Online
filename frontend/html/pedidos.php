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
      <h1>Mis Pedidos</h1>
      <?php
        $con=mysqli_connect($host, $usuario, $password, $db);

        $username=$_SESSION["login"];
        
        $sql="SELECT c.idPedido, c.Fecha, c.Envio, c.Estado, c.Total
        FROM cabecerapedido as c
        join clientes as cli
        on cli.idCliente=c.idCliente
        join registrologin as r
        on r.idRegistro=cli.idRegistro
        WHERE r.Username=? ";

        

        $pre=mysqli_prepare($con,$sql);


        mysqli_stmt_bind_param($pre, "s", $username);

        mysqli_stmt_execute($pre);

        mysqli_stmt_bind_result($pre, $idPedido, $Fecha, $Envio, $Estado, $Total);
        
        while(mysqli_stmt_fetch($pre))
        { 
      ?>
      <table style="width:100%" class="tablaCompras tablaPedido table">
      <tr class="tr-cabeceras thead-dark">
        <th>Fecha de Pedido</th>
        <th>Codigo de Pedido</th>
        <th>Estado del Pedido</th>
        <th>Tipo de Envio</th>
        <th>Precio Total</th>
        <th>Mostrar Detalle de Pedido</th>
      </tr>
      <?php

      ?>
      <tr>
        <td><?php echo $Fecha; ?></td>
        <td class="idPedido">P<?php echo date("Y"); echo $idPedido; ?></td>
        <?php
          switch ($Estado)
          {
            case "p":
              echo "<td>Pendiente de Preparacion</td>";
            break;

            case "e":
              echo "<td>Pedido Enviado</td>";
            break;
            case "c":
              echo "<td>Pedido Completado/td>";
            break;
            case "k":
              echo "<td>Pedido Cancelado</td>";
            break;
          }

         ?>
         <?php
          switch ($Envio)
          {
            case "1":
              echo "<td>Envio Estandar</td>";
            break;

            case "2":
              echo "<td>Envio urgente</td>";
            break;
          }
         ?>
        <td ><?php echo $Total; ?>€</td>
        <td>
          <?php
          echo "<a href=\"detallepedido.php?idPedido=$idPedido\" class=\"btn btn-primary\">Detalle de Pedido</a>";
         ?>
         </td>
      </tr>
          <?php
        } 
    ?>
    </table> 
    <div id="tabla-llena">
    </div>

    <div class="div-volver">
      <a href="menucuenta.php" class="btn btn-gris">Volver al menu</a>
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
                            "margin-top":"20%"});

     if(!$("table").length)
     {
       $("#tabla-llena").html("<table style=\"width:100%\" class=\"tablaCompras tablaPedido table\" id=\"tabla-vacia\">"+
                              "<tr class=\"tr-cabeceras thead-dark\">"+
                              "<th>Fecha de Pedido</th>"+
                                "<th>Codigo de Pedido</th>"+
                                "<th>Estado del Pedido</th>"+
                                "<th>Tipo de Envio</th>"+
                                "<th>Precio Total</th>"+
                              "</tr>"+
                              "<tr>"+
                              "<td> 00/00/0000 </td>"+
                                "<td>Codigo de Pedido</td>"+
                                "<td>Estado del Pedido</th>"+
                                "<td>Tipo de Envio</td>"+
                                "<td>0€</td>"+
                              "</tr>"+
                            "</table>");
                            $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                            "margin-top":"25%"});
    }
    
      
    });
  </script>
</body>

</html>
