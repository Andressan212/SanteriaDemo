<?php

require_once("../includes/conexion.php");

$sql = $conexion->query(

    "SELECT

DATE(fecha) dia,

SUM(total) total

FROM ventas

GROUP BY DATE(fecha)

ORDER BY fecha"

);

$datos = [];

while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {

    $datos[] = $fila;
}

echo json_encode($datos);
