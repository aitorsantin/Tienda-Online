<?php
    include "../../db/conexion.php";

    $con=mysqli_connect($host, $usuario, $password, $db);

    if(mysqli_connect_errno()){
        echo "Error al conectar con la base de datos";
        exit(); 
      }

    $idDireccion=$_POST["idDireccion"];

    $sql="SELECT idDireccion, Direccion, CP, Poblacion, Provincia, tipoDireccion
    from Direccion
    WHERE idDireccion='".$idDireccion."'";

    if($resultado=mysqli_query($con, $sql))
    {
        $fila=mysqli_fetch_assoc(($resultado));
        $idDireccion=$fila['idDireccion'];
        $direccion=$fila['Direccion'];
        $cp=$fila['CP'];
        $poblacion=$fila['Poblacion'];
        $provincia=$fila['Provincia'];
        $tipo=$fila['tipoDireccion'];

        $json[]=array('idDireccion'=> $idDireccion,'direccion' => $direccion, 'cp' => $cp, 'poblacion' => $poblacion, 'provincia' => $provincia, 'tipo' => $tipo);
        
        mysqli_close($con);

        echo json_encode($json);
    }
    exit;

?>