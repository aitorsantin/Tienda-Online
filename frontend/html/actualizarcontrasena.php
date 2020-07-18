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

        $contrasena=password_hash($_POST['txtPassword'], PASSWORD_DEFAULT);
       
        $sql="UPDATE registrologin SET Password ='$contrasena' WHERE Username ='$username'";

        mysqli_query($con, $sql);

        $message = 'Contraseña Actualizada';

      }
      else
      {
        $message = 'No pudimos actualizar la contraseña';
      }
    }
  ?>
  <?php
    function validarformulario()
    {
        global $error,  $password, $confirm;
        $valida=TRUE;
        $error="";

        if (empty($_POST["txtPassword"])) 
        {
          $valida=false;
          $error = '<p><label class="text-danger">El campo Nombre no puede estar vacio</label></p>';
        }
        else
        {
          $password=limpiarCadenas($_POST['txtPassword']);
        }

        if (empty($_POST["txtConfirm"])) 
        {
          $valida=false;
          $error='<p><label class="text-danger">El campo Apellido no puede estar vacio</label></p>';
        }
        else
        {
          $confirm=limpiarCadenas($_POST['txtConfirm']);
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
  <main>
  <?php if(!empty($message)): ?>
      <p id="p-registro"> <?= $message ?></p>
    <?php endif; ?>
      <form class="form" method="POST" action="actualizarcontrasena.php">
        <div class="form-group">
        <label for="txtPassword">Nueva Contraseña:</label>
            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
        </div>
        <div id="pswd_info">
						<h4>La contraseña debe cumplir los siguientes requisitos</h4>
						<ul>
						<li id="letter" class="invalid">Al menos <strong>una letra</strong>
						</li>
						<li id="capital" class="invalid">Al menos <strong>una letra Mayuscula</strong>
						</li>
						<li id="number" class="invalid">Al menos <strong>un Numero</strong>
						</li>
						<li id="length" class="invalid">La contraseña debe contener <strong>minimo 8 caracteres</strong>
						</li>
						</ul>
				</div>
        <div class="form-group">
        <label for="txtConfirm">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="txtConfirm" name="txtConfirm">
        </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" value="Cambiar Contraseña">
            <a href="account.php" class="btn btn-gris">Volver a los datos de la cuenta</a>
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
      comprobarContraseña();

      $("#mainNav").removeClass("fixed-top");
      $("#pie-pagina").css({"margin-top":"26%",
                            "background-color":"#6c757d",
                            "color":"#fff"});

      var validado=true;

      $("#btnSubmit").click(function()
      {
        
        if ($("#txtPassword").val()=="") 
        {
          alert("Debe introducir la Contraseña");
          valido=false;
          event.preventDefault();
        }
        if ($("#txtConfirm").val()=="") 
        {
          alert("Debe confirmar la Contraseña");
          valido=false;
          event.preventDefault();
        }

        if ($("#txtConfirm").val()!=$("#txtPassword").val()) 
        {
          alert("Las contraseñas no coinciden");
          valido=false;
          event.preventDefault();
        }
        return valido;

      });

    });

    function comprobarContraseña()
		{
			var longitud = false,
            minuscula = false,
            numero = false,
            mayuscula = false;
			$('input[type=password]').keyup(function() {
				var pswd = $(this).val();
				if (pswd.length < 8) {
				$('#length').removeClass('valid').addClass('invalid');
				longitud = false;
				} else {
				$('#length').removeClass('invalid').addClass('valid');
				longitud = true;
				}

				//validate letter
				if (pswd.match(/[A-z]/)) {
				$('#letter').removeClass('invalid').addClass('valid');
				minuscula = true;
				} else {
				$('#letter').removeClass('valid').addClass('invalid');
				minuscula = false;
				}

				//validate capital letter
				if (pswd.match(/[A-Z]/)) {
				$('#capital').removeClass('invalid').addClass('valid');
				mayuscula = true;
				} else {
				$('#capital').removeClass('valid').addClass('invalid');
				mayuscula = false;
				}

				//validate number
				if (pswd.match(/\d/)) {
				$('#number').removeClass('invalid').addClass('valid');
				numero = true;
				} else {
				$('#number').removeClass('valid').addClass('invalid');
				numero = false;
				}
			}).focus(function() {
				$('#pswd_info').show();
			}).blur(function() {
				$('#pswd_info').hide();
			});

			$("#registro").submit(function(event) {
				alert("hola");
				if(longitud && minuscula && numero && mayuscula){
				alert("password correcto");
				$("#registro").submit();
				
				}else{
				alert("Password invalido.");
				event.preventDefault();
				}
				
			});
		}
  </script>

</body>

</html>