<?php

require_once "verificar.php";
require_once "../includes/conexion.php";

$buscar = "";

if (isset($_GET["buscar"])) {

    $buscar = trim($_GET["buscar"]);
}

if ($buscar == "") {

    $sql = $conexion->query("

        SELECT *

        FROM administrador

        ORDER BY id DESC

    ");
} else {

    $sql = $conexion->prepare("

        SELECT *

        FROM administrador

        WHERE

        nombre LIKE ?

        OR apellido LIKE ?

        OR usuario LIKE ?

        OR email LIKE ?

        ORDER BY id DESC

    ");

    $texto = "%" . $buscar . "%";

    $sql->execute([

        $texto,

        $texto,

        $texto,

        $texto

    ]);
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administradores</title>

    <link rel="stylesheet" href="css/administrador.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4b7d1b7b0f.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="panelAdmin">

        <aside class="menuLateral">

            <h2>

                Panel

            </h2>

            <ul>

                <li>

                    <a href="index.php">

                        <i class="fa-solid fa-house"></i>

                        Inicio

                    </a>

                </li>

                <li class="activo">

                    <a href="administradores.php">

                        <i class="fa-solid fa-user-shield"></i>

                        Administradores

                    </a>

                </li>

                <li>

                    <a href="productos.php">

                        <i class="fa-solid fa-box"></i>

                        Productos

                    </a>

                </li>

                <li>

                    <a href="ventas.php">

                        <i class="fa-solid fa-cart-shopping"></i>

                        Ventas

                    </a>

                </li>

            </ul>

        </aside>

        <main class="contenidoAdmin">

            <div class="cabeceraAdmin">

                <h1>

                    Administradores

                </h1>

                <a

                    href="agregar_admin.php"

                    class="btnNuevo">

                    <i class="fa-solid fa-plus"></i>

                    Nuevo Administrador

                </a>

            </div>

            <form method="GET" class="buscadorAdmin">

                <input

                    type="text"

                    name="buscar"

                    value="<?= htmlspecialchars($buscar) ?>"

                    placeholder="Buscar administrador...">

                <button>

                    <i class="fa-solid fa-magnifying-glass"></i>

                </button>

            </form>

            <div class="tablaResponsive">

                <table>

                    <thead>

                        <tr>

                            <th>Foto</th>

                            <th>Nombre</th>

                            <th>Usuario</th>

                            <th>Email</th>

                            <th>Rol</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>
                        <?php

                        while ($admin = $sql->fetch(PDO::FETCH_ASSOC)) {

                        ?>

                            <tr>

                                <td>

                                    <?php

                                    if (empty($admin["foto"])) {

                                    ?>

                                        <img
                                            src="../img/usuarios/usuario.png"
                                            class="fotoTabla">

                                    <?php

                                    } else {

                                    ?>

                                        <img
                                            src="../img/img/usuarios/<?= $admin["foto"] ?>"
                                            class="fotoTabla">

                                    <?php

                                    }

                                    ?>

                                </td>

                                <td>

                                    <strong>

                                        <?= $admin["nombre"] ?>

                                        <?= $admin["apellido"] ?>

                                    </strong>

                                </td>

                                <td>

                                    <?= $admin["usuario"] ?>

                                </td>

                                <td>

                                    <?= $admin["email"] ?>

                                </td>

                                <td>

                                    <?php

                                    switch ($admin["rol"]) {

                                        case "Administrador":

                                            echo "<span class='rolAdmin'>Administrador</span>";

                                            break;

                                        case "Empleado":

                                            echo "<span class='rolEmpleado'>Empleado</span>";

                                            break;

                                        case "Vendedor":

                                            echo "<span class='rolVendedor'>Vendedor</span>";

                                            break;
                                    }

                                    ?>

                                </td>

                                <td>

                                    <?php

                                    if ($admin["estado"] == 1) {

                                        echo "<span class='estadoActivo'>Activo</span>";
                                    } else {

                                        echo "<span class='estadoInactivo'>Inactivo</span>";
                                    }

                                    ?>

                                </td>

                                <td>

                                    <div class="accionesTabla">

                                        <a

                                            href="editar_admin.php?id=<?= $admin["id"] ?>"

                                            class="btnEditar">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a

                                            href="acciones/eliminar_admin.php?id=<?= $admin["id"] ?>"

                                            class="btnEliminar"

                                            onclick="return confirm('¿Desea eliminar este administrador?')">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                        <?php

                                        if ($admin["estado"] == 1) {

                                        ?>

                                            <a

                                                href="acciones/cambiar_estado.php?id=<?= $admin["id"] ?>&estado=0"

                                                class="btnBloquear">

                                                <i class="fa-solid fa-lock"></i>

                                            </a>

                                        <?php

                                        } else {

                                        ?>

                                            <a

                                                href="acciones/cambiar_estado.php?id=<?= $admin["id"] ?>&estado=1"

                                                class="btnActivar">

                                                <i class="fa-solid fa-lock-open"></i>

                                            </a>

                                        <?php

                                        }

                                        ?>

                                    </div>

                                </td>

                            </tr>

                        <?php

                        }

                        ?>
                    </tbody>

                </table>

            </div>

            <?php

            $totalAdmin = $conexion->query("SELECT COUNT(*) FROM administrador")->fetchColumn();

            $totalActivos = $conexion->query("SELECT COUNT(*) FROM administrador WHERE estado=1")->fetchColumn();

            $totalInactivos = $conexion->query("SELECT COUNT(*) FROM administrador WHERE estado=0")->fetchColumn();

            ?>

            <div class="estadisticasAdmin">

                <div class="cardEstadistica">

                    <i class="fa-solid fa-users"></i>

                    <h2>

                        <?= $totalAdmin ?>

                    </h2>

                    <p>

                        Administradores

                    </p>

                </div>

                <div class="cardEstadistica">

                    <i class="fa-solid fa-user-check"></i>

                    <h2>

                        <?= $totalActivos ?>

                    </h2>

                    <p>

                        Activos

                    </p>

                </div>

                <div class="cardEstadistica">

                    <i class="fa-solid fa-user-lock"></i>

                    <h2>

                        <?= $totalInactivos ?>

                    </h2>

                    <p>

                        Inactivos

                    </p>

                </div>

            </div>

        </main>

    </div>

    <script>
        const btnEliminar = document.querySelectorAll(".btnEliminar");

        btnEliminar.forEach(boton => {

            boton.addEventListener("click", (e) => {

                if (!confirm("¿Está seguro de eliminar este administrador?")) {

                    e.preventDefault();

                }

            });

        });
    </script>

</body>

</html>