<?php

require_once "verificar.php";
require_once "../includes/conexion.php";

if (!isset($_GET["id"])) {

    header("Location: administradores.php");
    exit();
}

$id = intval($_GET["id"]);

$sql = $conexion->prepare("

SELECT *

FROM administrador

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: administradores.php");
    exit();
}

$admin = $sql->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Administrador</title>

    <link rel="stylesheet" href="css/administrador.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4b7d1b7b0f.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="panelFormulario">

        <h1>

            <i class="fa-solid fa-user-pen"></i>

            Editar Administrador

        </h1>

        <form

            action="acciones/actualizar_admin.php"

            method="POST"

            enctype="multipart/form-data">

            <input

                type="hidden"

                name="id"

                value="<?= $admin["id"] ?>">

            <input

                type="hidden"

                name="fotoActual"

                value="<?= $admin["foto"] ?>">

            <div class="grupoFormulario">

                <label>Nombre</label>

                <input

                    type="text"

                    name="nombre"

                    value="<?= htmlspecialchars($admin["nombre"]) ?>"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>Apellido</label>

                <input

                    type="text"

                    name="apellido"

                    value="<?= htmlspecialchars($admin["apellido"]) ?>"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>Usuario</label>

                <input

                    type="text"

                    name="usuario"

                    value="<?= htmlspecialchars($admin["usuario"]) ?>"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>Correo</label>

                <input

                    type="email"

                    name="email"

                    value="<?= htmlspecialchars($admin["email"]) ?>"

                    required>

            </div>

            <div class="grupoFormulario">

                <label>Teléfono</label>

                <input

                    type="text"

                    name="telefono"

                    value="<?= htmlspecialchars($admin["telefono"]) ?>">

            </div>

            <div class="grupoFormulario">

                <label>Rol</label>

                <select name="rol">

                    <option value="Administrador" <?= $admin["rol"] == "Administrador" ? "selected" : "" ?>>

                        Administrador

                    </option>

                    <option value="Empleado" <?= $admin["rol"] == "Empleado" ? "selected" : "" ?>>

                        Empleado

                    </option>

                    <option value="Vendedor" <?= $admin["rol"] == "Vendedor" ? "selected" : "" ?>>

                        Vendedor

                    </option>

                </select>

            </div>

            <div class="grupoFormulario">

                <label>Nueva contraseña (opcional)</label>

                <input

                    type="password"

                    name="password"

                    placeholder="Dejar vacío para conservar la actual">

            </div>

            <div class="grupoFormulario">

                <label>Foto</label>

                <input

                    type="file"

                    name="foto"

                    accept=".jpg,.jpeg,.png,.webp">

            </div>

            <div class="grupoFormulario">

                <label>Estado</label>

                <select name="estado">

                    <option value="1" <?= $admin["estado"] == 1 ? "selected" : "" ?>>

                        Activo

                    </option>

                    <option value="0" <?= $admin["estado"] == 0 ? "selected" : "" ?>>

                        Inactivo

                    </option>

                </select>

            </div>

            <div class="grupoFormulario">

                <?php

                if (!empty($admin["foto"])) {

                ?>

                    <img

                        src="../img/usuarios/<?= $admin["foto"] ?>"

                        style="width:120px;border-radius:10px;">

                <?php

                }

                ?>

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

                    Actualizar Administrador

                </button>

            </div>

        </form>

    </div>

</body>

</html>