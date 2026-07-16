<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$mensaje = "";

if (isset($_GET["ok"])) {

    switch ($_GET["ok"]) {

        case "venta":
            $mensaje = "Venta registrada correctamente.";
            break;

        case "eliminar":
            $mensaje = "Venta eliminada correctamente.";
            break;
    }
}

$sql = $conexion->query("

SELECT

ventas.*,

clientes.nombre AS cliente_nombre

FROM ventas

INNER JOIN clientes

ON ventas.cliente = clientes.id

ORDER BY ventas.fecha DESC

");

$totalVentas = $conexion->query("

SELECT COUNT(*)

FROM ventas

")->fetchColumn();

$totalIngresos = $conexion->query("

SELECT IFNULL(SUM(total),0)

FROM ventas

WHERE estado='PAGADA'

")->fetchColumn();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ventas</title>

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

                    <h1>Ventas</h1>

                    <p>Administración de todas las ventas realizadas.</p>

                </div>

                <div>

                    <a href="nueva_venta.php" class="btnNuevo">

                        <i class="fa-solid fa-cart-shopping"></i>

                        Nueva Venta

                    </a>

                </div>

            </div>

            <div class="cards">

                <div class="card">

                    <h3>Total Ventas</h3>

                    <h2><?php echo $totalVentas; ?></h2>

                </div>

                <div class="card">

                    <h3>Ingresos</h3>

                    <h2>$<?php echo number_format($totalIngresos, 2, ",", "."); ?></h2>

                </div>

            </div>

            <br>

            <div class="barraSuperior">

                <input type="text"

                    id="buscar"

                    placeholder="Buscar venta...">

            </div>

            <div class="tablaAdmin">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Cliente</th>

                            <th>Fecha</th>

                            <th>Total</th>

                            <th>Estado</th>

                            <th>Método</th>

                            <th>Usuario</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>
                        <!---->
                        <?php if ($mensaje != "") { ?>

                            <div class="alertaExito">

                                <i class="fa-solid fa-circle-check"></i>

                                <?php echo $mensaje; ?>

                            </div>

                        <?php } ?>
                        <!---->
                        <?php while ($venta = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>

                                <td><?php echo $venta["id"]; ?></td>

                                <td><?php echo $venta["cliente_nombre"]; ?></td>

                                <td><?php echo date("d/m/Y H:i", strtotime($venta["fecha"])); ?></td>

                                <td>$<?php echo number_format($venta["total"], 2, ",", "."); ?></td>

                                <td>

                                    <?php

                                    if ($venta["estado"] == "PAGADA") {

                                        echo "<span class='activo'>PAGADA</span>";
                                    } elseif ($venta["estado"] == "PENDIENTE") {

                                        echo "<span class='stockMedio'>PENDIENTE</span>";
                                    } else {

                                        echo "<span class='inactivo'>ANULADA</span>";
                                    }

                                    ?>

                                </td>

                                <td><?php echo $venta["metodo_pago"]; ?></td>

                                <td><?php echo $venta["usuario"]; ?></td>

                                <td>

                                    <a
                                        href="detalle_venta.php?id=<?php echo $venta["id"]; ?>"
                                        class="btnEditar"
                                        title="Ver">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <?php if ($venta["estado"] == "PAGADA") { ?>

                                        <a
                                            href="../acciones/anular_venta.php?id=<?php echo $venta["id"]; ?>"
                                            class="btnEliminar"
                                            title="Anular"
                                            onclick="return confirm('¿Desea anular esta venta?');">

                                            <i class="fa-solid fa-ban"></i>

                                        </a>

                                    <?php } else { ?>

                                        <a
                                            href="../acciones/eliminar_venta.php?id=<?php echo $venta["id"]; ?>"
                                            class="btnEliminar"
                                            title="Eliminar definitivamente"
                                            onclick="return confirm('Esta venta será eliminada definitivamente. ¿Continuar?');">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script>
        document.getElementById("buscar").addEventListener("keyup", function() {

            let texto = this.value.toLowerCase();

            let filas = document.querySelectorAll("tbody tr");

            filas.forEach(function(fila) {

                fila.style.display = fila.innerText.toLowerCase().includes(texto) ? "" : "none";

            });

        });
    </script>

</body>

</html>