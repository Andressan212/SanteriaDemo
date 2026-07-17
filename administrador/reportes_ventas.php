<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$desde = isset($_GET["desde"]) ? $_GET["desde"] : "";
$hasta = isset($_GET["hasta"]) ? $_GET["hasta"] : "";

if ($desde != "" && $hasta != "") {

    $sql = $conexion->prepare("

    SELECT

    ventas.*,

    clientes.nombre AS cliente

    FROM ventas

    INNER JOIN clientes

    ON ventas.cliente=clientes.id

    WHERE DATE(fecha)

    BETWEEN ? AND ?

    ORDER BY fecha DESC

    ");

    $sql->execute([$desde, $hasta]);
} else {

    $sql = $conexion->query("

    SELECT

    ventas.*,

    clientes.nombre AS cliente

    FROM ventas

    INNER JOIN clientes

    ON ventas.cliente=clientes.id

    ORDER BY fecha DESC

    ");
}
