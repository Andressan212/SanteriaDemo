<?php

session_start();

require_once("../includes/conexion.php");

/*=====================================
VALIDAR ID
=====================================*/

if (!isset($_GET["id"])) {

    header("Location: ../administrador/productos.php");
    exit();
}

$id = intval($_GET["id"]);

/*=====================================
BUSCAR PRODUCTO
=====================================*/

$sql = $conexion->prepare("

SELECT *

FROM productos

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: ../administrador/productos.php");
    exit();
}

$producto = $sql->fetch(PDO::FETCH_ASSOC);

/*=====================================
ELIMINAR IMAGEN
=====================================*/

if (

    !empty($producto["imagen"])

    &&

    $producto["imagen"] != "sin-imagen.png"

    &&

    file_exists("../img/productos/" . $producto["imagen"])

) {

    unlink("../img/productos/" . $producto["imagen"]);
}

/*=====================================
ELIMINAR PRODUCTO
=====================================*/

$sql = $conexion->prepare("

DELETE FROM productos

WHERE id=?

");

$sql->execute([$id]);

header("Location: ../administrador/productos.php?eliminado=1");

exit();
