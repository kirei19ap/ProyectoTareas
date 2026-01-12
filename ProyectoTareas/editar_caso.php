<?php
require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");

$conexionBD = ConexionBD();

// Procesar edición si se envió el formulario
if (!empty($_POST['ModificarCasoBTN'])) {
    $idCaso       = $_POST['idCaso'];
    $tienda_id    = $_POST['tienda_id'];
    $referencia   = $_POST['referencia'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $descripcion  = $_POST['descripcion'];
    $guia_oca     = $_POST['guia_oca'];
    $estado_id    = $_POST['estado_id'];
    $sub_estado_id= $_POST['sub_estado_id'];

    if (EditarCaso($conexionBD, $idCaso, $tienda_id, $referencia, $nombre_cliente, $descripcion, $guia_oca, $estado_id, $sub_estado_id)) {
        header("Location: index.php?msg=" . urlencode("Caso actualizado correctamente"));
        exit;
    } else {
        $mensaje = "Error al actualizar el caso.";
    }
}

// Cargar datos del caso si se accede por GET
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $Caso = TraerCaso($conexionBD, $_GET['id']);
    $tiendas    = listarTiendas($conexionBD);
    $estados    = listarEstados($conexionBD);
    $subestados = listarSubEstados($conexionBD);
} else {
    header("Location: index.php?msg=" . urlencode("ID inválida"));
    exit;
}

require_once("../ProyectoTareas/lateral.php");
require_once("../ProyectoTareas/Encabezado.php");
?>

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Editar caso</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-danger"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="idCaso" value="<?php echo $Caso['id']; ?>">

            <div class="card">
                <div class="card-body">
                    <label>Tienda:</label>
                    <select name="tienda_id" class="form-select">
                        <?php foreach ($tiendas as $t): 
                            $selected = ($t['id'] == $Caso['tienda_id']) ? 'selected' : ''; ?>
                            <option value="<?php echo $t['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $t['nombre_tienda']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="mt-3">Referencia:</label>
                    <input type="text" class="form-control" name="referencia"
                           value="<?php echo htmlspecialchars($Caso['referencia']); ?>">

                    <label class="mt-3">Nombre cliente:</label>
                    <input type="text" class="form-control" name="nombre_cliente"
                           value="<?php echo htmlspecialchars($Caso['nombre_cliente']); ?>">

                    <label class="mt-3">Descripción:</label>
                    <textarea class="form-control" name="descripcion"><?php echo htmlspecialchars($Caso['descripcion']); ?></textarea>

                    <label class="mt-3">Guía OCA:</label>
                    <input type="text" class="form-control" name="guia_oca"
                           value="<?php echo htmlspecialchars($Caso['guia_oca']); ?>">

                    <label class="mt-3">Estado:</label>
                    <select name="estado_id" class="form-select">
                        <?php foreach ($estados as $e): 
                            $selected = ($e['id'] == $Caso['estado_id']) ? 'selected' : ''; ?>
                            <option value="<?php echo $e['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $e['nombre_estado']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="mt-3">Subestado:</label>
                    <select name="sub_estado_id" class="form-select">
                        <option value="">Sin subestado</option>
                        <?php foreach ($subestados as $s): 
                            $selected = ($s['id'] == $Caso['sub_estado_id']) ? 'selected' : ''; ?>
                            <option value="<?php echo $s['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $s['nombre_sub_estado']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" name="ModificarCasoBTN" value="1" class="btn btn-primary mt-3">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require_once("pie.php"); ?>