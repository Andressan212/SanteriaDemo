<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=================================
PRODUCTOS CON POCO STOCK
=================================*/

$limite = isset($_GET["limite"]) ? intval($_GET["limite"]) : 5;

$sql = $conexion->prepare("

SELECT

productos.*,

categorias.nombre AS categoria_nombre

FROM productos

LEFT JOIN categorias

ON productos.categoria = categorias.id

WHERE productos.stock <= ?

ORDER BY productos.stock ASC,
productos.nombre ASC

");

$sql->execute([$limite]);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Productos con Poco Stock</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>

                <i class="fa-solid fa-triangle-exclamation"></i>

                Productos con Poco Stock

            </h1>

            <form method="GET">

                <label>Mostrar productos con stock menor o igual a:</label>

                <input
                    type="number"
                    name="limite"
                    min="0"
                    value="<?php echo $limite; ?>">

                <button class="btnGuardar">

                    <i class="fa-solid fa-search"></i>

                    Buscar

                </button>

            </form>

            <br>

            <table class="tablaAdmin">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Imagen</th>

                        <th>Producto</th>

                        <th>Categoría</th>

                        <th>Stock</th>

                        <th>Precio</th>

                        <th>Estado</th>

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

                                    <?php echo $producto["stock"]; ?>

                                </strong>

                            </td>

                            <td>

                                $

                                <?php echo number_format($producto["precio_venta"], 2, ",", "."); ?>

                            </td>

                            <td>

                                <?php

                                if ($producto["stock"] == 0) {

                                    echo "<span class='inactivo'>Sin Stock</span>";
                                } elseif ($producto["stock"] <= 5) {

                                    echo "<span class='inactivo'>Stock Bajo</span>";
                                } else {

                                    echo "<span class='activo'>Disponible</span>";
                                }

                                ?>

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

                Imprimir Reporte

            </button>

        </div>

    </div>

</body>

</html>