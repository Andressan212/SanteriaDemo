<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*==================================
VALIDAR ID
==================================*/

if (!isset($_GET["id"])) {

    header("Location: ../administrador/ventas.php");
    exit();
}

$id = intval($_GET["id"]);

/*==================================
VERIFICAR VENTA
==================================*/

$sql = $conexion->prepare("

SELECT estado

FROM ventas

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: ../administrador/ventas.php?error=noexiste");
    exit();
}

$venta = $sql->fetch(PDO::FETCH_ASSOC);

/*==================================
SOLO SE ELIMINAN VENTAS ANULADAS
==================================*/

if ($venta["estado"] != "ANULADA") {

    header("Location: ../administrador/ventas.php?error=noanulada");
    exit();
}

try {

    $conexion->beginTransaction();

    /*==================================
    ELIMINAR DETALLE
    ==================================*/

    $detalle = $conexion->prepare("

    DELETE FROM detalle_ventas

    WHERE venta=?

    ");

    $detalle->execute([$id]);

    /*==================================
    ELIMINAR VENTA
    ==================================*/

    $eliminar = $conexion->prepare("

    DELETE FROM ventas

    WHERE id=?

    ");

    $eliminar->execute([$id]);

    $conexion->commit();

    header("Location: ../administrador/ventas.php?ok=eliminada");
    exit();
} catch (PDOException $e) {

    $conexion->rollBack();

    die("Error al eliminar la venta: " . $e->getMessage());
}
