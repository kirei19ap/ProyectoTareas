<?php
require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");
require_once("../ProyectoTareas/funciones/Detalles.php");
require_once("../ProyectoTareas/funciones/Buscador.php");

$conexionBD = ConexionBD();

// --- lógica de búsqueda ---
$Resultados = array();
$BusquedaActiva = false;
$Texto = "";

if (!empty($_POST['buscar'])) {
    $BusquedaActiva = true;
    $Texto = $_POST['buscar'];
    $Resultados = BuscarCasos($conexionBD, $Texto);
}

// listado normal
$casos = listarCasos($conexionBD);

require_once("../ProyectoTareas/lateral.php");
require_once("../ProyectoTareas/Encabezado.php");
?>

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Casos Por Tiendas.</strong></h1>

   <form method="POST" class="mb-3">
    <div class="d-flex align-items-center gap-2">
        <input type="text"
               name="buscar"
               placeholder="Buscar caso, tienda o cliente"
               class="form-control"
               style="width: 40%;"
               value="<?php echo htmlspecialchars($Texto); ?>">

        <input type="submit" value="Buscar" class="btn btn-primary">

        <a href="generar_pdf.php<?php echo $BusquedaActiva ? '?buscar='.urlencode($Texto) : ''; ?>"
           target="_blank"
           class="btn btn-danger">Generar PDF</a>
    </div>
</form>
<!-- target="_blank" ------ me abre otra pestaña --> 


        </form>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <?php if ($BusquedaActiva): ?>
                            <h4 class="text-info">Resultados encontrados: <?php echo count($Resultados); ?></h4>
                        <?php else: ?>
                            <h4 class="text-info">Visualizando <?php echo count($casos); ?> registros activos</h4>
                        <?php endif; ?>
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
                                <th>Guía OCA</th>
                                <th>Estado</th>
                                <th>Sub Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $contador = 0;
                        $ListadoActual = $BusquedaActiva ? $Resultados : $casos;

                        if (!empty($ListadoActual)) {
                            foreach ($ListadoActual as $c) {
                                $contador++;
                        ?>
                            <tr class="<?php echo colorFilaPorTienda($c['tienda']); ?>">
                                <td><?php echo $contador; ?></td>
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
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="10" class="text-center text-muted">No existen registros para mostrar</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>




<?php require_once("../ProyectoTareas/pie.php"); ?>
</body>
</html>