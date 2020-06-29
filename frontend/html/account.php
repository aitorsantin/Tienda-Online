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
    if (isset($_POST["btnSubmit"]))
    {
      $username=$_SESSION["login"];

      if (validarformulario()==TRUE) 
      {
        include "../../db/conexion.php"; 
        $con=mysqli_connect($host, $usuario, $password, $db);
       
        $sql="CALL pr_ActualizarDatosPersonales('".$username."','".$email."', '".$nombre."', '".$apellido."','".$segundo."', '".$cif."', '".$telefono."')";
        mysqli_query($con, $sql);

        $message = 'Datos personales actualizados';

      }
      else
      {
        $message = 'Los datos no se an validado';
      }
    }
  ?>
  <?php
    function validarformulario()
    {
        global $error, $nombre, $apellido, $segundo, $cif, $email, $telefono, $password, $confirm;
        $valida=TRUE;
        $error="";

        if (empty($_POST["txtNombre"])) 
        {
          $valida=false;
          $error = '<p><label class="text-danger">El campo Nombre no puede estar vacio</label></p>';
        }
        else
        {
          $nombre=limpiarCadenas($_POST['txtNombre']);
        }

        if (empty($_POST["txtApellido"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo Apellido no puede estar vacio</label></p>';
        }
        else
        {
          $apellido=limpiarCadenas($_POST['txtApellido']);
        }

         if (empty($_POST["txtSegunAp"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo Segundo Apellido no puede estar vacio</label></p>';
        }
        else
        {
          $segundo=limpiarCadenas($_POST['txtSegunAp']);
        }

         if (empty($_POST["txtDNI"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo DNI no puede estar vacio</label></p>';
        }
        else
        {
          $cif=limpiarCadenas($_POST['txtDNI']);
        }

        if (empty($_POST["txtEmail"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo Email no puede estar vacio</label></p>';
        }
        else
        {
          $email=limpiarCadenas($_POST['txtEmail']);
        }

        if (empty($_POST["txtTelefono"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo Apellido no puede estar vacio</label></p>';
        }
        else
        {
          $telefono=limpiarCadenas($_POST['txtTelefono']);
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
     if (isset($_SESSION["login"])) 
      {
        $username = $_SESSION["login"];

         $con=mysqli_connect($host, $usuario, $password, $db);

         if(mysqli_connect_errno())
         {
          echo "Error al conectar con la base de datos";
          exit(); 
        }

        $sql="SELECT c.Nombre, c.Apellido, c.Segundo, c.CIF, r.Email, c.Telefono, c.idRegistro, r.Password
              FROM clientes as c
              JOIN registrologin as r
              ON r.idRegistro=c.idRegistro
              WHERE r.Username=?";

        $pre=mysqli_prepare($con,$sql);

        if($pre)
        {
           mysqli_stmt_bind_param($pre, "s", $username);

           mysqli_stmt_execute($pre);

           mysqli_stmt_bind_result($pre, $Nombre, $Apellido, $Segundo, $CIF, $Email, $Telefono, $idRegistro, $Password);
        }

        while(mysqli_stmt_fetch($pre))
        {
      
    

  ?>
  </header>
  <main>
  <?php if(!empty($message)): ?>
      <p id="p-registro"> <?= $message ?></p>
    <?php endif; ?>
      <form class="form" method="POST" action="account.php">
          <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <?php
              echo "<input type=\"text\" class=\"form-control\" id=\"txtNombre\" name=\"txtNombre\" required value=\"".$Nombre."\">";
            ?>
          </div>
          <div class="form-group">
            <label for="txtApellido">Primer Apellido:</label>
           <?php
              echo "<input type=\"text\" class=\"form-control\" id=\"txtApellido\" name=\"txtApellido\"  required value=\"".$Apellido."\">";
           ?>
          </div>
          <div class="form-group">
            <label for="txtSegunAp">Segundo Apellido:</label>
            <?php
              echo "<input type=\"text\" class=\"form-control\" id=\"txtSegunAp\" name=\"txtSegunAp\" value=\"".$Segundo."\" required>";
            ?>
          </div>
          <div class="form-group">
            <label for="txtDNI">DNI/CIF:</label>
            <?php
              echo "<input type=\"text\" class=\"form-control\" id=\"txtDNI\" name=\"txtDNI\" value=\"".$CIF."\" required>";
            ?>
          </div>
          <div class="form-group">
            <label for="txtTelefono">Telefono:</label>
            <?php
              echo "<input type=\"number\" name=\"txtTelefono\" class=\"form-control\" id=\"txtTelefono\" value=\"".$Telefono."\" required>";
            ?>
          </div>
          <div class="form-group">
            <label for="txtEmail">Email:</label>
            <?php
              echo "<input type=\"email\" class=\"form-control\" id=\"txtEmail\" name=\"txtEmail\" value=\"".$Email."\" required>";
            ?>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Actualizar">
            <a href="actualizarcontrasena.php" class="btn btn-secondary">Cambiar Contrasena</a>
          </div>
      </form>
  </main>
  <?php
      }
      mysqli_stmt_close($pre);
      //mysqli_close($con);
    }
  ?>
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
      $("#pie-pagina").css({"background-color":"#6c757d",
                            "color":"#fff",
                          "margin-top":"8%"});

      var validado=true;

      $("#btnSubmit").click(function()
      {
        if ($("#txtNombre").val()=="") 
        {
          alert("Debe introducir su Nombre");
          valido=false;
          event.preventDefault();
        }
        if ($("#txtApellido").val()=="") 
        {
          alert("Debe introducir su Primer Apellido");
          valido=false;
          event.preventDefault();
        }
        if ($("#txtSegunAp").val()="") 
        {
          alert("Debe introducir su Segundo Apellido");
          valido=false;
          event.preventDefault();
        }
        if ($("#txtDNI").val()=="") 
        {
          alert("Debe introducir su DNI o CIF");
          valido=false;
          event.preventDefault();
        }
        if($("#txtTelefono").val()=="")
        {
          alert("Debe introducir su Nº de Telefono");
          valido=false;
          event.preventDefault();
        }

        return valido;

      });

    });
  </script>

</body>

</html>