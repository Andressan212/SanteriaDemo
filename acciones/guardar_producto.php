<?php

require_once("../includes/conexion.php");

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$categoria = $_POST["categoria"];
$precioCompra = $_POST["precio_compra"];
$precioVenta = $_POST["precio_venta"];
$stock = $_POST["stock"];

$imagen = time() . "_" . $_FILES["imagen"]["name"];

move_uploaded_file(

    $_FILES["imagen"]["tmp_name"],

    "../img/productos/" . $imagen

);

$sql = $conexion->prepare(

    "INSERT INTO productos

(categoria,nombre,descripcion,precio_compra,precio_venta,stock,imagen)

VALUES(?,?,?,?,?,?,?)"

);

$sql->execute([

    $categoria,

    $nombre,

    $descripcion,

    $precioCompra,

    $precioVenta,

    $stock,

    $imagen

]);

header("Location: ../administrador/productos.php");
