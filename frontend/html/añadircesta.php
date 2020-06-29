<?php
    
    include "../../db/conexion.php";

    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno()){
        echo "Error al conectar con la base de datos";
        exit(); 
      }

      $respuesta="";

      $idProducto=$_POST["codArticulo"];
      $cantidad=$_POST["cantidad"];
      $user=$_POST["username"];

      $con=mysqli_connect($host, $usuario, $password, $db);

      $sql=("CALL pr_añadirCesta(?,?,?);");
      $procedure=mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($procedure, 'iis', $idProducto, $cantidad, $user);

      if (mysqli_stmt_execute($procedure))
      {
        $respuesta="exito";
      }
      else
      {
        $respuesta="error";
      }

      echo $respuesta;
      
      mysqli_stmt_close($procedure);
				mysqli_close($con);
?>