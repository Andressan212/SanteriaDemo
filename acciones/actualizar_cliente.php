<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=============================
VALIDAR ENVÍO
=============================*/

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/clientes.php");
    exit();
}

/*=============================
RECIBIR DATOS
=============================*/

$id = intval($_POST["id"]);
$nombre = trim($_POST["nombre"]);
$telefono = trim($_POST["telefono"]);
$correo = trim($_POST["correo"]);
$direccion = trim($_POST["direccion"]);

/*=============================
VALIDACIONES
=============================*/

if ($id <= 0 || $nombre == "") {

    header("Location: ../administrador/clientes.php?error=1");
    exit();
}

/*=============================
ACTUALIZAR CLIENTE
=============================*/

$sql = $conexion->prepare("

UPDATE clientes

SET

nombre = ?,

telefono = ?,

correo = ?,

direccion = ?

WHERE id = ?

");

$sql->execute([

    $nombre,

    $telefono,

    $correo,

    $direccion,

    $id

]);

/*=============================
REDIRECCIONAR
=============================*/

header("Location: ../administrador/clientes.php?ok=actualizado");

exit();
