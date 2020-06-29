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
    if(isset($_POST['btnSubmit']))
    {
      $username=$_SESSION["login"];

      if (validarFormulario()==TRUE)
      {
       
        include "../../db/conexion.php"; 
        $con=mysqli_connect($host, $usuario, $password, $db);
      
        $sql=("CALL pr_AltaDireccion(?,?,?,?,?,?);");
        $procedure=mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($procedure, 'ssssss', $username, $direccion, $cp, $poblacion, $provincia, $opcion);
				

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
      } 
      else{
        echo "<p>No se ha validado correctamente<p/>";
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
      }
      else
      {
        $direccion = limpiarCadenas($_POST['txtDireccion']);
      }

      if (empty($_POST["txtCp"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">El codigo postal no puede estar vacio</label></p>';
      }
      else
      {
        $cp = limpiarCadenas($_POST['txtCp']);
      }

      if (empty($_POST["txtPoblacion"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">La poblacion no puede estar vacia</label></p>';
      }
      else
      {
        $poblacion = limpiarCadenas($_POST['txtPoblacion']);
      }

      if (empty($_POST["txtProvincia"])) 
      {
        $valida = FALSE;
        $error = '<p><label class="text-danger">La provincia no puede estar vacia</label></p>';
      }
      else
      {
        $provincia = limpiarCadenas($_POST['txtProvincia']);
      }

      if (empty($_POST["selOpciones"])) 
      {
        $valida = FALSE;
          $error = '<p><label class="text-danger">Debe seleccionar un tipo de direccion</label></p>';
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
  </header>
  <main class="container">
  <?php if(!empty($message)): ?>
      <p id="p-registro"> <?= $message ?></p>
    <?php endif; ?>
    <form class="form" method="POST" action="direccion.php">
        <div class="form-group">
            <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direccion">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" id="txtCp" name="txtCp" placeholder="Codigo Postal">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="txtPoblacion" name="txtPoblacion" placeholder="Poblacion">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="txtProvincia" name="txtProvincia" placeholder="Provincia">
        </div>
        <div class="form-group">
            <select class="form-control" id="selOpciones" name="selOpciones">
                <option value="0">Seleccione el tipo de direccion</option>
                <option value="1">Direccion de entrega</option>
                <option value="2">Direccion de facturacion</option>
                <option value="3">Entrega y facturacion</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Guardar">
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
      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"margin-top":"23%",
                            "background-color":"#6c757d",
                            "color":"#fff"});

      var valido=true;

      $("#btnSubmit").click(function(){
        if ($("#txtDireccion").val()=="") 
        {
          alert("Debe introducir la Direccion");
          valido=false;
          event.preventDefault();
        }
        if($('#txtCp').val()=="")
        {
          alert("Debe introducir el Codigo Postal");
          valido=false;
          event.preventDefault();
        }
        if($('#txtPoblacion').val()=="")
        {
          alert("Debe introducir la Poblacion");
          valido=false;
          event.preventDefault();
        }

        if($('#txtProvincia').val()=="")
        {
          alert("Debe introducir la Provincia");
          valido=false;
          event.preventDefault();
        }
        if($('#selOpciones').val()=="0")
        {
          console.log($('#selOpciones option').val());
          alert("Debe seleccionar una de las opciones");
          valido=false;
          event.preventDefault();
        }

        return valido;

      });
    });
  </script>

</body>

</html>