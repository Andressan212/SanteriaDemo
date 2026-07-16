<?php

session_start();

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: ../administrador/ventas.php");
    exit();
}

$id = intval($_GET["id"]);

/*==================================
OBTENER VENTA
==================================*/

$sql = $conexion->prepare("

SELECT *

FROM ventas

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: ../administrador/ventas.php");
    exit();
}

$venta = $sql->fetch(PDO::FETCH_ASSOC);

/*==================================
EVITAR ANULAR DOS VECES
==================================*/

if ($venta["estado"] == "ANULADA") {

    header("Location: ../administrador/ventas.php?error=anulada");
    exit();
}

/*==================================
OBTENER PRODUCTOS DE LA VENTA
==================================*/

$sqlDetalle = $conexion->prepare("

SELECT *

FROM detalle_ventas

WHERE venta=?

");

$sqlDetalle->execute([$id]);

while ($detalle = $sqlDetalle->fetch(PDO::FETCH_ASSOC)) {

    /*==============================
    STOCK ACTUAL
    ==============================*/

    $buscar = $conexion->prepare("

    SELECT stock

    FROM productos

    WHERE id=?

    LIMIT 1

    ");

    $buscar->execute([$detalle["producto"]]);

    $stockAnterior = $buscar->fetchColumn();

    $stockNuevo = $stockAnterior + $detalle["cantidad"];

    /*==============================
    DEVOLVER STOCK
    ==============================*/

    $actualizar = $conexion->prepare("

    UPDATE productos

    SET stock=?

    WHERE id=?

    ");

    $actualizar->execute([

        $stockNuevo,

        $detalle["producto"]

    ]);

    /*==============================
    HISTORIAL
    ==============================*/

    $historial = $conexion->prepare("

    INSERT INTO historial_stock(

        producto,

        tipo,

        cantidad,

        stock_anterior,

        stock_nuevo,

        observacion,

        fecha

    )

    VALUES(

        ?,?,?,?,?,?,NOW()

    )

    ");

    $historial->execute([

        $detalle["producto"],

        "ENTRADA",

        $detalle["cantidad"],

        $stockAnterior,

        $stockNuevo,

        "Anulación Venta Nº " . $id

    ]);
}

/*==================================
ANULAR VENTA
==================================*/

$anular = $conexion->prepare("

UPDATE ventas

SET estado='ANULADA'

WHERE id=?

");

$anular->execute([$id]);

header("Location: ../administrador/ventas.php?ok=anulada");

exit();
