<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*
|---------------------------------------------------------
| CONSULTA
|---------------------------------------------------------
| Si la tabla productos todavía no está creada,
| comenta este bloque temporalmente.
*/

$sql = $conexion->query("

SELECT *

FROM productos

ORDER BY id DESC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos</title>

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

                        Productos

                    </h1>

                    <p>

                        Administración completa del catálogo.

                    </p>

                </div>

                <a

                    href="nuevo_producto.php"

                    class="btnNuevo">

                    <i class="fa-solid fa-plus"></i>

                    Nuevo Producto

                </a>

            </div>

            <div class="barraSuperior">

                <input

                    type="text"

                    id="buscar"

                    placeholder="Buscar producto...">

            </div>

            <div class="tablaAdmin">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Imagen</th>

                            <th>Nombre</th>

                            <th>Categoría</th>

                            <th>Precio</th>

                            <th>Stock</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($producto = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>

                                <td>

                                    <?php echo $producto["id"]; ?>

                                </td>

                                <td>

                                    <img

                                        src="../img/productos/<?php echo $producto["imagen"]; ?>"

                                        width="70">

                                </td>

                                <td>

                                    <?php echo $producto["nombre"]; ?>

                                </td>

                                <td>

                                    <?php echo $producto["categoria"]; ?>

                                </td>

                                <td>

                                    $

                                    <?php echo number_format($producto["precio"], 2, ",", "."); ?>

                                </td>

                                <td>

                                    <?php echo $producto["stock"]; ?>

                                </td>

                                <td>

                                    <?php

                                    if ($producto["estado"] == 1) {

                                        echo "<span class='activo'>Activo</span>";
                                    } else {

                                        echo "<span class='inactivo'>Inactivo</span>";
                                    }

                                    ?>

                                </td>

                                <td>

                                    <a

                                        href="editar_producto.php?id=<?php echo $producto["id"]; ?>"

                                        class="btnEditar">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <a

                                        href="../acciones/eliminar_producto.php?id=<?php echo $producto["id"]; ?>"

                                        class="btnEliminar"

                                        onclick="return confirm('¿Eliminar este producto?')">

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