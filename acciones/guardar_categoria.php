<?php

session_start();

require_once("../includes/conexion.php");

/*====================================
VALIDAR ENVÍO
====================================*/

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/categorias.php");
    exit();
}

/*====================================
RECIBIR DATOS
====================================*/

$nombre = trim($_POST["nombre"]);
$descripcion = trim($_POST["descripcion"]);
$estado = $_POST["estado"];

/*====================================
VALIDAR NOMBRE
====================================*/

if ($nombre == "") {

    header("Location: ../administrador/nueva_categoria.php?error=1");
    exit();
}

/*====================================
VERIFICAR SI YA EXISTE
====================================*/

$sql = $conexion->prepare("

SELECT id

FROM categorias

WHERE nombre=?

LIMIT 1

");

$sql->execute([$nombre]);

if ($sql->rowCount() > 0) {

    header("Location: ../administrador/nueva_categoria.php?duplicado=1");
    exit();
}

/*====================================
SUBIR IMAGEN
====================================*/

$imagen = "sin-imagen.png";

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

    $extension = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));

    $permitidas = ["jpg", "jpeg", "png", "webp"];

    if (in_array($extension, $permitidas)) {

        $imagen = uniqid() . "." . $extension;

        move_uploaded_file(

            $_FILES["imagen"]["tmp_name"],

            "../img/categorias/" . $imagen

        );
    }
}

/*====================================
INSERTAR
====================================*/

$sql = $conexion->prepare("

INSERT INTO categorias(

nombre,

descripcion,

imagen,

estado,

fecha_registro

)

VALUES(

?,?,?,?,NOW()

)

");

$sql->execute([

    $nombre,

    $descripcion,

    $imagen,

    $estado

]);

header("Location: ../administrador/categorias.php?ok=1");

exit();
