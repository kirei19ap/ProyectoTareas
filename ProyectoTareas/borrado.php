<?php
require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");


$conexionBD = ConexionBD();

if (eliminarCaso($conexionBD, $_GET['id'])) {
    $mensaje = "El caso ha sido eliminado correctamente.";
} else {
    $mensaje = "Error al eliminar el caso.";
}
header('Location: index.php?msg=' . urlencode($mensaje));
exit;


?>
