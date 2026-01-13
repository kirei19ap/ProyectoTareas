<?php
require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");   // ← acá está listarCasos()
require_once("../ProyectoTareas/funciones/Buscador.php");
require_once("../ProyectoTareas/funciones/Reporte.php"); // tu función ExportarPDF

$conexionBD = ConexionBD();

// ¿Hay búsqueda activa?
$Listado = [];
if (!empty($_GET['buscar'])) {
    $Listado = BuscarCasos($conexionBD, $_GET['buscar']);
} else {
    $Listado = listarCasos($conexionBD); // ahora sí existe
}

// Generar PDF
ExportarPDF($Listado);

// Redirigir al archivo generado
header("Location: exportaciones/casos.pdf");
exit;