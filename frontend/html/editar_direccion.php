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
      if (validarFormulario()==TRUE)
      {
        include "../../db/conexion.php"; 
        $con=mysqli_connect($host, $usuario, $password, $db);
        
        $idDireccion=$_POST["txtIdDireccion"];

        
        if($opcion==1)
        {
          $opcion='envio';
        }
        if($opcion==2)
        {
          $opcion="facturacion";
        }
        if($opcion==3)
        {
          $opcion='ambas';
        }

        $sql="UPDATE Direccion
        SET Direccion='$direccion', CP='$cp', Poblacion='$poblacion',  Provincia='$provincia', tipoDireccion='$opcion'
        WHERE idDireccion=$idDireccion";

        if(mysqli_query($con, $sql)){ 
          $message="Actualizacion realizada."; 
        } else { 
          $message= "ERROR: $sql. "  
                                  . mysqli_error($con); 
        }  
        mysqli_close($con); 
      }
      else
      {
        echo "No hemos validado";
      }
    }
  ?>
  <?php
    function validarFormulario()
    {
      global $error, $direccion, $cp, $poblacion, $provincia, $opcion;
      $valida=TRUE;
      $error="";
  
      if (empty($_POST["txtDireccion"])) 
      {
        $valida = FALSE;
        $error = '<p><label class="text-danger">La direccion no puede estar vacia</label></p>';
        echo "No valido la direccion";
      }
      else
      {
        $direccion = limpiarCadenas($_POST['txtDireccion']);
        
      }

      if (empty($_POST["txtCp"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">El codigo postal no puede estar vacio</label></p>';
          echo "No valido el codigo postal";
      }
      else
      {
        $cp = limpiarCadenas($_POST['txtCp']);
      }

      if (empty($_POST["txtPoblacion"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">La poblacion no puede estar vacia</label></p>';
          echo "No valido la poblacion";
      }
      else
      {
        $poblacion = limpiarCadenas($_POST['txtPoblacion']);
      }

      if (empty($_POST["txtProvincia"])) 
      {
        $valida = FALSE;
        $error = '<p><label class="text-danger">La provincia no puede estar vacia</label></p>';
        echo "No valido la provincia";
      }
      else
      {
        $provincia = limpiarCadenas($_POST['txtProvincia']);
      }

      if (empty($_POST["selOpciones"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">Debe seleccionar un tipo de direccion</label></p>';
          echo "No valido el combobox";
      }
      else
      {
        $opcion = limpiarCadenas($_POST['selOpciones']);
      }
      
      return $valida;
  
    }
  ?>
  <?php
    function limpiarCadenas($cadena)
    {	
      $cadena = trim($cadena);
      /*Quitar barras y contra barras*/
      $cadena = stripslashes($cadena);
      /*convertir caracteres especiales a caracteres html*/
      $cadena = htmlspecialchars($cadena);
  
      return $cadena;
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
        <input type="hidden" id="txtIdDireccion" name="txtIdDireccion">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion" readonly>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" id="txtCp" name="txtCp" placeholder="Codigo Postal" readonly>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="txtPoblacion" name="txtPoblacion" placeholder="Poblacion" readonly>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="txtProvincia" name="txtProvincia" placeholder="Provincia" readonly>
    </div>
    <div class="form-group">
        <select class="form-control" id="selOpciones" name="selOpciones" readonly>
            <option value="0">Seleccione el tipo de direccion</option>
            <option value="1">Direccion de entrega</option>
            <option value="2">Direccion de facturacion</option>
            <option value="3">Entrega y facturacion</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Actualizar">
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
      $("#pie-pagina").css({"margin-top":"20%",
                            "background-color":"#6c757d",
                            "color":"#fff"});

    $("#selDireccion").change(function()
    {
      valor = $("#selDireccion option:selected").val();
      console.log(valor);

      if(valor==0)
      {
        alert("Debe seleccionar una direccion");

        //Poner los textbox como readonly
        $("#txtDireccion").attr("readonly", true); 
        $("#txtCp").attr("readonly", true); 
        $("#txtPoblacion").attr("readonly", true); 
        $("#txtProvincia").attr("readonly", true); 
        $("#selOpciones").attr("readonly", true); 

        //Limpiar el contenido
        $("#txtDireccion").val("");
        $("#txtCp").val("");
        $("#txtPoblacion").val("");
        $("#txtProvincia").val("");
        $("#selOpciones option").removeAttr("selected");
        $("#selOpciones option[value=0]").attr({selected: true});


      }
      if(valor!=0)
      {
        $("#txtDireccion").attr("readonly", false); 
        $("#txtCp").attr("readonly", false); 
        $("#txtPoblacion").attr("readonly", false); 
        $("#txtProvincia").attr("readonly", false); 
        $("#selOpciones").attr("readonly", false); 

        //Cargar elementos
        $.ajax({
          url: "optenerdirecciones.php",
          type: "POST",
          ASYNC: true,
          data: {idDireccion: valor},
          success:function(respuesta)
				  {
            var objDireccion = JSON.parse(respuesta);
            idDireccion=objDireccion[0].idDireccion;
            direccion=objDireccion[0].direccion;
            cp=objDireccion[0].cp;
            poblacion=objDireccion[0].poblacion;
            provincia=objDireccion[0].provincia;
            tipo=objDireccion[0].tipo;

            $("#txtIdDireccion").val(idDireccion);
            $("#txtDireccion").val(direccion);
            $("#txtCp").val(cp);
            $("#txtPoblacion").val(poblacion);
            $("#txtProvincia").val(provincia);

            if(tipo=='envio')
            {
              $("#selOpciones option").removeAttr("selected");
              $("#selOpciones option[value=1]").attr({selected: true});
            }

            if(tipo=='facturacion')
            {
              $("#selOpciones option").removeAttr("selected");
              $("#selOpciones option[value=2]").attr({selected: true});
            }

            if(tipo=='ambas')
            {
              $("#selOpciones option").removeAttr("selected");
              $("#selOpciones option[value=3]").attr({selected: true});
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