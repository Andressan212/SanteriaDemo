<?php

session_start();

require_once("includes/conexion.php");

/*
==================================
SI YA EXISTE UN ADMINISTRADOR
NO PERMITIR CREAR OTRO DESDE AQUÍ
==================================
*/

$totalAdmin = $conexion->query("SELECT COUNT(*) FROM administrador")->fetchColumn();

if ($totalAdmin > 0) {

    header("Location: admlogin.php");

    exit();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear Administrador</title>

    <link rel="stylesheet" href="css/crear_admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="contenedor">

        <div class="cardRegistro">

            <div class="titulo">

                <i class="fa-solid fa-user-shield"></i>

                <h1>

                    Crear Primer Administrador

                </h1>

                <p>

                    Este formulario solo estará disponible la primera vez.

                </p>

            </div>

            <form

                action="acciones/guardar_admin.php"

                method="POST"

                enctype="multipart/form-data">

                <div class="fila">

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

                            Apellido

                        </label>

                        <input

                            type="text"

                            name="apellido"

                            required>

                    </div>

                </div>

                <div class="fila">

                    <div class="grupo">

                        <label>

                            Usuario

                        </label>

                        <input

                            type="text"

                            name="usuario"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Correo Electrónico

                        </label>

                        <input

                            type="email"

                            name="email"

                            required>

                    </div>

                </div>

                <div class="fila">

                    <div class="grupo">

                        <label>

                            Teléfono

                        </label>

                        <input

                            type="text"

                            name="telefono">

                    </div>

                    <div class="grupo">

                        <label>

                            Rol

                        </label>

                        <select

                            name="rol">

                            <option value="Administrador">

                                Administrador

                            </option>

                            <option value="Supervisor">

                                Supervisor

                            </option>

                            <option value="Empleado">

                                Empleado

                            </option>

                        </select>

                    </div>

                </div>
                <div class="fila">

                    <div class="grupo">

                        <label>

                            Contraseña

                        </label>

                        <input

                            type="password"

                            name="password"

                            id="password"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Confirmar Contraseña

                        </label>

                        <input

                            type="password"

                            name="confirmar"

                            id="confirmar"

                            required>

                    </div>

                </div>

                <div class="fila">

                    <div class="grupo">

                        <label>

                            Foto de Perfil

                        </label>

                        <input

                            type="file"

                            name="foto"

                            id="foto"

                            accept="image/*"

                            onchange="previewImage(event)">

                    </div>

                    <div class="grupo fotoPreview">

                        <img

                            src="img/usuarios/usuario.png"

                            id="preview"

                            alt="Vista previa">

                    </div>

                </div>

                <div class="fila">

                    <div class="grupo">

                        <label>

                            Estado

                        </label>

                        <select name="estado">

                            <option value="1">

                                Activo

                            </option>

                            <option value="0">

                                Inactivo

                            </option>

                        </select>

                    </div>

                </div>

                <div class="botones">

                    <button

                        type="submit"

                        class="btnGuardar">

                        <i class="fa-solid fa-user-plus"></i>

                        Crear Administrador

                    </button>

                    <a

                        href="admlogin.php"

                        class="btnCancelar">

                        <i class="fa-solid fa-arrow-left"></i>

                        Volver al Login

                    </a>

                </div>

            </form>

        </div>

    </div>

    <script>
        function previewImage(event) {

            const reader = new FileReader();

            reader.onload = function() {

                document.getElementById("preview").src = reader.result;

            }

            reader.readAsDataURL(event.target.files[0]);

        }
    </script>

</body>

</html>