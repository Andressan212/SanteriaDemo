<?php

require_once("../includes/verificar.php");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Nuevo Cliente</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>Nuevo Cliente</h1>

            <form
                action="../acciones/guardar_cliente.php"
                method="POST"
                class="formAdmin">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    required>

                <label>Teléfono</label>

                <input
                    type="text"
                    name="telefono">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo">

                <label>Dirección</label>

                <textarea
                    name="direccion"
                    rows="4"></textarea>

                <br>

                <button
                    type="submit"
                    class="btnGuardar">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Guardar Cliente

                </button>

                <a
                    href="clientes.php"
                    class="btnCancelar">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</body>

</html>