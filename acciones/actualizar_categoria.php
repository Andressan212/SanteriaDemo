<?php

session_start();

require_once("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/categorias.php");
    exit();
}

$id = $_POST["id"];
$nombre = trim($_POST["nombre"]);
$descripcion = trim($_POST["descripcion"]);
$estado = $_POST["estado"];

/*==============================
VALIDAR
==============================*/

if (empty($nombre)) {

    header("Location: ../administrador/editar_categoria.php?id=" . $id . "&error=1");
    exit();
}

/*==============================
OBTENER IMAGEN ACTUAL
==============================*/

$sql = $conexion->prepare("

SELECT imagen

FROM categorias

WHERE id = ?

LIMIT 1

");

$sql->execute([$id]);

$categoria = $sql->fetch(PDO::FETCH_ASSOC);

$imagen = $categoria["imagen"];

/*==============================
SUBIR NUEVA IMAGEN
==============================*/

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

    $extension = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));

    $permitidas = ["jpg", "jpeg", "png", "webp"];

    if (in_array($extension, $permitidas)) {

        if (!empty($imagen) && file_exists("../img/categorias/" . $imagen)) {

            unlink("../img/categorias/" . $imagen);
        }

        $imagen = uniqid() . "." . $extension;

        move_uploaded_file(

            $_FILES["imagen"]["tmp_name"],

            "../img/categorias/" . $imagen

        );
    }
}

/*==============================
ACTUALIZAR
==============================*/

$sql = $conexion->prepare("

UPDATE categorias

SET

nombre = ?,

descripcion = ?,

imagen = ?,

estado = ?

WHERE id = ?

");

$sql->execute([

    $nombre,

    $descripcion,

    $imagen,

    $estado,

    $id

]);

header("Location: ../administrador/categorias.php?editado=1");

exit();
