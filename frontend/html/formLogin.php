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
		if(isset($_POST["btnSubmit"]))
		{
			if (validarFormulario()==TRUE) 
			{
				$message = '';

				include "../../db/conexion.php";  

				$con=mysqli_connect($host, $usuario, $password, $db);

		        if(mysqli_connect_errno())
		        {
		          echo "Error al conectar con la base de datos";
		          exit(); 
		        }

		        $select="SELECT idRegistro, Email, Password, Username FROM registrologin WHERE Email=?";

		        $pra=mysqli_prepare($con, $select);

		        if ($pra) 
		        {
		        	mysqli_stmt_bind_param($pra, "s", $email);

		        	mysqli_stmt_execute($pra);

		        	mysqli_stmt_bind_result($pra, $idRegistro, $Email, $Password, $Username);
		        }

		        while (mysqli_stmt_fetch($pra)) 
		        {
		        	if (password_verify($pass, $Password)) 
		        	{
		        		session_start();

		        		$_SESSION["login"]=$Username;

		        		header("Location: ../index.php");
		        	}
		        	else
		        	{
		        		$message = 'Usuario y/o Contraseña incorrectos';

		        	}
		        	
		        }

		       

		        mysqli_stmt_close($pra);
		        mysqli_close($con);

			}
		}


		function validarFormulario()
		{
			global $error, $email, $pass;
			$valida=true;

			if(empty($_POST["txtEmail"]))
			{
				$valida = FALSE;
    			$error = '<p><label class="text-danger">El email no puede estar vacío</label></p>';
    			return $valida;
			}
			else
			{
				$email=limpiarCadenas($_POST['txtEmail']);
			}

			if (empty($_POST["txtPass"])) 
			{
				$valida=FALSE;
				$error = '<p><label class="text-danger">El password no puede estar vacío</label></p>';
				return $valida;
			}
			else
			{
				$pass=limpiarCadenas($_POST["txtPass"]);


			}
			return $valida;
		}

		function limpiarCadenas($cadena)
		{
			/*Quitar espacios*/
			$cadena = trim($cadena);
			/*Quitar barras y contra barras*/
			$cadena = stripslashes($cadena);
			/*convertir caracteres especiales a caracteres html*/
			$cadena = htmlspecialchars($cadena);

			return $cadena;
		}

	?>	

	<?php if(!empty($message)): ?>
      <p id="p-login"> <?= $message ?></p>
    <?php endif; ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="form-login login100-form validate-form" method="POST" action="formLogin.php">
					<span class="login100-form-title p-b-33">
						Iniciar Sesion
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" id="txtEmail" name="txtEmail" placeholder="Email" required>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="txtPass" name="txtPass" placeholder="Password" required>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
			            <input id="btnSubmit" name="btnSubmit" type="submit" class="btn btn-lg btn-block" value="Iniciar Sesion">
			            <input type="reset" id="btnReset" name="btnReset" class="btn-negro btn-lg btn-block" value="Cerrar">
					</div>
					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Crear Cuenta:
						</span>

						<a href="register.php" class="txt2 hov1">
							Crear Cuenta
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

	<script>
		$(document).ready(function()
		{
			var validado=true;

			$("#btnSubmit").click(function()
			{
				if ($("#txtEmail").val()=="") 
				{
					alert("Debe introducir el email");
						valido=false;
				}

				if ($("#txtPass").val()=="") 
				{
					alert("Debe introducir la contraseña");
						valido=false;

				}
				
				if (validado==true)
				{
					return true;
				}
				else
				{
					event.preventDefault();
					return false;
				}
			});

		});
	</script>

</body>
</html>