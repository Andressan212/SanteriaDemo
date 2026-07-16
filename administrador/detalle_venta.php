<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: ventas.php");
    exit();
}

$id = intval($_GET["id"]);

/*=============================
VENTA
=============================*/

$sql = $conexion->prepare("

SELECT

ventas.*,

clientes.nombre AS cliente_nombre

FROM ventas

INNER JOIN clientes

ON ventas.cliente = clientes.id

WHERE ventas.id = ?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: ventas.php");
    exit();
}

$venta = $sql->fetch(PDO::FETCH_ASSOC);

/*=============================
DETALLE
=============================*/

$sqlDetalle = $conexion->prepare("

SELECT

detalle_ventas.*,

productos.nombre

FROM detalle_ventas

INNER JOIN productos

ON detalle_ventas.producto = productos.id

WHERE venta=?

");

$sqlDetalle->execute([$id]);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Detalle Venta</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <div class="ticket">

                <div class="empresa">

                    <img src="../img/logo.png" class="logoTicket">

                    <h1>Santería Humos del Norte</h1>

                    <p>Salta - Argentina</p>

                    <p>Tel: 387-000000</p>

                    <p>Gracias por su compra</p>

                </div>

                <hr>

                <div class="datosVenta">

                    <div>

                        <strong>Venta Nº:</strong>

                        <?php echo $venta["id"]; ?>

                    </div>

                    <div>

                        <strong>Fecha:</strong>

                        <?php echo date("d/m/Y H:i", strtotime($venta["fecha"])); ?>

                    </div>

                    <div>

                        <strong>Cliente:</strong>

                        <?php echo $venta["cliente_nombre"]; ?>

                    </div>

                    <div>

                        <strong>Método de Pago:</strong>

                        <?php echo $venta["metodo_pago"]; ?>

                    </div>

                    <div>

                        <strong>Estado:</strong>

                        <?php echo $venta["estado"]; ?>

                    </div>

                </div>

                <hr>


                <table class="tablaAdmin">

                    <thead>

                        <tr>

                            <th>Producto</th>

                            <th>Cantidad</th>

                            <th>Precio Unitario</th>

                            <th>Subtotal</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($fila = $sqlDetalle->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>

                                <td>

                                    <?php echo $fila["nombre"]; ?>

                                </td>

                                <td style="text-align:center;">

                                    <?php echo $fila["cantidad"]; ?>

                                </td>

                                <td>

                                    $

                                    <?php echo number_format($fila["precio"], 2, ",", "."); ?>

                                </td>

                                <td>

                                    <strong>

                                        $

                                        <?php echo number_format($fila["subtotal"], 2, ",", "."); ?>

                                    </strong>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <br>

                <div class="totalTicket">

                    <span>TOTAL</span>

                    <span>

                        $ <?php echo number_format($venta["total"], 2, ",", "."); ?>

                    </span>

                </div>

                <div class="accionesTicket">

                    <a href="ventas.php" class="btnCancelar">

                        <i class="fa-solid fa-arrow-left"></i>

                        Volver

                    </a>

                    <button
                        type="button"
                        onclick="imprimirTicket()"
                        class="btnGuardar">

                        <i class="fa-solid fa-print"></i>

                        Imprimir Ticket

                    </button>

                </div><!-- ticket -->

            </div> <!-- content -->

        </div> <!-- adminLayout -->
        <script>
            function imprimirTicket() {

                window.print();

            }
        </script>
</body>

</html>