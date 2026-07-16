<?php

session_start();

require_once("../includes/conexion.php");

/*====================================
VALIDAR ENVÍO
====================================*/

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/productos.php");
    exit();
}

/*====================================
RECIBIR DATOS
====================================*/

$id = $_POST["id"];

$categoria = trim($_POST["categoria"]);
$nombre = trim($_POST["nombre"]);
$descripcion = trim($_POST["descripcion"]);

$precio_compra = $_POST["precio_compra"];
$precio_venta = $_POST["precio_venta"];
$precio_anterior = $_POST["precio_anterior"];

$stock = $_POST["stock"];

$oferta = $_POST["oferta"];
$destacado = $_POST["destacado"];
$nuevo = $_POST["nuevo"];

/*====================================
OBTENER IMAGEN ACTUAL
====================================*/

$sql = $conexion->prepare("

SELECT imagen

FROM productos

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

$producto = $sql->fetch(PDO::FETCH_ASSOC);

$imagen = $producto["imagen"];

/*====================================
SUBIR NUEVA IMAGEN
====================================*/

if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

    $extension = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));

    $permitidas = ["jpg", "jpeg", "png", "webp"];

    if (in_array($extension, $permitidas)) {

        if (

            !empty($imagen)

            &&

            $imagen != "sin-imagen.png"

            &&

            file_exists("../img/productos/" . $imagen)

        ) {

            unlink("../img/productos/" . $imagen);
        }

        $imagen = uniqid() . "." . $extension;

        move_uploaded_file(

            $_FILES["imagen"]["tmp_name"],

            "../img/productos/" . $imagen

        );
    }
}

/*====================================
ACTUALIZAR
====================================*/

$sql = $conexion->prepare("

UPDATE productos

SET

categoria=?,

nombre=?,

descripcion=?,

precio_compra=?,

precio_venta=?,

stock=?,

imagen=?,

precio_anterior=?,

oferta=?,

destacado=?,

nuevo=?

WHERE id=?

");

$sql->execute([

    $categoria,

    $nombre,

    $descripcion,

    $precio_compra,

    $precio_venta,

    $stock,

    $imagen,

    $precio_anterior,

    $oferta,

    $destacado,

    $nuevo,

    $id

]);

header("Location: ../administrador/productos.php?editado=1");

exit();
