<?php

require_once "verificar.php";

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Administrador</title>

    <link rel="stylesheet" href="css/administrador.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4b7d1b7b0f.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="panelFormulario">

        <h1>

            <i class="fa-solid fa-user-plus"></i>

            Nuevo Administrador

        </h1>

        <form

            action="acciones/guardar_admin.php"

            method="POST"

            enctype="multipart/form-data">

            <div class="grupoFormulario">

                <label>

                    Nombre

                </label>

                <input

                    type="text"

                    name="nombre"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Apellido

                </label>

                <input

                    type="text"

                    name="apellido"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Usuario

                </label>

                <input

                    type="text"

                    name="usuario"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Correo Electrónico

                </label>

                <input

                    type="email"

                    name="email"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Teléfono

                </label>

                <input

                    type="text"

                    name="telefono">

            </div>

            <div class="grupoFormulario">

                <label>

                    Rol

                </label>

                <select

                    name="rol"

                    required>

                    <option value="Administrador">

                        Administrador

                    </option>

                    <option value="Empleado">

                        Empleado

                    </option>

                    <option value="Vendedor">

                        Vendedor

                    </option>

                </select>

            </div>

            <div class="grupoFormulario">

                <label>

                    Contraseña

                </label>

                <input

                    type="password"

                    name="password"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Confirmar Contraseña

                </label>

                <input

                    type="password"

                    name="confirmar"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>

                    Foto

                </label>

                <input

                    type="file"

                    name="foto"

                    accept=".jpg,.jpeg,.png,.webp">

            </div>

            <div class="grupoFormulario">

                <label>

                    Estado

                </label>

                <select

                    name="estado">

                    <option value="1">

                        Activo

                    </option>

                    <option value="0">

                        Inactivo

                    </option>

                </select>

            </div>

            <div class="botonesFormulario">

                <a

                    href="administradores.php"

                    class="btnCancelar">

                    Cancelar

                </a>

                <button

                    type="submit"

                    class="btnGuardar">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Guardar Administrador

                </button>

            </div>

        </form>

    </div>

</body>

</html>