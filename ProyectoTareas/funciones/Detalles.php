<?php
function colorFilaPorTienda($tiendaNombre) {
    switch (strtolower($tiendaNombre)) {
        case 'icbc': return 'table-danger';     // rojo
        case 'clic': return 'table-secondary';  // gris
        case 'galicia': return 'table-warning'; // naranja
        case 'bapro': return 'table-success';   // verde
        default: return ''; // sin color especial
    }
}


function badgeEstado($estadoNombre) {
    switch (strtolower($estadoNombre)) {
        case 'concluido': return '<span class="badge bg-success">Concluido</span>';
        case 'demorado':  return '<span class="badge bg-warning">Demorado</span>';
        case 'cancelado': return '<span class="badge bg-danger">Cancelado</span>';
        case 'cambio':    return '<span class="badge bg-info">Cambio</span>';
        case 'garantía':  return '<span class="badge bg-primary">Garantía</span>';
        default: return '<span class="badge bg-secondary">'.$estadoNombre.'</span>';
    }
}

?>