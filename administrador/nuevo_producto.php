<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

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

    <title>Nuevo Producto</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>

                Nuevo Producto

            </h1>

            <div class="formAdmin">

                <form

                    action="../acciones/guardar_producto.php"

                    method="POST"

                    enctype="multipart/form-data">

                    <div class="grupo">

                        <label>

                            Categoría

                        </label>

                        <select

                            name="categoria"

                            required>

                            <option value="">

                                Seleccione...

                            </option>

                            <?php while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option

                                    value="<?php echo $cat["nombre"]; ?>">

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

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Descripción

                        </label>

                        <textarea

                            name="descripcion"

                            rows="5"></textarea>

                    </div>

                    <div class="grupo">

                        <label>

                            Precio Compra

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            name="precio_compra"

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

                            value="0">

                    </div>

                    <div class="grupo">

                        <label>

                            Stock

                        </label>

                        <input

                            type="number"

                            name="stock"

                            value="1"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Imagen

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

                            <option value="0">

                                No

                            </option>

                            <option value="1">

                                Sí

                            </option>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Producto Destacado

                        </label>

                        <select name="destacado">

                            <option value="0">

                                No

                            </option>

                            <option value="1">

                                Sí

                            </option>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Producto Nuevo

                        </label>

                        <select name="nuevo">

                            <option value="0">

                                No

                            </option>

                            <option value="1">

                                Sí

                            </option>

                        </select>

                    </div>

                    <div class="botonesFormulario">

                        <button

                            class="btnGuardar"

                            type="submit">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Guardar Producto

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