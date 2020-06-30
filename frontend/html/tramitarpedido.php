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
  <main class="main-tramitar">
    <div class="container">
        <div class="form">
            <div class="form-group">
                <h3>Metodo de Envio</h3>
                <select name="selEnvio" id="selEnvio" class="form-control">
                    <option id="nada" value="0">Seleccione un metodo de envio</option>
                    <option value="1">Estandar, envio en 48/72h</option>
                    <option value="2">Envio Urgente, envio en 24h</option>
                </select>
            </div>
            <div class="form-group"> 
            <input type="hidden" id="envio" name="envio" value="0">
            </div>
        </div>
        <?php
            $con=mysqli_connect($host, $usuario, $password, $db);

            if(mysqli_connect_errno())
            {
             echo "Error al conectar con la base de datos";
             exit(); 
           }

            $sql="SELECT max(idPedido)+1 as contador
            FROM cabecerapedido";

            $pra=mysqli_prepare($con,$sql);
            mysqli_stmt_execute($pra);
            mysqli_stmt_bind_result($pra, $contador); 
        ?>
        <h3>Pedido</h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Codigo de Pedido</th>
              <th scope="col">Fecha de Pedido</th>
              <th scope="col" colspan="2">Envio</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                 $fechaActual = date('d/m/Y');
              ?>
              <?php
                while(mysqli_stmt_fetch($pra))
                {
              ?>
              <td>P000<?php echo $contador; ?></td>
              <?php
                }
              ?>
              <td><?php echo $fechaActual; ?></td>
              <td id="tr-envio" colspan="2" >No Seleccionado</td>
            </tr>
          </tbody>
          <?php
             $con=mysqli_connect($host, $usuario, $password, $db);

             if(mysqli_connect_errno())
             {
              echo "Error al conectar con la base de datos";
              exit(); 
            }

            $idCesta=$_GET["id"];
            
            $select="SELECT detallecesta.codArticulo, articulos.Nombre, cantidad, precio
            FROM detallecesta
            JOIN articulos
            on articulos.codArticulo=detallecesta.codArticulo
            WHERE idCesta=?";

            $pre=mysqli_prepare($con,$select);

            mysqli_stmt_bind_param($pre,"i", $idCesta);

            mysqli_stmt_execute($pre);

            mysqli_stmt_bind_result($pre, $codArticulo, $Nombre, $cantidad, $precio); 

          ?>
            <thead class="thead-dark">
            <tr>
              <th scope="col">Codigo de Articulo</th>
              <th scope="col">Aeticulo</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Precio Unitario</th>
            </tr>
          </thead>
          <?php
            while(mysqli_stmt_fetch($pre))
            {
          ?>
          <tbody>
            <tr>
              <td>ART000<?php echo $codArticulo; ?></td>
              <td><?php echo $Nombre; ?></td>
              <td ><?php echo $cantidad; ?></td>
              <td class="tramitar-pu"><?php echo $precio; ?>€</td>
            </tr>
          </tbody>
          <?php
            }
          ?>
          <thead>
            <?php
              $con=mysqli_connect($host, $usuario, $password, $db);

              if(mysqli_connect_errno())
              {
               echo "Error al conectar con la base de datos";
               exit(); 
             }
 
             $idCesta=$_GET["id"];
             
             $consulta="SELECT total FROM cabeceracesta WHERE idCesta=?";
 
             $pri=mysqli_prepare($con,$consulta);
 
             mysqli_stmt_bind_param($pri,"i", $idCesta);
 
             mysqli_stmt_execute($pri);
 
             mysqli_stmt_bind_result($pri, $total); 
            ?>
            <tr>
            <?php
              while(mysqli_stmt_fetch($pri))
              {
             ?>
            <td colspan="4" id="precio-Total" >Precio Total: <?php echo $total; ?>€</td>
            <?php
              }
            ?>
          </tr>
        </thead>
        </table>
        <button class="btn btn-success" name="btnConfirmar" id="btnConfirmar">Confirmar Pedido</button>
    </div>
  </main>
  <!-- Footer -->
  <?php
    include "footer.php";
  ?>

  <?php
    mysqli_close($con);
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
      var idCesta=<?php echo $_GET["id"]; ?>;
      var envio=0;
      envio=
      
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                            "margin-top":"18%"});

      $("#selEnvio").change(function(){
        if($("#selEnvio").val()==0)
        {
          alert("Debe seleccionar una de las direcciones");
					event.preventDefault();
        }
        else
        {
          $("#envio").val($("#selEnvio").val());

          if($("#envio").val()==2)
          {
            $("#tr-envio").html("Urgente");
            $("#nada").remove();
            
          }

          if($("#envio").val()==1)
          {
            $("#tr-envio").html("Estandar");
            $("#nada").remove();
          }

         
        }
      });

      $("#btnConfirmar").click(function(){
            if($("#selEnvio").val()==0)
            {
              alert("Debe seleccionar una de las direcciones");
              event.preventDefault();
              
            }
            else
            {
              envio=$("#selEnvio").val();
              
              $.ajax({
                  url: "generarpedido.php",
                  type: "POST",
                  ASYNC: true,
                  data: {idCesta: idCesta, envio: envio},
                  success:function(respuesta)
                  {
                    if(respuesta=="exito")
                    {
                      window.location.href = "pedidocompletado.php";
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
            
          });

    });
  </script>
</body>

</html>
