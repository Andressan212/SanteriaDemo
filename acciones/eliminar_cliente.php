<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=============================
VALIDAR ID
=============================*/

if (!isset($_GET["id"])) {

    header("Location: ../administrador/clientes.php");
    exit();
}

$id = intval($_GET["id"]);

/*=============================
VERIFICAR SI TIENE VENTAS
=============================*/

$sql = $conexion->prepare("

SELECT COUNT(*)

FROM ventas

WHERE cliente = ?

");

$sql->execute([$id]);

$totalVentas = $sql->fetchColumn();

/*=============================
SI TIENE VENTAS NO ELIMINAR
=============================*/

if ($totalVentas > 0) {

    header("Location: ../administrador/clientes.php?error=tieneventas");
    exit();
}

/*=============================
ELIMINAR CLIENTE
=============================*/

$sql = $conexion->prepare("

DELETE FROM clientes

WHERE id = ?

");

$sql->execute([$id]);

/*=============================
REDIRECCIONAR
=============================*/

header("Location: ../administrador/clientes.php?ok=eliminado");

exit();
