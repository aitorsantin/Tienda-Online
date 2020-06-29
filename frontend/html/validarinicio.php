<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio 6</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>


</head>
<body>
	<?php
		if(isset($_POST["btnSubmit"]))
		{
			$username=$_POST["txtUsername"];
			$email=$_POST["txtEmail"];
			$pass=$_POST["txtPass"];
			$confirm=$_POST["txtconfirm"];

			echo "<p>El usuario es".$username."</p>"
		}

	?>	

	<p>El usuario es: </p>

	<script>
		$(document).ready(function()
		{
		
		});

	

		
	</script>
</body>
</html>