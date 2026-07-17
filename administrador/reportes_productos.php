<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=================================
PRODUCTOS MÁS VENDIDOS
=================================*/

$sql = $conexion->query("

SELECT

productos.*,

categorias.nombre AS categoria_nombre

FROM productos

LEFT JOIN categorias

ON productos.categoria = categorias.id

ORDER BY mas_vendido DESC, nombre ASC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Productos Más Vendidos</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>

                <i class="fa-solid fa-ranking-star"></i>

                Productos Más Vendidos

            </h1>

            <table class="tablaAdmin">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Imagen</th>

                        <th>Producto</th>

                        <th>Categoría</th>

                        <th>Vendidos</th>

                        <th>Stock</th>

                        <th>Precio</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($producto = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                        <tr>

                            <td><?php echo $producto["id"]; ?></td>

                            <td>

                                <img
                                    src="../img/productos/<?php echo $producto["imagen"]; ?>"
                                    width="60">

                            </td>

                            <td><?php echo $producto["nombre"]; ?></td>

                            <td><?php echo $producto["categoria_nombre"]; ?></td>

                            <td>

                                <strong>

                                    <?php echo $producto["mas_vendido"]; ?>

                                </strong>

                            </td>

                            <td><?php echo $producto["stock"]; ?></td>

                            <td>

                                $

                                <?php echo number_format($producto["precio_venta"], 2, ",", "."); ?>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

            <br>

            <button

                onclick="window.print()"

                class="btnGuardar">

                <i class="fa-solid fa-print"></i>

                Imprimir

            </button>

        </div>

    </div>

</body>

</html>