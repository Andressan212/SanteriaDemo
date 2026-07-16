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
VALIDAR
=====================================*/

if ($producto_id <= 0 || $cantidad <= 0) {

    header("Location: ../administrador/nueva_entrada.php?error=1");
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

    header("Location: ../administrador/nueva_entrada.php?error=2");
    exit();
}

$producto = $sql->fetch(PDO::FETCH_ASSOC);

$stockAnterior = $producto["stock"];
$stockNuevo = $stockAnterior + $cantidad;

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
REGISTRAR MOVIMIENTO
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

    "ENTRADA",

    $cantidad,

    $stockAnterior,

    $stockNuevo,

    $observacion,

    $usuario

]);

/*=====================================
REDIRECCIÓN
=====================================*/

header("Location: ../administrador/inventario.php?entrada=ok");

exit();
