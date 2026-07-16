<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: productos.php");
    exit();
}

$id = intval($_GET["id"]);

$sql = $conexion->prepare("

SELECT *

FROM productos

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: productos.php");
    exit();
}

$producto = $sql->fetch(PDO::FETCH_ASSOC);

$categorias = $conexion->query("

SELECT *

FROM categorias

ORDER BY nombre ASC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Producto</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>

                Editar Producto

            </h1>

            <div class="formAdmin">

                <form

                    action="../acciones/actualizar_producto.php"

                    method="POST"

                    enctype="multipart/form-data">

                    <input

                        type="hidden"

                        name="id"

                        value="<?php echo $producto["id"]; ?>">

                    <div class="grupo">

                        <label>

                            Categoría

                        </label>

                        <select

                            name="categoria"

                            required>

                            <?php while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option

                                    value="<?php echo $cat["nombre"]; ?>"

                                    <?php

                                    if ($cat["nombre"] == $producto["categoria"]) {

                                        echo "selected";
                                    }

                                    ?>>

                                    <?php echo $cat["nombre"]; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Nombre

                        </label>

                        <input

                            type="text"

                            name="nombre"

                            value="<?php echo htmlspecialchars($producto["nombre"]); ?>"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Descripción

                        </label>

                        <textarea

                            name="descripcion"

                            rows="5"><?php echo htmlspecialchars($producto["descripcion"]); ?></textarea>

                    </div>

                    <div class="grupo">

                        <label>

                            Precio Compra

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            name="precio_compra"

                            value="<?php echo $producto["precio_compra"]; ?>"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Precio Venta

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            name="precio_venta"

                            value="<?php echo $producto["precio_venta"]; ?>"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Precio Anterior

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            name="precio_anterior"

                            value="<?php echo $producto["precio_anterior"]; ?>">

                    </div>

                    <div class="grupo">

                        <label>

                            Stock

                        </label>

                        <input

                            type="number"

                            name="stock"

                            value="<?php echo $producto["stock"]; ?>"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Imagen Actual

                        </label>

                        <br>

                        <img

                            src="../img/productos/<?php echo $producto["imagen"]; ?>"

                            style="width:120px;border-radius:10px;">

                    </div>

                    <div class="grupo">

                        <label>

                            Cambiar Imagen

                        </label>

                        <input

                            type="file"

                            name="imagen"

                            accept="image/*">

                    </div>

                    <div class="grupo">

                        <label>

                            Oferta

                        </label>

                        <select name="oferta">

                            <option value="0" <?php if ($producto["oferta"] == 0) echo "selected"; ?>>No</option>

                            <option value="1" <?php if ($producto["oferta"] == 1) echo "selected"; ?>>Sí</option>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Producto Destacado

                        </label>

                        <select name="destacado">

                            <option value="0" <?php if ($producto["destacado"] == 0) echo "selected"; ?>>No</option>

                            <option value="1" <?php if ($producto["destacado"] == 1) echo "selected"; ?>>Sí</option>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Producto Nuevo

                        </label>

                        <select name="nuevo">

                            <option value="0" <?php if ($producto["nuevo"] == 0) echo "selected"; ?>>No</option>

                            <option value="1" <?php if ($producto["nuevo"] == 1) echo "selected"; ?>>Sí</option>

                        </select>

                    </div>

                    <div class="botonesFormulario">

                        <button

                            class="btnGuardar"

                            type="submit">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Actualizar Producto

                        </button>

                        <a

                            href="productos.php"

                            class="btnCancelar">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>