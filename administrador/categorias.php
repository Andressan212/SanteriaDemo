<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$sql = $conexion->query("

SELECT *

FROM categorias

ORDER BY id DESC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categorías</title>

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

                        Categorías

                    </h1>

                    <p>

                        Administración de categorías de productos.

                    </p>

                </div>

                <a

                    href="nueva_categoria.php"

                    class="btnNuevo">

                    <i class="fa-solid fa-plus"></i>

                    Nueva Categoría

                </a>

            </div>

            <div class="tablaAdmin">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Nombre</th>

                            <th>Descripción</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($categoria = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>

                                <td>

                                    <?php echo $categoria["id"]; ?>

                                </td>

                                <td>

                                    <?php echo $categoria["nombre"]; ?>

                                </td>

                                <td>

                                    <?php echo $categoria["descripcion"]; ?>

                                </td>

                                <td>

                                    <?php

                                    if ($categoria["estado"] == 1) {

                                        echo "<span class='activo'>Activo</span>";
                                    } else {

                                        echo "<span class='inactivo'>Inactivo</span>";
                                    }

                                    ?>

                                </td>

                                <td>
                                    <a

                                        href="editar_categoria.php?id=<?php echo $categoria["id"]; ?>"

                                        class="btnEditar">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <a

                                        href="../acciones/eliminar_categoria.php?id=<?php echo $categoria["id"]; ?>"

                                        class="btnEliminar"

                                        onclick="return confirm('¿Desea eliminar esta categoría?')">

                                        <i class="fa-solid fa-trash"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>