<?php
      
      function ConexionBD($Host = 'localhost', $User = 'root', $Password = '', $BaseDeDatos = 'casostiendas') {
      
         
          $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
          if ($linkConexion!=false)  //si existe la devuelve
              return $linkConexion;
          else  
              die ('No se pudo establecer la conexión.');
      
      }





?>


    


