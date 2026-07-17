<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: clientes.php");
    exit();
}

$id = intval($_GET["id"]);

/*==================================
OBTENER CLIENTE
==================================*/

$sqlCliente = $conexion->prepare("

SELECT *

FROM clientes

WHERE id=?

LIMIT 1

");

$sqlCliente->execute([$id]);

if ($sqlCliente->rowCount() == 0) {

    header("Location: clientes.php");
    exit();
}

$cliente = $sqlCliente->fetch(PDO::FETCH_ASSOC);

/*==================================
OBTENER VENTAS DEL CLIENTE
==================================*/

$sqlVentas = $conexion->prepare("

SELECT *

FROM ventas

WHERE cliente=?

ORDER BY fecha DESC

");

$sqlVentas->execute([$id]);

/*==================================
TOTAL GASTADO
==================================*/

$sqlTotal = $conexion->prepare("

SELECT IFNULL(SUM(total),0)

FROM ventas

WHERE cliente=?

AND estado='PAGADA'

");

$sqlTotal->execute([$id]);

$totalGastado = $sqlTotal->fetchColumn();

/*==================================
CANTIDAD DE COMPRAS
==================================*/

$sqlCantidad = $conexion->prepare("

SELECT COUNT(*)

FROM ventas

WHERE cliente=?

");

$sqlCantidad->execute([$id]);

$cantidadCompras = $sqlCantidad->fetchColumn();
?>
<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Historial del Cliente</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>Historial de Compras</h1>

            <div class="card">

                <h2><?php echo $cliente["nombre"]; ?></h2>

                <p><b>Teléfono:</b> <?php echo $cliente["telefono"]; ?></p>

                <p><b>Correo:</b> <?php echo $cliente["correo"]; ?></p>

                <p><b>Dirección:</b> <?php echo $cliente["direccion"]; ?></p>

            </div>

            <br>

            <table class="tablaAdmin">

                <thead>

                    <tr>

                        <th>Venta</th>

                        <th>Fecha</th>

                        <th>Estado</th>

                        <th>Total</th>

                        <th>Ver</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($venta = $sqlVentas->fetch(PDO::FETCH_ASSOC)) { ?>

                        <tr>

                            <td><?php echo $venta["id"]; ?></td>

                            <td><?php echo date("d/m/Y H:i", strtotime($venta["fecha"])); ?></td>

                            <td><?php echo $venta["estado"]; ?></td>

                            <td>$ <?php echo number_format($venta["total"], 2, ",", "."); ?></td>

                            <td>

                                <a
                                    href="detalle_venta.php?id=<?php echo $venta["id"]; ?>"
                                    class="btnEditar">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

            <br>

            <div class="card">

                <h3>Total Compras</h3>

                <h2><?php echo $cantidadCompras; ?></h2>

                <hr>

                <h3>Total Gastado</h3>

                <h2>$ <?php echo number_format($totalGastado, 2, ",", "."); ?></h2>

            </div>

            <br>

            <a
                href="clientes.php"
                class="btnCancelar">

                <i class="fa-solid fa-arrow-left"></i>

                Volver

            </a>

        </div>

    </div>

</body>

</html>