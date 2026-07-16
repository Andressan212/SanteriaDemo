<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$sql = $conexion->query("

SELECT *

FROM productos

ORDER BY nombre ASC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventario</title>

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

                        Inventario

                    </h1>

                    <p>

                        Control de stock de todos los productos.

                    </p>

                </div>

                <div>

                    <a

                        href="nueva_entrada.php"

                        class="btnNuevo">

                        <i class="fa-solid fa-circle-plus"></i>

                        Nueva Entrada

                    </a>

                    <a

                        href="nueva_salida.php"

                        class="btnEliminar"

                        style="margin-left:10px;">

                        <i class="fa-solid fa-circle-minus"></i>

                        Nueva Salida

                    </a>
                    <a

                        href="historial_inventario.php"

                        class="btnEditar"

                        style="margin-left:10px;">

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Historial

                    </a>
                </div>

            </div>
            <a

                href="historial_inventario.php"

                class="btnEditar"

                style="margin-left:10px;">

                <i class="fa-solid fa-clock-rotate-left"></i>

                Historial

            </a>
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

                            <th>Producto</th>

                            <th>Categoría</th>

                            <th>Compra</th>

                            <th>Venta</th>

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

                                        width="60">

                                </td>

                                <td>

                                    <?php echo $producto["nombre"]; ?>

                                </td>

                                <td>

                                    <?php echo $producto["categoria"]; ?>

                                </td>

                                <td>

                                    $

                                    <?php echo number_format($producto["precio_compra"], 2, ",", "."); ?>

                                </td>

                                <td>

                                    $

                                    <?php echo number_format($producto["precio_venta"], 2, ",", "."); ?>

                                </td>

                                <td>

                                    <?php

                                    if ($producto["stock"] <= 5) {

                                        echo "<span class='stockBajo'>" . $producto["stock"] . "</span>";
                                    } elseif ($producto["stock"] <= 15) {

                                        echo "<span class='stockMedio'>" . $producto["stock"] . "</span>";
                                    } else {

                                        echo "<span class='stockAlto'>" . $producto["stock"] . "</span>";
                                    }

                                    ?>

                                </td>

                                <td>

                                    <?php

                                    if ($producto["stock"] == 0) {

                                        echo "<span class='inactivo'>Sin Stock</span>";
                                    } else {

                                        echo "<span class='activo'>Disponible</span>";
                                    }

                                    ?>

                                </td>

                                <td>

                                    <a

                                        href="nueva_entrada.php?id=<?php echo $producto["id"]; ?>"

                                        class="btnEditar">

                                        <i class="fa-solid fa-arrow-up"></i>

                                    </a>

                                    <a

                                        href="nueva_salida.php?id=<?php echo $producto["id"]; ?>"

                                        class="btnEliminar">

                                        <i class="fa-solid fa-arrow-down"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

            <br>

            <div class="cards">

                <div class="card">

                    <h3>

                        Productos

                    </h3>

                    <h2>

                        <?php

                        $total = $conexion->query("SELECT COUNT(*) FROM productos")->fetchColumn();

                        echo $total;

                        ?>

                    </h2>

                </div>

                <div class="card">

                    <h3>

                        Stock Total

                    </h3>

                    <h2>

                        <?php

                        $stock = $conexion->query("SELECT SUM(stock) FROM productos")->fetchColumn();

                        echo $stock;

                        ?>

                    </h2>

                </div>

                <div class="card">

                    <h3>

                        Sin Stock

                    </h3>

                    <h2>

                        <?php

                        $sin = $conexion->query("SELECT COUNT(*) FROM productos WHERE stock=0")->fetchColumn();

                        echo $sin;

                        ?>

                    </h2>

                </div>

                <div class="card">

                    <h3>

                        Stock Bajo

                    </h3>

                    <h2>

                        <?php

                        $bajo = $conexion->query("SELECT COUNT(*) FROM productos WHERE stock<=5")->fetchColumn();

                        echo $bajo;

                        ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>
    <div class="cards">

        <div class="card">

            <h3>Stock Bajo</h3>

            <h2>

                <?php

                echo $conexion->query("

SELECT COUNT(*)

FROM productos

WHERE stock<=5

")->fetchColumn();

                ?>

            </h2>

        </div>

        <div class="card">

            <h3>Sin Stock</h3>

            <h2>

                <?php

                echo $conexion->query("

SELECT COUNT(*)

FROM productos

WHERE stock=0

")->fetchColumn();

                ?>

            </h2>

        </div>
        <?php

        $alertas = $conexion->query("

SELECT

nombre,

stock

FROM productos

WHERE stock<=5

ORDER BY stock ASC

");

        if ($alertas->rowCount() > 0) {

        ?>

            <div class="alertaInventario">

                <h3>

                    ⚠ Productos con Stock Bajo

                </h3>

                <ul>

                    <?php while ($a = $alertas->fetch(PDO::FETCH_ASSOC)) { ?>

                        <li>

                            <b>

                                <?php echo $a["nombre"]; ?>

                            </b>

                            -

                            Stock:

                            <?php echo $a["stock"]; ?>

                        </li>

                    <?php } ?>

                </ul>

            </div>

        <?php } ?>
        <!---->
        <div class="card">

            <h3>Valor del Inventario</h3>

            <h2>$

                <?php

                echo number_format(

                    $conexion->query("

SELECT SUM(stock*precio_compra)

FROM productos

")->fetchColumn(),

                    2,

                    ",",

                    "."

                );

                ?>

            </h2>

        </div>

    </div>
</body>

</html>