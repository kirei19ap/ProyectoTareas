<?php
      
     $conexion = mysqli_connect("host", "usuario", "clave", "base"); {
      
         
          $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
          if ($linkConexion!=false)  //si existe la devuelve
              return $linkConexion;
          else  
              die ('No se pudo establecer la conexión.');
      
      }





?>


    


