<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tienda Online</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
	<?php
	$idRegistro="";
	if (isset($_POST["btnSubmit"])) 
	{
		if (validarFormulario()==TRUE) 
		{
			include "../../db/conexion.php"; 
			$con=mysqli_connect($host, $usuario, $password, $db);
			//insertar datos en la base de datos
			$fila=comprobarEmailyUsername($username, $email, $password, $con);

			if ($fila==0) 
			{	
				$sql=('CALL pr_Registro(?,?,?);');	

				$insertar=mysqli_prepare($con, $sql);
				$contrasena=password_hash($_POST['txtPass'], PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($insertar, 'sss', $email, $username, $contrasena);
				

				if (mysqli_stmt_execute($insertar))
				{
					$message = 'Registro realizado correctamente';
				}
				else
				{
					$message = 'No se pudo realizar el registro';
				}
				mysqli_stmt_close($insertar);
				mysqli_close($con);
			}
			else{
				$message2 = 'Error: El Username y/o el Email estan en uso!!';
			}
		}
		
	}
?>

<?php
		

	function comprobarEmailyUsername($username, $email, $password, $con)
	{
		include "../../db/conexion.php"; 

		$con=mysqli_connect($host, $usuario, $password, $db);

		if(mysqli_connect_errno())
		{
			echo "Error al conectar con la base de datos";
			exit(); 
		}

		$sql="SELECT Username, Email
			FROM registrologin
			WHERE Username='$username' OR Email='$email'";

		$pre=mysqli_query($con,$sql);

		$fila=mysqli_num_rows($pre);

		return $fila;	

	}

	function validarFormulario()
	{
		global $error, $username, $email, $password, $confirm;
		$valida=TRUE;
		$error="";

		if (empty($_POST["txtUsername"])) 
		{
			$valida = FALSE;
    		$error = '<p><label class="text-danger">El username no puede estar vacío</label></p>';
		}
		else
		{
			//Si la variable no esta vacia llamamos a la funcion limpiar cadenas para que revise el contenido de la variable
			$username = limpiarCadenas($_POST['txtUsername']);
		}

		if (empty($_POST["txtEmail"])) 
		{
			$valida = FALSE;
    		$error = '<p><label class="text-danger">El email no puede estar vacío</label></p>';
		}
		else
		{
			$email = limpiarCadenas($_POST['txtEmail']);
		}

		if (empty($_POST["txtPass"])) 
		{
			$valida = FALSE;
    		$error = '<p><label class="text-danger">El password no puede estar vacío</label></p>';
		}
		else
		{
			$password=limpiarCadenas($_POST["txtPass"]);
		}

		if (empty($_POST["txtconfirm"])) 
		{
			
			$valida = FALSE;
    		$error = '<p><label class="text-danger">El password no puede estar vacío</label></p>';
		}
		else
		{
			$confirm=limpiarCadenas($_POST["txtconfirm"]);
		}
		return $valida;

	}

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

	<?php if(!empty($message)): ?>
      <p id="p-registro"> <?= $message ?></p>
    <?php endif; ?>
	<?php if(!empty($message2)): ?>
      <p id="p-comprobarCU"> <?= $message2 ?></p>
    <?php endif; ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method="POST" action="register.php">
					<span class="login100-form-title p-b-33">
						Formulario de Registro
					</span>
					<div class="form-group col-12">
						<input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" required>
						<span id="spUser"></span>
					</div>
					<div class="form-group col-12">
						<input type="email" id="txtEmail" class="form-control"name="txtEmail" placeholder="Email" required>
						<span id="spEmail"></span>
					</div>
					<div class="form-group col-12">
						<input type="password" id="txtPass" class="form-control" name="txtPass" placeholder="Password" required>
						<span id="spPass"></span>
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
					<div class="form-group col-12">
						<input type="password" id="txtconfirm" class="form-control" name="txtconfirm" placeholder="Confirm Password" required>
						<span id="spConfirm"></span>
					</div>
					<div class="form-group col-12">
						<input type="submit" name="btnSubmit" id="btnSubmit" class="btn  btn-lg btn-block" value="Crear Cuenta">
						<input type="reset" class="btn btn-negro btn-lg btn-block">
					</div>
					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Iniciar Sesión:
						</span>

						<a href="formLogin.php" class="txt2 hov1">
							Iniciar Sesión
						</a>
						<br/>
						<span class="txt1">
							Volver al inicio:
						</span>
						<a href="../index.php" class="txt2 hov1">
							Volver al inicio
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

	<script src="../js/form.js"></script>

	<script>
		$(document).ready(function()
		{
			var valido=true;
			var regContrasena = new RegExp(" ^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$");
			var m = document.getElementById("txtPass").value;
			
			$("#btnSubmit").click(function(){
				if ($("#txtUsername").val()=="") 
				{
					alert("Debe introducir el nombre de usuario");
					valido=false;
					event.preventDefault();
				}
				if ($("#txtEmail").val()=="") 
				{
					alert("Debe introducr su correo electronico");
					valido=false;
					event.preventDefault();
				}
				if ($("#txtPass").val()=="") 
				{
					alert("Debe introducr la contraseña");
					valido=false;
					event.preventDefault();
				}
				if ($("#txtconfirm").val()=="") 
				{
					alert("Debe introducr la contraseña");
					valido=false;
					event.preventDefault();
				}
				if ($("#txtconfirm").val()!=$("#txtPass").val()) 
				{
					alert("Las contraseñas no coinciden");
					valido=false;
					event.preventDefault();
				}

				return valido;
			});

			comprobarContraseña();
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