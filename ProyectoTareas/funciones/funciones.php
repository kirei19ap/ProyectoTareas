<?php
//CASOS--------------------------------------------------------------------------------------------------------------------

//LISTAR CASO
function listarCasos($conexionBD) {
    $sql = "SELECT c.id, 
                   t.nombre_tienda AS tienda, 
                   c.referencia, 
                   c.nombre_cliente, 
                   c.descripcion,
                   c.fecha_creacion, 
                   c.fecha_actualizacion, 
                   c.guia_oca,
                   e.nombre_estado AS estado,
                   s.nombre_sub_estado AS sub_estado
            FROM casos_tienda c
            LEFT JOIN tiendas t ON c.tienda_id = t.id
            LEFT JOIN estados e ON c.estado_id = e.id
            LEFT JOIN sub_estados s ON c.sub_estado_id = s.id
            ORDER BY c.fecha_creacion DESC";

    $rs = mysqli_query($conexionBD, $sql);

    if (mysqli_num_rows($rs) > 0) {
        $Listado = array();
        $i = 0;

        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['id']                 = $data['id'];
            $Listado[$i]['tienda']             = $data['tienda']; // ahora viene de la tabla tiendas
            $Listado[$i]['referencia']         = $data['referencia'];
            $Listado[$i]['nombre_cliente']     = $data['nombre_cliente'];
            $Listado[$i]['descripcion']        = $data['descripcion'];
            $Listado[$i]['fecha_creacion']     = $data['fecha_creacion'];
            $Listado[$i]['fecha_actualizacion']= $data['fecha_actualizacion'];
            $Listado[$i]['guia_oca']           = $data['guia_oca'];
            $Listado[$i]['estado']             = $data['estado'];
            $Listado[$i]['sub_estado']         = $data['sub_estado'];
            $i++;
        }

        return $Listado;
    } else {
        return false;
    }
}


//GUARDAR CASO
function guardarCaso($conexionBD, $tienda_id, $referencia, $nombre_cliente, $descripcion, $guia_oca, $estado_id, $sub_estado_id) {
    $sql = "INSERT INTO casos_tienda 
            (tienda_id, referencia, nombre_cliente, descripcion, fecha_creacion, fecha_actualizacion, guia_oca, estado_id, sub_estado_id)
            VALUES ($tienda_id, '$referencia', '$nombre_cliente', '$descripcion', CURDATE(), CURDATE(), '$guia_oca', $estado_id, $sub_estado_id)";

    if (!mysqli_query($conexionBD, $sql)) {
        die('No se pudo cargar el caso: ' . mysqli_error($conexionBD));
    }

    return true;
}

//ELIMINAR CASO
function eliminarCaso($conexionBD, $idCaso) {
    $idCaso = (int)$idCaso;
    $sql = "DELETE FROM casos_tienda WHERE id = $idCaso";

    if (!mysqli_query($conexionBD, $sql)) {
        return false;
    }
    return true;
}


//MODIFICAR CASO

function EditarCaso($conexionBD, $idCaso, $tienda_id, $referencia, $nombre_cliente, $descripcion, $guia_oca, $estado_id, $sub_estado_id) {
    $sql = "UPDATE casos_tienda 
            SET tienda_id = $tienda_id,
                referencia = '$referencia',
                nombre_cliente = '$nombre_cliente',
                descripcion = '$descripcion',
                guia_oca = '$guia_oca',
                estado_id = $estado_id,
                sub_estado_id = $sub_estado_id,
                fecha_actualizacion = CURDATE()
            WHERE id = $idCaso";

    return mysqli_query($conexionBD, $sql);
}


//TRAER/MODIFICAR CASO
function TraerCaso($conexionBD, $idCaso) {
    $sql = "SELECT id, tienda_id, referencia, nombre_cliente, descripcion, guia_oca, estado_id, sub_estado_id, fecha_creacion, fecha_actualizacion
            FROM casos_tienda
            WHERE id = $idCaso";

    $rs = mysqli_query($conexionBD, $sql);

    if ($rs && mysqli_num_rows($rs) > 0) {
        return mysqli_fetch_assoc($rs);
    } else {
        return false;
    }
}


//LISTADOS DESPLEGABLES--------------------------------------------------------------------------------------------------------------------

//funciones para listado carga

function listarTiendas($conexionBD) {
    $sql = "SELECT id, nombre_tienda FROM tiendas ORDER BY nombre_tienda ASC";
    $rs = mysqli_query($conexionBD, $sql);
    $Listado = [];
    while ($data = mysqli_fetch_assoc($rs)) {
        $Listado[] = $data;
    }
    return $Listado;
}

function listarEstados($conexionBD) {
    $sql = "SELECT id, nombre_estado FROM estados ORDER BY id ASC";
    $rs = mysqli_query($conexionBD, $sql);
    $Listado = [];
    while ($data = mysqli_fetch_assoc($rs)) {
        $Listado[] = $data;
    }
    return $Listado;
}

function listarSubEstados($conexionBD) {
    $sql = "SELECT id, nombre_sub_estado FROM sub_estados ORDER BY id ASC";
    $rs = mysqli_query($conexionBD, $sql);
    $Listado = [];
    while ($data = mysqli_fetch_assoc($rs)) {
        $Listado[] = $data;
    }
    return $Listado;
}



?>
