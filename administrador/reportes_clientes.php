<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=================================
CLIENTES QUE MÁS COMPRAN
=================================*/

$sql = $conexion->query("

SELECT

clientes.id,

clientes.nombre,

clientes.telefono,

clientes.correo,

COUNT(ventas.id) AS compras,

IFNULL(SUM(
CASE
WHEN ventas.estado='PAGADA'
THEN ventas.total
ELSE 0
END
),0) AS total_gastado,

MAX(ventas.fecha) AS ultima_compra

FROM clientes

LEFT JOIN ventas

ON clientes.id = ventas.cliente

GROUP BY clientes.id

ORDER BY total_gastado DESC,
compras DESC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Clientes que Más Compran</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>

                <i class="fa-solid fa-users"></i>

                Clientes que Más Compran

            </h1>

            <table class="tablaAdmin">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Cliente</th>

                        <th>Teléfono</th>

                        <th>Correo</th>

                        <th>Compras</th>

                        <th>Total Gastado</th>

                        <th>Última Compra</th>

                        <th>Historial</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $posicion = 1;

                    while ($cliente = $sql->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <tr>

                            <td>

                                <?php echo $posicion++; ?>

                            </td>

                            <td>

                                <?php echo $cliente["nombre"]; ?>

                            </td>

                            <td>

                                <?php echo $cliente["telefono"]; ?>

                            </td>

                            <td>

                                <?php echo $cliente["correo"]; ?>

                            </td>

                            <td>

                                <strong>

                                    <?php echo $cliente["compras"]; ?>

                                </strong>

                            </td>

                            <td>

                                $

                                <?php echo number_format($cliente["total_gastado"], 2, ",", "."); ?>

                            </td>

                            <td>

                                <?php

                                if ($cliente["ultima_compra"]) {

                                    echo date("d/m/Y", strtotime($cliente["ultima_compra"]));
                                } else {

                                    echo "-";
                                }

                                ?>

                            </td>

                            <td>

                                <a

                                    href="historial_cliente.php?id=<?php echo $cliente["id"]; ?>"

                                    class="btnEditar">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

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