<?php
    include "../../db/conexion.php";

    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno()){
        echo "Error al conectar con la base de datos";
        exit(); 
      }

    $idCesta=$_POST["idCesta"];
    $envio=$_POST["envio"];

    $sql="call pr_insertarCabeceraPedido(?,?)";

    $procedure=mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($procedure, 'ii', $idCesta, $envio);

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