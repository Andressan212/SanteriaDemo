<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva Categoría</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <div class="encabezadoDashboard">

                <div>

                    <h1>

                        Nueva Categoría

                    </h1>

                    <p>

                        Complete los datos para registrar una nueva categoría.

                    </p>

                </div>

            </div>

            <div class="formAdmin">

                <form action="../acciones/guardar_categoria.php"

                    method="POST"

                    enctype="multipart/form-data">

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

                            rows="5"

                            placeholder="Descripción de la categoría"></textarea>

                    </div>

                    <div class="grupo">

                        <label>

                            Imagen (Opcional)

                        </label>

                        <input

                            type="file"

                            name="imagen"

                            accept="image/*">

                    </div>

                    <div class="grupo">

                        <label>

                            Estado

                        </label>

                        <select name="estado">

                            <option value="1">

                                Activa

                            </option>

                            <option value="0">

                                Inactiva

                            </option>

                        </select>

                    </div>

                    <div class="botonesFormulario">

                        <button

                            type="submit"

                            class="btnGuardar">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Guardar Categoría

                        </button>

                        <a

                            href="categorias.php"

                            class="btnCancelar">

                            <i class="fa-solid fa-arrow-left"></i>

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>