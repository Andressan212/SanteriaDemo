<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$id = $_GET["id"];

$sql = $conexion->prepare("SELECT * FROM productos WHERE id=?");
$sql->execute([$id]);

$producto = $sql->fetch(PDO::FETCH_ASSOC);

$categorias = $conexion->query("SELECT * FROM categorias");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Producto</title>

    <link rel="stylesheet" href="../css/administrador.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>Editar Producto</h1>

            <form

                action="../acciones/editar_producto.php"

                method="POST"

                enctype="multipart/form-data">

                <input

                    type="hidden"

                    name="id"

                    value="<?= $producto["id"] ?>">

                <input

                    type="hidden"

                    name="imagen_actual"

                    value="<?= $producto["imagen"] ?>">

                <label>Nombre</label>

                <input

                    type="text"

                    name="nombre"

                    value="<?= $producto["nombre"] ?>"

                    required>

                <label>Descripción</label>

                <textarea

                    name="descripcion"

                    required><?= $producto["descripcion"] ?></textarea>

                <label>Categoría</label>

                <select

                    name="categoria">

                    <?php

                    while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <option

                            value="<?= $cat["id"] ?>"

                            <?= $cat["id"] == $producto["categoria"] ? "selected" : ""; ?>>

                            <?= $cat["nombre"] ?>

                        </option>

                    <?php } ?>

                </select>

                <label>Precio Compra</label>

                <input

                    type="number"

                    step="0.01"

                    name="precio_compra"

                    value="<?= $producto["precio_compra"] ?>"

                    required>

                <label>Precio Venta</label>

                <input

                    type="number"

                    step="0.01"

                    name="precio_venta"

                    value="<?= $producto["precio_venta"] ?>"

                    required>

                <label>Stock</label>

                <input

                    type="number"

                    name="stock"

                    value="<?= $producto["stock"] ?>"

                    required>

                <p>Imagen actual</p>

                <img

                    src="../img/productos/<?= $producto["imagen"] ?>"

                    width="150">

                <br><br>

                <input

                    type="file"

                    name="imagen"

                    accept="image/*">

                <br><br>

                <button>

                    Actualizar Producto

                </button>

            </form>

        </div>

    </div>

</body>

</html>