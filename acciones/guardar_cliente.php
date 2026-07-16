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

$nombre = trim($_POST["nombre"]);
$telefono = trim($_POST["telefono"]);
$correo = trim($_POST["correo"]);
$direccion = trim($_POST["direccion"]);

/*=============================
VALIDACIÓN
=============================*/

if ($nombre == "") {

    header("Location: ../administrador/nuevo_cliente.php?error=1");
    exit();
}

/*=============================
GUARDAR CLIENTE
=============================*/

$sql = $conexion->prepare("

INSERT INTO clientes(

nombre,

telefono,

correo,

direccion

)

VALUES(

?,?,?,?

)

");

$sql->execute([

    $nombre,

    $telefono,

    $correo,

    $direccion

]);

/*=============================
REDIRECCIONAR
=============================*/

header("Location: ../administrador/clientes.php?ok=1");

exit();
