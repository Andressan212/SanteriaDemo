<?php

require_once("../includes/conexion.php");

$id = $_GET["id"];

$sql = $conexion->prepare(

    "SELECT imagen

FROM productos

WHERE id=?"

);

$sql->execute([$id]);

$p = $sql->fetch(PDO::FETCH_ASSOC);

if (file_exists("../img/productos/" . $p["imagen"])) {

    unlink("../img/productos/" . $p["imagen"]);
}

$sql = $conexion->prepare(

    "DELETE FROM productos

WHERE id=?"

);

$sql->execute([$id]);

header("Location: ../administrador/productos.php");
