<?php


require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");
require_once("../ProyectoTareas/funciones/Detalles.php");

$conexionBD = ConexionBD();
$casos = listarCasos($conexionBD);

require_once("../ProyectoTareas/lateral.php");
require_once("../ProyectoTareas/Encabezado.php");

?>

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Casos Por Tiendas.</strong> </h1>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h4 class="text-info">Visualizando<?php echo count($casos); ?>  registros activos </h4>
                        <hr />
    
                    </div>

                    <table class="table table-hover my-0">
                        
                 <thead>
                    <tr>
                    <th>#</th>
                    <th>Tienda</th>
                    <th>Ref</th>
                    <th>Nombre cliente</th>
                    <th>Descripcion</th>
                    <th>Fechas</th>
                    <th>guia OCA</th>
                    <th>Estado</th>
                    <th>Sub Estado</th>
                    <th>Acciones</th>


                    </tr>
                </thead>
                 <tbody>
<?php if ($casos && count($casos) > 0): ?>
<?php foreach ($casos as $c): ?>
    <tr class="<?php echo colorFilaPorTienda($c['tienda']); ?>">
        <td><?php echo $c['id']; ?></td>
        <td><?php echo htmlspecialchars($c['tienda']); ?></td>
        <td><?php echo htmlspecialchars($c['referencia']); ?></td>
        <td><?php echo htmlspecialchars($c['nombre_cliente']); ?></td>
        <td><?php echo htmlspecialchars($c['descripcion']); ?></td>
        <td>
            Creado: <?php echo $c['fecha_creacion']; ?><br>
            Actualizado: <?php echo $c['fecha_actualizacion']; ?>
        </td>
        <td><?php echo htmlspecialchars($c['guia_oca']); ?></td>
        <td><?php echo badgeEstado($c['estado']); ?></td>
        <td><?php echo htmlspecialchars($c['sub_estado']); ?></td>
        <td>
            <a class="btn btn-primary btn-sm" href="editar_caso.php?id=<?php echo $c['id']; ?>">Editar</a>
            <a class="btn btn-danger btn-sm"
               onclick="return confirm('¿Eliminar caso?')"
               href="borrado.php?id=<?php echo $c['id']; ?>">Borrar</a>
        </td>
    </tr>
<?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="10" class="text-center text-muted">No existen registros para mostrar</td>
    </tr>
<?php endif; ?>
</tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</main>

<?php
    require_once("../FinalTP3/pie.php");
?>

</body>

</html>

