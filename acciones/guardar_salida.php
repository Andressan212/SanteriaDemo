<?php

session_start();

require_once("../includes/conexion.php");

/*=====================================
VALIDAR MÉTODO
=====================================*/

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/inventario.php");
    exit();
}

/*=====================================
RECIBIR DATOS
=====================================*/

$producto_id = intval($_POST["producto_id"]);
$cantidad = intval($_POST["cantidad"]);
$observacion = trim($_POST["observacion"]);

/*=====================================
VALIDAR DATOS
=====================================*/

if ($producto_id <= 0 || $cantidad <= 0) {

    header("Location: ../administrador/nueva_salida.php?error=1");
    exit();
}

/*=====================================
BUSCAR PRODUCTO
=====================================*/

$sql = $conexion->prepare("

SELECT *

FROM productos

WHERE id=?

LIMIT 1

");

$sql->execute([$producto_id]);

if ($sql->rowCount() == 0) {

    header("Location: ../administrador/nueva_salida.php?error=2");
    exit();
}

$producto = $sql->fetch(PDO::FETCH_ASSOC);

$stockAnterior = $producto["stock"];

/*=====================================
VALIDAR STOCK
=====================================*/

if ($cantidad > $stockAnterior) {

    header("Location: ../administrador/nueva_salida.php?error=stock");
    exit();
}

$stockNuevo = $stockAnterior - $cantidad;

/*=====================================
ACTUALIZAR STOCK
=====================================*/

$actualizar = $conexion->prepare("

UPDATE productos

SET stock=?

WHERE id=?

");

$actualizar->execute([

    $stockNuevo,

    $producto_id

]);

/*=====================================
USUARIO
=====================================*/

$usuario = "Administrador";

if (isset($_SESSION["admin_usuario"])) {

    $usuario = $_SESSION["admin_usuario"];
}

/*=====================================
GUARDAR MOVIMIENTO
=====================================*/

$guardar = $conexion->prepare("

INSERT INTO inventario(

producto_id,

tipo,

cantidad,

stock_anterior,

stock_actual,

observacion,

usuario

)

VALUES(

?,?,?,?,?,?,?

)

");

$guardar->execute([

    $producto_id,

    "SALIDA",

    $cantidad,

    $stockAnterior,

    $stockNuevo,

    $observacion,

    $usuario

]);

/*=====================================
REDIRECCIONAR
=====================================*/

header("Location: ../administrador/inventario.php?salida=ok");

exit();
