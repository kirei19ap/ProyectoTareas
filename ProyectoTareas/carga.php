<?php


require_once("../ProyectoTareas/funciones/bd.php");
require_once("../ProyectoTareas/funciones/funciones.php");


$conexionBD = ConexionBD();


require_once("../ProyectoTareas/lateral.php");
require_once("../ProyectoTareas/Encabezado.php");


$tiendas    = listarTiendas($conexionBD);
$estados    = listarEstados($conexionBD);
$subestados = listarSubEstados($conexionBD);


// Procesar formulario de nuevo caso
if(!empty($_POST['registrarCasoBTN'])){
    $tienda_id      = $_POST['tienda_id'];
    $referencia     = $_POST['referencia'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $descripcion    = $_POST['descripcion'];
    $guia_oca       = $_POST['guia_oca'];
    $estado_id      = $_POST['estado_id'];
    $sub_estado_id  = $_POST['sub_estado_id'];

    if(!empty($tienda_id) && $estado_id != -1){
        $resultado = guardarCaso($conexionBD, $tienda_id, $referencia, $nombre_cliente, $descripcion, $guia_oca, $estado_id, $sub_estado_id);
        if($resultado){
            $mensaje = '<i class="align-middle" data-feather="check-square"></i> Caso cargado correctamente.';
        }else{
            $mensaje = '<i class="align-middle me-2" data-feather="alert-circle"></i> No se pudo guardar el caso.';
        }
    }else{
        $mensaje = 'Los campos con <i class="align-middle me-2" data-feather="command"></i> son obligatorios';
    }
}

?>


<main class="content">
    <div class="container-fluid p-0">
        <form action="" method="POST">
            <div class="mb-3">
                <h1 class="h3 mb-3"><strong>Cargar nuevo</strong>  </h1>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-info">
                                <?php if(isset($mensaje)){ echo $mensaje; } ?>
                            </h4>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Tienda <i class="align-middle me-2" data-feather="command"></i></h5>
                            <select class="form-select mb-3" name="tienda_id">
                                <option value="-1">Seleccionar tienda...</option>
                                <?php foreach ($tiendas as $tienda) { 
                                    $selected = (!empty($_POST['tienda_id']) && $_POST['tienda_id'] == $tienda['id']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $tienda['id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $tienda['nombre_tienda']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Referencia</h5>
                            <input type="text" class="form-control" name="referencia"
                                   value="<?php if (!empty($_POST['referencia'])) { echo $_POST['referencia']; } ?>">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Nombre cliente</h5>
                            <input type="text" class="form-control" name="nombre_cliente"
                                   value="<?php if (!empty($_POST['nombre_cliente'])) { echo $_POST['nombre_cliente']; } ?>">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Guía OCA</h5>
                            <input type="text" class="form-control" name="guia_oca"
                                   value="<?php if (!empty($_POST['guia_oca'])) { echo $_POST['guia_oca']; } ?>">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Descripción</h5>
                            <textarea class="form-control" name="descripcion" rows="2"><?php if (!empty($_POST['descripcion'])) { echo $_POST['descripcion']; } ?></textarea>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Estado <i class="align-middle me-2" data-feather="command"></i></h5>
                            <select class="form-select mb-3" name="estado_id">
                                <option value="-1">Seleccionar estado...</option>
                                <?php foreach ($estados as $estado) { 
                                    $selected = (!empty($_POST['estado_id']) && $_POST['estado_id'] == $estado['id']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $estado['id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $estado['nombre_estado']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-0">Subestado</h5>
                            <select class="form-select mb-3" name="sub_estado_id">
                                <option value="">Sin subestado</option>
                                <?php foreach ($subestados as $sub) { 
                                    $selected = (!empty($_POST['sub_estado_id']) && $_POST['sub_estado_id'] == $sub['id']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $sub['id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $sub['nombre_sub_estado']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary" name="registrarCasoBTN" value="RegistrarCaso" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>


<?php
    require_once("../FinalTP3/pie.php");
?>

</body>

</html>


