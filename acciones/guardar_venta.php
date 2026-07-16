<?php

session_start();

require_once("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/ventas.php");
    exit();
}

$cliente = $_POST["cliente"];
$metodo = $_POST["metodo_pago"];
$total = $_POST["total"];
$detalle = json_decode($_POST["detalle"], true);

$usuario = isset($_SESSION["admin_usuario"])
    ? $_SESSION["admin_usuario"]
    : "Administrador";

/*==========================
GUARDAR VENTA
==========================*/

$sql = $conexion->prepare("

INSERT INTO ventas(

cliente,

fecha,

subtotal,

descuento,

total,

estado,

metodo_pago,

usuario

)

VALUES(

?,

NOW(),

?,

0,

?,

'PAGADA',

?,

?

)

");

$sql->execute([

    $cliente,

    $total,

    $total,

    $metodo,

    $usuario

]);

$venta = $conexion->lastInsertId();

/*==========================
DETALLE DE VENTA
==========================*/

foreach ($detalle as $item) {

    $sql = $conexion->prepare("

    INSERT INTO detalle_ventas(

    venta,

    producto,

    cantidad,

    precio,

    subtotal

    )

    VALUES(

    ?,?,?,?,?

    )

    ");

    $sql->execute([

        $venta,

        $item["id"],

        $item["cantidad"],

        $item["precio"],

        $item["subtotal"]

    ]);
}

/*=====================================
ACTUALIZAR STOCK, MÁS VENDIDO
Y REGISTRAR HISTORIAL
=====================================*/

foreach ($detalle as $item) {

    /* Obtener datos actuales */

    $buscar = $conexion->prepare("

    SELECT stock, mas_vendido

    FROM productos

    WHERE id=?

    LIMIT 1

    ");

    $buscar->execute([$item["id"]]);

    $producto = $buscar->fetch(PDO::FETCH_ASSOC);

    $stockAnterior = $producto["stock"];
    $stockNuevo = $stockAnterior - $item["cantidad"];

    $masVendido = $producto["mas_vendido"] + $item["cantidad"];

    /* Actualizar producto */

    $actualizar = $conexion->prepare("

    UPDATE productos

    SET

    stock=?,

    mas_vendido=?

    WHERE id=?

    ");

    $actualizar->execute([

        $stockNuevo,

        $masVendido,

        $item["id"]

    ]);

    /*=====================================
    REGISTRAR HISTORIAL DE STOCK
    =====================================*/

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

        $item["id"],

        "SALIDA",

        $item["cantidad"],

        $stockAnterior,

        $stockNuevo,

        "Venta Nº " . $venta

    ]);
}

/*=====================================
REDIRECCIONAR
=====================================*/

header("Location: ../administrador/ventas.php?ok=venta");

exit();
