<!--Elegir direccion de envio -->
<?php
  session_start();

      if(isset($_POST['btnEnviar']))
      {
          if(validarFormuario()==true)
          {
            $message = "";
            
            include "../../db/conexion.php"; 
            $con=mysqli_connect($host, $usuario, $password, $db);

            desactivarDirecciones($con);


            $sql=("UPDATE direccion
            SET Activo =  1
            WHERE idDireccion  =?");
            
            $pre=mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($pre, 'i', $opcion);
            if (mysqli_stmt_execute($pre))
            {
                
              $message = "Direccion Asignada";
            }
            else
            {
              $message = 'No se ha podido asignar la direccion';
            }
            mysqli_stmt_close($pre);
            
            header("Location: ../html/direcciones.php");
          }
      }
?>

<?php
  function desactivarDirecciones($con)
  {
    $username = $_SESSION["login"];
    $id="";

    $consulta=("SELECT c.idCliente
    FROM clientes AS c
    JOIN registrologin as r
    on r.idRegistro=c.idRegistro
    WHERE r.Username=?");

    $pro=mysqli_prepare($con,$consulta);

    if($pro)
    {
      mysqli_stmt_bind_param($pro, "s", $username);
      mysqli_stmt_execute($pro);
      mysqli_stmt_bind_result($pro, $idCliente);

    }

    while(mysqli_stmt_fetch($pro))
    {
      $id=$idCliente;
    }
   
    $procedimiento=("CALL pr_desactivarDireccion('".$id."')");
    mysqli_query($con, $procedimiento);
   
  }
?>

<?php
      function validarFormuario()
      {
        global $error, $opcion;
        $valida=TRUE;
        $error="";

        if (empty($_POST["selDireccion"])) 
        {
          $valida = FALSE;
            $error = '<p><label class="text-danger">Debe seleccionar un tipo de direccion</label></p>';
        }
        else
        {
          $opcion = limpiarCadenas($_POST['selDireccion']);
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