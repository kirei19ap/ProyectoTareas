<?php
      
function ConexionBD() {
    $host = "containers-us-west-XX.railway.app"; // el host que te da Railway
    $usuario = "tu_usuario";                     // el usuario MySQL
    $clave = "tu_contraseña";                    // la contraseña
    $bd = "casostiendas";                        // el nombre de la base

    $conexion = mysqli_connect($host, $usuario, $clave, $bd);
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $conexion;
}

?>


    


