<?php

session_start();

require_once("../includes/conexion.php");

/*==============================
VALIDAR ID
==============================*/

if (!isset($_GET["id"])) {

    header("Location: ../administrador/categorias.php");
    exit();
}

$id = intval($_GET["id"]);

/*==============================
OBTENER IMAGEN
==============================*/

$sql = $conexion->prepare("

SELECT imagen

FROM categorias

WHERE id = ?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: ../administrador/categorias.php");
    exit();
}

$categoria = $sql->fetch(PDO::FETCH_ASSOC);

/*==============================
BORRAR IMAGEN
==============================*/

if (

    !empty($categoria["imagen"]) &&

    $categoria["imagen"] != "sin-imagen.png" &&

    file_exists("../img/categorias/" . $categoria["imagen"])

) {

    unlink("../img/categorias/" . $categoria["imagen"]);
}

/*==============================
ELIMINAR CATEGORIA
==============================*/

$sql = $conexion->prepare("

DELETE FROM categorias

WHERE id = ?

");

$sql->execute([$id]);

header("Location: ../administrador/categorias.php?eliminado=1");

exit();
