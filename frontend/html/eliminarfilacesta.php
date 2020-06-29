<?php
        include "../../db/conexion.php";   
  ?>
<?php
    $idCesta=$_GET["idCesta"];
    $codArticulo=$_GET["codArticulo"];

    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno())
    {
     echo "Error al conectar con la base de datos";
     exit(); 
   }

   $sql="CALL pr_eliminarLineaCesta('".$idCesta."', '".$codArticulo."')";
   mysqli_query($con, $sql);
   header("Location: cesta.php");
   
   mysqli_close($con); 

    
?>