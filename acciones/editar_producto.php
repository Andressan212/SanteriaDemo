<?php

require_once("../includes/conexion.php");

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$categoria = $_POST["categoria"];
$precioCompra = $_POST["precio_compra"];
$precioVenta = $_POST["precio_venta"];
$stock = $_POST["stock"];

$imagen = $_POST["imagen_actual"];

if ($_FILES["imagen"]["name"] != "") {

    if (file_exists("../img/productos/" . $imagen)) {

        unlink("../img/productos/" . $imagen);
    }

    $imagen = time() . "_" . $_FILES["imagen"]["name"];

    move_uploaded_file(

        $_FILES["imagen"]["tmp_name"],

        "../img/productos/" . $imagen

    );
}

$sql = $conexion->prepare(

    "UPDATE productos SET

categoria=?,

nombre=?,

descripcion=?,

precio_compra=?,

precio_venta=?,

stock=?,

imagen=?

WHERE id=?"

);

$sql->execute([

    $categoria,

    $nombre,

    $descripcion,

    $precioCompra,

    $precioVenta,

    $stock,

    $imagen,

    $id

]);

header("Location: ../administrador/productos.php");
