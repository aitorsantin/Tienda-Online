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

<body>
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
  <main class="container">
  <?php
        /*Comprobar si ya se ha asignado una direccion de envio como predeterminada*/ 
          function comprobarPredeterminado($con, $codCli)
          {
            $valor=0;

            $select=("SELECT COUNT(*) AS asignado
            FROM clientes as c
            JOIN clientesdirecciones as cd
            on cd.idCliente=c.idCliente
            JOIN direccion as d
            on d.idDireccion=cd.idDireccion
            WHERE c.idCliente=? AND d.Activo=1");

            $pre=mysqli_prepare($con,$select);

            mysqli_stmt_bind_param($pre, "s", $codCli);

            mysqli_stmt_execute($pre);

            mysqli_stmt_bind_result($pre, $asignado);

            while(mysqli_stmt_fetch($pre))
            {
               $valor=$asignado;
            }
              
            return $valor;

          }
      ?>
      <?php 
          $contador=1;
          $con=mysqli_connect($host, $usuario, $password, $db);
          
          $codCli="";
          $username = $_SESSION["login"];

          //Paso 3 Comprobar si conecta
          if(mysqli_connect_errno()){
            echo "Error al conectar con la base de datos";
            exit(); 
          }

          $consulta = ("call pr_CargarDirecciones('".$username."', @codCli);");
          $sentencia=("select @codCli as codCli");
         
          mysqli_query($con, $consulta);
          $datos=mysqli_query($con, $sentencia);
          
          $fila=mysqli_fetch_assoc($datos);
          $codCli=$fila['codCli'];

          //Comprobar si hay Asignada ya una direccion como predeterminada.
          $activo=comprobarPredeterminado($con, $codCli);

          if($activo==0)
          {
            $sql=('SELECT CONCAT(d.Direccion," ", d.CP," ", d.Poblacion) AS dCompleta, d.idDireccion
            FROM direccion as d
            JOIN clientesdirecciones as c
            on c.idDireccion=d.idDireccion
            WHERE d.tipoDireccion="envio" AND c.idCliente=? OR d.tipoDireccion="ambas" AND c.idCliente=? ');
  
            $pre=mysqli_prepare($con,$sql);
  
            if($pre)
            {
              //Paso 4.2: Vincular los Parametros
              mysqli_stmt_bind_param($pre, "ss", $codCli, $codCli);
    
              //paso 5: Ejecutar la consulta
              mysqli_stmt_execute($pre);
              //Paso 6: Guardamos los campos obtenidos a la tabla
              //Las variables deben coincidir con los nombres de la tabla
              mysqli_stmt_bind_result($pre, $dCompleta, $idDireccion);
              
    
            }
            ?>
                <?php if(!empty($message)): ?>
              <p id="p-registro"> <?= $message ?></p>
              <?php endif; ?>
              <form class="form" method="POST" action="../validaciones/validardireccion.php">
              <div class="form-group">
                      <select class="form-control" name="selDireccion" id="selDireccion">
                        <option value="0">Establezca una direccion de envio como predeterminada</option>
                        <?php
                        while(mysqli_stmt_fetch($pre))
                        {
                          echo " <option value=\"$idDireccion\">".$dCompleta."</option>";
                        }
                        ?>
                      </select>
              </div>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="btnEnviar" id="btnEnviar" value="Asignar Direccion">
              </div>
              </form>
          <?php
          }
          if($activo==1)
          {
            $sql=('SELECT CONCAT(d.Direccion," ", d.CP," ", d.Poblacion) AS dCompleta, d.idDireccion
            FROM direccion as d
            JOIN clientesdirecciones as c
            on c.idDireccion=d.idDireccion
            WHERE c.idCliente=?
            ORDER BY D.Activo DESC');
  
            $pre=mysqli_prepare($con,$sql);
  
            if($pre)
            {
              //Paso 4.2: Vincular los Parametros
              mysqli_stmt_bind_param($pre, "s", $codCli);
    
              //paso 5: Ejecutar la consulta
              mysqli_stmt_execute($pre);
              //Paso 6: Guardamos los campos obtenidos a la tabla
              //Las variables deben coincidir con los nombres de la tabla
              mysqli_stmt_bind_result($pre, $dCompleta, $idDireccion);
            }
      ?>
             <?php if(!empty($message)): ?>
              <p id="p-registro"> <?= $message ?></p>
              <?php endif; ?>
              <form class="form" method="POST" action="../validaciones/validardireccion.php">
              <div class="form-group">
                      <select class="form-control" name="selDireccion" id="selDireccion">
                        <!--<option value="0">Establezca una direccion de envio como predeterminada</option>-->
                        <?php
                        while(mysqli_stmt_fetch($pre))
                        {
                          echo " <option value=\"$idDireccion\">".$dCompleta."</option>";
                        }
                        ?>
                      </select>
              </div>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="btnEnviar" id="btnEnviar" value="Cambiar Direccion Predeterminada">
              </div>
              </form>
      <?php

          }
      ?>
    
    <p>
      <a href="direccion.php" id="a-direcciones">Añadir una direccion</a> | <a href="editar_direccion.php" id="a-direcciones">Editar direccion</a> | <a href="eliminar_direccion.php" id="a-direcciones">Eliminar direccion</a>
    </p>
    <div id="direcciones-volver">
          <a href="menucuenta.php" class="btn btn-gris">Volver al Menu</a>
    </div>
    
    
  </main>
  <?php
      include 'footer.php';
  ?>
  <?php
        mysqli_stmt_close($pre);
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
      var validado=true;

      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"margin-top":"29%",
                            "background-color":"#6c757d",
                            "color":"#fff"});

      $("#btnEnviar").click(function(){
        if($("#selDireccion").val()==0)
        {
          validado=false;
          alert("Debe seleccionar una de las direcciones");
					event.preventDefault();
					
        }
        return validado;
      });

        
    });
  </script>

</body>

</html>